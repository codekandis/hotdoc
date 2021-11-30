<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities\Collections;

use CodeKandis\Entities\Collections\EntityCollectionInterface;
use CodeKandis\Entities\EntityInterface;
use CodeKandis\HotDoc\Environment\Entities\ChapterEntityInterface;

/**
 * Represents the interface of any collection of chapter entities.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ChapterEntityCollectionInterface extends EntityCollectionInterface
{
	/**
	 * Gets the current chapter.
	 * @return ChapterEntityInterface The current chapter.
	 */
	public function current(): EntityInterface;

	/**
	 * Gets the chapter at the specified index.
	 * @param int $index The index of the chapter.
	 * @return ChapterEntityInterface The chapter to get.
	 */
	public function offsetGet( $index ): EntityInterface;
}
