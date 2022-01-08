<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities;

use CodeKandis\Entities\AbstractEntity;

/**
 * Represents the base class of any persistable entity.
 * @package codekandis\hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractPersistableEntity extends AbstractEntity implements EntityInterface
{
	/**
	 * Stores the ID of the entity.
	 * @var string
	 */
	public string $id = '';

	/**
	 * {@inheritDoc}
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * {@inheritDoc}
	 */
	public function setId( string $id ): void
	{
		$this->id = $id;
	}
}
