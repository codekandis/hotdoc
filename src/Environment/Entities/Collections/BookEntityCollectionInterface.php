<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities\Collections;

use CodeKandis\Entities\Collections\EntityCollectionInterface;
use CodeKandis\Entities\EntityInterface;
use CodeKandis\HotDoc\Environment\Entities\BookEntityInterface;
use CodeKandis\HotDoc\Environment\Entities\ChapterEntityInterface;

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

	/**
	 * Searches for a book by its canonical book name.
	 * @param string $canonicalBookName The canonical book name.
	 * @return ?BookEntityInterface The book if found, otherwise null.
	 */
	public function findBookByCanonicalBookName( string $canonicalBookName ): ?BookEntityInterface;

	/**
	 * Searches for a chapter by its canonical chapter name.
	 * @param string $canonicalChapterName The canonical chapter name.
	 * @return ?ChapterEntityInterface The chapter if found, otherwise null.
	 */
	public function findChapterByCanonicalChapterName( string $canonicalChapterName ): ?ChapterEntityInterface;
}
