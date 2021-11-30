<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities\Collections;

use CodeKandis\Entities\Collections\AbstractEntityCollection;
use CodeKandis\Entities\Collections\EntityExistsException;
use CodeKandis\Entities\EntityInterface;
use CodeKandis\HotDoc\Environment\Entities\ChapterEntityInterface;

/**
 * Represents a collection of chapter entities.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class ChapterEntityCollection extends AbstractEntityCollection implements ChapterEntityCollectionInterface
{
	/**
	 * Constructor method.
	 * @param ChapterEntityInterface[] $chapters The initial chapters of the collection.
	 * @throws EntityExistsException A chapter already exists in the collection.
	 */
	public function __construct( ChapterEntityInterface ...$chapters )
	{
		parent::__construct( ...$chapters );
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
}
