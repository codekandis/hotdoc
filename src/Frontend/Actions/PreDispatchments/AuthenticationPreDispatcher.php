<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Actions\PreDispatchments;

use CodeKandis\Authentication\CommonClientCredentials;
use CodeKandis\Authentication\CommonSessionAuthenticator;
use CodeKandis\Authentication\RegisteredCommonClient;
use CodeKandis\Authentication\RegisteredCommonClientInterface;
use CodeKandis\Authentication\SessionAuthenticatorConfigurationInterface;
use CodeKandis\HotDoc\Environment\Entities\UserEntity;
use CodeKandis\HotDoc\Environment\Persistence\MariaDb\Repositories\UserEntityRepository;
use CodeKandis\Persistence\ConnectorInterface;
use CodeKandis\Persistence\FetchingResultFailedException;
use CodeKandis\Persistence\SettingFetchModeFailedException;
use CodeKandis\Persistence\StatementExecutionFailedException;
use CodeKandis\Persistence\StatementPreparationFailedException;
use CodeKandis\Persistence\TransactionCommitFailedException;
use CodeKandis\Persistence\TransactionRollbackFailedException;
use CodeKandis\Persistence\TransactionStartFailedException;
use CodeKandis\Session\SessionHandlerInterface;
use CodeKandis\Tiphy\Actions\PreDispatchment\PreDispatcherInterface;
use CodeKandis\Tiphy\Actions\PreDispatchment\PreDispatchmentStateInterface;
use ReflectionException;
use function array_key_exists;

/**
 * Represents an authentication pre-distpatcher.
 * @package codekandis\hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class AuthenticationPreDispatcher implements PreDispatcherInterface
{
	/**
	 * Stores the database connector.
	 * @var ConnectorInterface
	 */
	private ConnectorInterface $connector;

	/**
	 * Stores the session handler.
	 * @var SessionHandlerInterface
	 */
	private SessionHandlerInterface $sessionHandler;

	/**
	 * Stores the session authenticator configuration.
	 * @var SessionAuthenticatorConfigurationInterface
	 */
	private SessionAuthenticatorConfigurationInterface $sessionAuthenticatorConfiguration;

	/**
	 * Constructor method.
	 * @param ConnectorInterface $connector The database connector.
	 * @param SessionHandlerInterface $sessionHandler The session handler.
	 * @param SessionAuthenticatorConfigurationInterface $sessionAuthenticatorConfiguration The session authenticator configuration.
	 */
	public function __construct( ConnectorInterface $connector, SessionHandlerInterface $sessionHandler, SessionAuthenticatorConfigurationInterface $sessionAuthenticatorConfiguration )
	{
		$this->connector                         = $connector;
		$this->sessionHandler                    = $sessionHandler;
		$this->sessionAuthenticatorConfiguration = $sessionAuthenticatorConfiguration;
	}

	/**
	 * Gets the registered clients matching a specific e-mail.
	 * @param string $eMail The e-mail of the registered client.
	 * @return RegisteredCommonClientInterface[] The registered common clients.
	 * @throws ReflectionException The user entity class to reflect does not exist.
	 * @throws TransactionStartFailedException The transaction failed to start.
	 * @throws TransactionRollbackFailedException The transaction failed to roll back.
	 * @throws TransactionCommitFailedException The transaction failed to commit.
	 * @throws StatementPreparationFailedException The preparation of the statement failed.
	 * @throws StatementExecutionFailedException The execution of the statement failed.
	 * @throws SettingFetchModeFailedException The setting of the fetch mode of the statement failed.
	 * @throws FetchingResultFailedException The fetching of the statment result failed.
	 */
	private function getRegisteredClients( string $eMail ): array
	{
		$registeredUser = $this->connector->asTransaction(
			function () use ( $eMail )
			{
				return ( new UserEntityRepository( $this->connector ) )
					->readUserByEMail(
						UserEntity::fromArray(
							[
								'eMail' => $eMail
							]
						)
					);
			}
		);

		$registeredClients = [];
		if ( null !== $registeredUser )
		{
			$registeredClients[] = new RegisteredCommonClient( '', $registeredUser->getEMail(), $registeredUser->getPassword(), (int) $registeredUser->getIsActive() );
		}

		return $registeredClients;
	}

	/**
	 * Persists the authorized client in the session.
	 * @param RegisteredCommonClientInterface $authorizedClient The authorized client.
	 */
	private function persistAuthorizedClientInSession( RegisteredCommonClientInterface $authorizedClient ): void
	{
		$this->sessionHandler->start();
		$this
			->sessionHandler
			->set(
				$this
					->sessionAuthenticatorConfiguration
					->getRegisteredClientSessionKey(),
				new RegisteredCommonClient(
					'',
					$authorizedClient->getId(),
					'',
					$authorizedClient->getPermission()
				)
			);
	}

	/**
	 * Responds with a `401 Unauthorized`.
	 * @param PreDispatchmentStateInterface $dispatchmentState The state of the pre-dispatchment.
	 * @param string $requestedUri The clients requested URI.
	 */
	private function respondUnauthorized( PreDispatchmentStateInterface $dispatchmentState, string $requestedUri ): void
	{
		$dispatchmentState->setPreventDispatchment( true );
		( new UnauthorizedAction( $requestedUri ) )
			->execute();
	}

	/**
	 * Redirects to the requested URI.
	 * @param PreDispatchmentStateInterface $dispatchmentState The state of the pre-dispatchment.
	 * @param string redirectUri The clients requested URI.
	 */
	private function respondAuthorized( PreDispatchmentStateInterface $dispatchmentState, string $redirectUri ): void
	{
		$dispatchmentState->setPreventDispatchment( true );
		( new AuthorizedAction( $redirectUri ) )
			->execute();
	}

	/**
	 * {@inheritDoc}
	 * @throws ReflectionException The user entity class to reflect does not exist.
	 * @throws TransactionStartFailedException The transaction failed to start.
	 * @throws TransactionRollbackFailedException The transaction failed to roll back.
	 * @throws TransactionCommitFailedException The transaction failed to commit.
	 * @throws StatementPreparationFailedException The preparation of the statement failed.
	 * @throws StatementExecutionFailedException The execution of the statement failed.
	 * @throws SettingFetchModeFailedException The setting of the fetch mode of the statement failed.
	 * @throws FetchingResultFailedException The fetching of the statment result failed.
	 */
	public function preDispatch( string $requestedUri, PreDispatchmentStateInterface $dispatchmentState ): void
	{
		$authenticator = new CommonSessionAuthenticator(
			$this->sessionHandler,
			$this
				->sessionAuthenticatorConfiguration
				->getRegisteredClientSessionKey()
		);

		if ( true === $authenticator->isClientGranted() )
		{
			return;
		}

		if ( false === array_key_exists( 'eMail', $_POST ) || false === array_key_exists( 'password', $_POST ) )
		{
			$this->respondUnauthorized( $dispatchmentState, $requestedUri );

			return;
		}

		$clientCredentials = new CommonClientCredentials( $_POST[ 'eMail' ], $_POST[ 'password' ] );
		$registeredClients = $this->getRegisteredClients( $clientCredentials->getId() );

		if ( false === $authenticator->requestPermission( $registeredClients, $clientCredentials ) )
		{
			$this->respondUnauthorized( $dispatchmentState, $requestedUri );

			return;
		}

		$this->persistAuthorizedClientInSession( $registeredClients[ 0 ] );
		$this->respondAuthorized( $dispatchmentState, $requestedUri );
	}
}
