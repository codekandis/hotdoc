<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations;

use CodeKandis\Tiphy\Configurations\ConfigurationRegistryInterface;

/**
 * Represents the interface of any frontend configuration registry.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface FrontendConfigurationRegistryInterface extends ConfigurationRegistryInterface
{
	/**
	 * Gets the books configuration.
	 * @return ?BooksConfigurationInterface
	 */
	public function getBooksConfiguration(): ?BooksConfigurationInterface;
}
