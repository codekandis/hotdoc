<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities;

use CodeKandis\Entities\AbstractEntity;
use CodeKandis\HotDoc\Environment\Entities\Collections\ChapterEntityCollection;
use CodeKandis\HotDoc\Environment\Entities\Collections\ChapterEntityCollectionInterface;

/**
 * Represents a chapter entity.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class ChapterEntity extends AbstractEntity implements ChapterEntityInterface
{
	/**
	 * Stores the canonical name.
	 * @var string
	 */
	public string $canonicalName = '';

	/**
	 * Stores the name.
	 * @var string
	 */
	public string $name = '';

	/**
	 * Stores the subchapters.
	 * @var ChapterEntityCollectionInterface
	 */
	public ChapterEntityCollectionInterface $subChapters;

	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		$this->subChapters = new ChapterEntityCollection();
	}

	/**
	 * Gets the canonical name.
	 * @return string The canonical name.
	 */
	public function getCanonicalName(): string
	{
		return $this->canonicalName;
	}

	/**
	 * Sets the canonical name.
	 * @param string $canonicalName The canonical name.
	 */
	public function setCanonicalName( string $canonicalName ): void
	{
		$this->canonicalName = $canonicalName;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setName( string $name ): void
	{
		$this->name = $name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getSubChapters(): ChapterEntityCollectionInterface
	{
		return $this->subChapters;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setSubChapters( ChapterEntityCollectionInterface $subChapters ): void
	{
		$this->subChapters = $subChapters;
	}
}
