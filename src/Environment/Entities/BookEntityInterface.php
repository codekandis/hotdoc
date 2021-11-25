<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities;

use CodeKandis\Entities\EntityInterface;
use CodeKandis\HotDoc\Environment\Entities\Collections\ChapterEntityCollectionInterface;

/**
 * Represents the interface of any book entity.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface BookEntityInterface extends EntityInterface
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
	 * Gets the chapters.
	 * @return ChapterEntityCollectionInterface The chapters.
	 */
	public function getChapters(): ChapterEntityCollectionInterface;

	/**
	 * Sets the chapters.
	 * @param ChapterEntityCollectionInterface $chapters The chapters.
	 */
	public function setChapters( ChapterEntityCollectionInterface $chapters ): void;
}
