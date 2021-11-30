<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations;

use CodeKandis\Configurations\AbstractConfiguration;

/**
 * Represents a books configuration.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class BooksConfiguration extends AbstractConfiguration implements BooksConfigurationInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function getBooksPath(): string
	{
		return $this->read( 'booksPath' );
	}
}
