<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations;

use CodeKandis\Configurations\PlainConfigurationLoader;
use CodeKandis\Tiphy\Configurations\AbstractConfigurationRegistry;
use CodeKandis\Tiphy\Configurations\RoutesConfiguration;
use CodeKandis\Tiphy\Configurations\TemplateRendererConfiguration;
use CodeKandis\TiphySentryClientIntegration\Configurations\ConfigurationRegistryTrait as SentryClientConfigurationRegistryTrait;
use CodeKandis\TiphySentryClientIntegration\Configurations\SentryClientConfiguration;

/**
 * Represents the configuration registry of the frontend.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class FrontendConfigurationRegistry extends AbstractConfigurationRegistry implements FrontendConfigurationRegistryInterface
{
	use SentryClientConfigurationRegistryTrait;

	/**
	 * Stores the books configuration.
	 * @var ?BooksConfigurationInterface
	 */
	private ?BooksConfigurationInterface $booksConfiguration;

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
		$this->routesConfiguration           = new RoutesConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'routes' )
				->load( dirname( __DIR__, 2 ) . '/config', 'routes' )
				->getPlainConfiguration()
		);
		$this->sentryClientConfiguration     = new SentryClientConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'sentryClient' )
				->load( dirname( __DIR__, 2 ) . '/config', 'sentryClient' )
				->getPlainConfiguration()
		);
		$this->templateRendererConfiguration = new TemplateRendererConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'templateRenderer' )
				->load( dirname( __DIR__, 2 ) . '/config', 'templateRenderer' )
				->getPlainConfiguration()
		);
		$this->booksConfiguration            = new BooksConfiguration(
			( new PlainConfigurationLoader() )
				->load( __DIR__ . '/Plain', 'books' )
				->load( dirname( __DIR__, 2 ) . '/config', 'books' )
				->getPlainConfiguration()
		);
	}
}
