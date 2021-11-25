<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities\Collections;

use CodeKandis\Entities\Collections\EntityCollectionInterface;
use CodeKandis\Entities\EntityInterface;
use CodeKandis\HotDoc\Environment\Entities\BookEntityInterface;

/**
 * Represents the interface of any collection of book entities.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface BookEntityCollectionInterface extends EntityCollectionInterface
{
	/**
	 * Gets the current book.
	 * @return BookEntityInterface The current book.
	 */
	public function current(): EntityInterface;

	/**
	 * Gets the book at the specified index.
	 * @param int $index The index of the book.
	 * @return BookEntityInterface The book to get.
	 */
	public function offsetGet( $index ): EntityInterface;
}
