<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities\Collections;

use CodeKandis\Entities\Collections\AbstractEntityCollection;
use CodeKandis\Entities\Collections\EntityExistsException;
use CodeKandis\Entities\EntityInterface;
use CodeKandis\HotDoc\Environment\Entities\BookEntityInterface;

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
}
