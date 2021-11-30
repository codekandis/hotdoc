<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities\Collections;

use CodeKandis\Entities\Collections\AbstractEntityCollection;
use CodeKandis\Entities\Collections\EntityExistsException;
use CodeKandis\Entities\EntityInterface;
use CodeKandis\HotDoc\Environment\Entities\BookEntityInterface;
use CodeKandis\HotDoc\Environment\Entities\ChapterEntityInterface;
use function count;

/**
 * Represents a collection of book entities.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class BookEntityCollection extends AbstractEntityCollection implements BookEntityCollectionInterface
{
	/**
	 * Constructor method.
	 * @param BookEntityInterface[] $books The initial books of the collection.
	 * @throws EntityExistsException A book already exists in the collection.
	 */
	public function __construct( BookEntityInterface ...$books )
	{
		parent::__construct( ...$books );
	}

	/**
	 * {@inheritDoc}
	 */
	public function current(): EntityInterface
	{
		return parent::current();
	}

	/**
	 * {@inheritDoc}
	 */
	public function offsetGet( $index ): EntityInterface
	{
		return parent::offsetGet( $index );
	}

	/**
	 * {@inheritDoc}
	 */
	public function findBookByCanonicalBookName( string $canonicalBookName ): ?BookEntityInterface
	{
		foreach ( $this as $book )
		{
			if ( $book->getCanonicalName() === $canonicalBookName )
			{
				return $book;
			}
		}

		return null;
	}

	/**
	 * Searches for a chapter by its canonical chapter name.
	 * @param ChapterEntityCollectionInterface $chapters The chapters to filter.
	 * @param string $canonicalChapterName The canonical chapter name.
	 * @return ?ChapterEntityInterface The chapter if found, otherwise null.
	 */
	private function filterChaptersByCanonicalChapterName( ChapterEntityCollectionInterface $chapters, string $canonicalChapterName ): ?ChapterEntityInterface
	{
		foreach ( $chapters as $chapter )
		{
			if ( $chapter->getCanonicalName() === $canonicalChapterName )
			{
				return $chapter;
			}

			if ( 0 !== count( $chapter->getSubChapters() ) )
			{
				return $this->filterChaptersByCanonicalChapterName( $chapter->getSubChapters(), $canonicalChapterName );
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findChapterByCanonicalChapterName( string $canonicalChapterName ): ?ChapterEntityInterface
	{
		foreach ( $this as $book )
		{
			$chapter = $this->filterChaptersByCanonicalChapterName( $book->getChapters(), $canonicalChapterName );

			if ( null !== $chapter )
			{
				return $chapter;
			}
		}

		return null;
	}
}
