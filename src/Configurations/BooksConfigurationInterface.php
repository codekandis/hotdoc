<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations;

use CodeKandis\Configurations\ConfigurationInterface;

/**
 * Represents the interface of any books configuration.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface BooksConfigurationInterface extends ConfigurationInterface
{
	/**
	 * Gets the path of the books.
	 * @return string The path of the books.
	 */
	public function getBooksPath(): string;
}
