<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Actions;

use CodeKandis\Authentication\RegisteredCommonClientInterface;
use CodeKandis\HotDoc\Configurations\FrontendConfigurationRegistry;
use CodeKandis\HotDoc\Configurations\FrontendConfigurationRegistryInterface;
use CodeKandis\HotDoc\Environment\Entities\UserEntity;
use CodeKandis\HotDoc\Environment\Entities\UserEntityInterface;
use CodeKandis\HotDoc\Environment\Persistence\MariaDb\Repositories\UserEntityRepository;
use CodeKandis\HotDoc\Frontend\Errors\CommonErrorCodes;
use CodeKandis\HotDoc\Frontend\Errors\CommonErrorMessages;
use CodeKandis\Persistence\Connector;
use CodeKandis\Session\SessionHandler;
use CodeKandis\Tiphy\Actions\AbstractAction as OriginAbstractAction;
use CodeKandis\Tiphy\Data\ArrayAccessor;
use CodeKandis\Tiphy\Data\ArrayAccessorInterface;
use CodeKandis\Tiphy\Http\Requests\BadRequestException;

/**
 * Represents the base class of all actions.
 * @package codekandis\hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractAction extends OriginAbstractAction
{
	/**
	 * Stores the input data of the action.
	 * @var ArrayAccessorInterface
	 */
	private ArrayAccessorInterface $inputData;

	/**
	 * Stores the frontend configuration registry of the action.
	 * @var FrontendConfigurationRegistryInterface
	 */
	private FrontendConfigurationRegistryInterface $frontendConfigurationRegistry;

	/**
	 * Gets the input data of the request.
	 * @param string[] $requiredKeys The required object keys of the JSON body.
	 * @return ArrayAccessorInterface The input data of the request.
	 * @throws BadRequestException The request content type is invalid.
	 * @throws BadRequestException The request body is malformed.
	 * @throws BadRequestException The request body is invalid.
	 */
	protected function getInputData( array $requiredKeys = [] ): ArrayAccessorInterface
	{
		if ( true === isset( $this->inputData ) )
		{
			return $this->inputData;
		}

		$requestPostData = new ArrayAccessor( $_GET );

		$isValid     = true;
		$requestData = [];
		foreach ( $requiredKeys as $requiredKey )
		{
			$isValid = $isValid && true === isset( $requestPostData[ $requiredKey ] );
			if ( false === $isValid )
			{
				break;
			}
			$requestData[ $requiredKey ] = $requestPostData[ $requiredKey ];
		}
		if ( false === $isValid )
		{
			throw new BadRequestException( CommonErrorMessages::INVALID_REQUEST_BODY, CommonErrorCodes::INVALID_REQUEST_BODY );
		}

		$inputData = $requestData + $this->arguments;

		return $this->inputData = new ArrayAccessor( $inputData );
	}

	/**
	 * Gets the frontend configuration registry.
	 * @return FrontendConfigurationRegistryInterface The frontend configuration registry.
	 */
	protected function getFrontendConfigurationRegistry(): FrontendConfigurationRegistryInterface
	{
		return $this->frontendConfigurationRegistry
			   ?? $this->frontendConfigurationRegistry = FrontendConfigurationRegistry::_();
	}

	/**
	 * Gets the signed-in user.
	 * @return ?UserEntityInterface The signed-in user if found, otherwise null.
	 */
	protected function getSignedInUser(): ?UserEntityInterface
	{
		$sessionHandler=new SessionHandler(
			$this
				->frontendConfigurationRegistry
				->getSessionsConfiguration()
		);
		$sessionHandler->start();

		/**
		 * @var RegisteredCommonClientInterface $registeredClient
		 */
		$registeredClient = $sessionHandler
			->get(
				$this
					->frontendConfigurationRegistry
					->getSessionAuthenticatorConfiguration()
					->getRegisteredClientSessionKey()
			);

		$sessionHandler->writeClose();

		$connector  = new Connector(
			$this
				->frontendConfigurationRegistry
				->getPersistenceConfiguration()
		);
		$userEntity = $connector->asTransaction(
			function () use ( $registeredClient, $connector ): ?UserEntityInterface
			{
				return ( new UserEntityRepository( $connector ) )
					->readUserByEMail(
						UserEntity::fromArray(
							[
								'eMail' => $registeredClient->getId()
							]
						)
					);
			}
		);

		return $userEntity ?? new UserEntity();
	}
}
