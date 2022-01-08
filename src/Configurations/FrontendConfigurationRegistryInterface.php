<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations;

use CodeKandis\Authentication\SessionAuthenticatorConfigurationInterface;
use CodeKandis\Tiphy\Configurations\ConfigurationRegistryInterface;
use CodeKandis\TiphyPersistenceIntegration\Configurations\ConfigurationRegistryInterface as PersistenceConfigurationRegistryInterface;
use CodeKandis\TiphySentryClientIntegration\Configurations\ConfigurationRegistryInterface as SentryClientConfigurationRegistryInterface;
use CodeKandis\TiphySessionIntegration\Configurations\ConfigurationRegistryInterface as SessionConfigurationRegistryInterface;

/**
 * Represents the interface of any frontend configuration registry.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface FrontendConfigurationRegistryInterface extends ConfigurationRegistryInterface, SentryClientConfigurationRegistryInterface, PersistenceConfigurationRegistryInterface, SessionConfigurationRegistryInterface
{
	/**
	 * Gets the session authenticator configuration.
	 * @return ?SessionAuthenticatorConfigurationInterface The session authenticator configuration.
	 */
	public function getSessionAuthenticatorConfiguration(): ?SessionAuthenticatorConfigurationInterface;

	/**
	 * Gets the books configuration.
	 * @return ?BooksConfigurationInterface
	 */
	public function getBooksConfiguration(): ?BooksConfigurationInterface;
}
