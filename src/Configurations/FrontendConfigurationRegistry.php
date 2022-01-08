<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations;

use CodeKandis\Authentication\SessionAuthenticatorConfiguration;
use CodeKandis\Authentication\SessionAuthenticatorConfigurationInterface;
use CodeKandis\Configurations\PlainConfigurationLoader;
use CodeKandis\Tiphy\Configurations\AbstractConfigurationRegistry;
use CodeKandis\Tiphy\Configurations\RoutesConfiguration;
use CodeKandis\Tiphy\Configurations\TemplateRendererConfiguration;
use CodeKandis\Tiphy\Configurations\UriBuilderConfiguration;
use CodeKandis\TiphyPersistenceIntegration\Configurations\ConfigurationRegistryTrait as PersistenceConfigurationRegistryTrait;
use CodeKandis\TiphyPersistenceIntegration\Configurations\PersistenceConfiguration;
use CodeKandis\TiphySentryClientIntegration\Configurations\ConfigurationRegistryTrait as SentryClientConfigurationRegistryTrait;
use CodeKandis\TiphySentryClientIntegration\Configurations\SentryClientConfiguration;
use CodeKandis\TiphySessionIntegration\Configurations\ConfigurationRegistryTrait as SessionConfigurationRegistryTrait;
use CodeKandis\TiphySessionIntegration\Configurations\SessionsConfiguration;
use function dirname;

/**
 * Represents the configuration registry of the frontend.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class FrontendConfigurationRegistry extends AbstractConfigurationRegistry implements FrontendConfigurationRegistryInterface
{
	use SentryClientConfigurationRegistryTrait;
	use PersistenceConfigurationRegistryTrait;
	use SessionConfigurationRegistryTrait;

	/**
	 * Stores the session authenticator configuration.
	 * @var ?SessionAuthenticatorConfigurationInterface
	 */
	private ?SessionAuthenticatorConfigurationInterface $sessionAuthenticatorConfiguration;

	/**
	 * Stores the books configuration.
	 * @var ?BooksConfigurationInterface
	 */
	private ?BooksConfigurationInterface $booksConfiguration;

	/**
	 * {@inheritDoc}
	 */
	public function getSessionAuthenticatorConfiguration(): ?SessionAuthenticatorConfigurationInterface
	{
		return $this->sessionAuthenticatorConfiguration;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getBooksConfiguration(): ?BooksConfigurationInterface
	{
		return $this->booksConfiguration;
	}

	/**
	 * Creates the singleton instance of the frontend configuration registry.
	 * @return FrontendConfigurationRegistryInterface The singleton instance of the frontend configuration registry.
	 */
	public static function _(): FrontendConfigurationRegistryInterface
	{
		return parent::_();
	}

	/**
	 * {@inheritDoc}
	 */
	protected function initialize(): void
	{
		$this->sentryClientConfiguration         = new SentryClientConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'sentryClient' )
				->load( dirname( __DIR__, 2 ) . '/config', 'sentryClient' )
				->getPlainConfiguration()
		);
		$this->persistenceConfiguration          = new PersistenceConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'persistence' )
				->load( dirname( __DIR__, 2 ) . '/config', 'persistence' )
				->getPlainConfiguration()
		);
		$this->sessionsConfiguration             = new SessionsConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'sessions' )
				->load( dirname( __DIR__, 2 ) . '/config', 'sessions' )
				->getPlainConfiguration()
		);
		$this->routesConfiguration               = new RoutesConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'routes' )
				->load( dirname( __DIR__, 2 ) . '/config', 'routes' )
				->getPlainConfiguration()
		);
		$this->sentryClientConfiguration         = new SentryClientConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'sentryClient' )
				->load( dirname( __DIR__, 2 ) . '/config', 'sentryClient' )
				->getPlainConfiguration()
		);
		$this->templateRendererConfiguration     = new TemplateRendererConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'templateRenderer' )
				->load( dirname( __DIR__, 2 ) . '/config', 'templateRenderer' )
				->getPlainConfiguration()
		);
		$this->uriBuilderConfiguration           = new UriBuilderConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'uriBuilder' )
				->load( dirname( __DIR__, 2 ) . '/config', 'uriBuilder' )
				->getPlainConfiguration()
		);
		$this->sessionAuthenticatorConfiguration = new SessionAuthenticatorConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'authenticator' )
				->load( dirname( __DIR__, 2 ) . '/config', 'authenticator' )
				->getPlainConfiguration()
		);
		$this->booksConfiguration                = new BooksConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'books' )
				->load( dirname( __DIR__, 2 ) . '/config', 'books' )
				->getPlainConfiguration()
		);
	}
}
