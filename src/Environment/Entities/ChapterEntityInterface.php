<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities;

use CodeKandis\Entities\EntityInterface;
use CodeKandis\HotDoc\Environment\Entities\Collections\ChapterEntityCollectionInterface;

/**
 * Represents the interface of any chapter entity.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ChapterEntityInterface extends EntityInterface
{
	/**
	 * Gets the canonical name.
	 * @return string The canonical name.
	 */
	public function getCanonicalName(): string;

	/**
	 * Sets the canonical name.
	 * @param string $canonicalName The canonical name.
	 */
	public function setCanonicalName( string $canonicalName ): void;

	/**
	 * Gets the name.
	 * @return string The name.
	 */
	public function getName(): string;

	/**
	 * Sets the name.
	 * @param string $name The name.
	 */
	public function setName( string $name ): void;

	/**
	 * Gets the subchapters.
	 * @return ChapterEntityCollectionInterface The subchapters.
	 */
	public function getSubChapters(): ChapterEntityCollectionInterface;

	/**
	 * Sets the subchapters.
	 * @param ChapterEntityCollectionInterface $subChapters The subchapters.
	 */
	public function setSubChapters( ChapterEntityCollectionInterface $subChapters ): void;
}
