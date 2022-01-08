<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities;

use CodeKandis\Entities\EntityInterface as OriginEntityInterface;

/**
 * Represents the interface of all entities.
 * @package codekandis\hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface EntityInterface extends OriginEntityInterface
{
	/**
	 * Gets the ID of the entity.
	 * @return string The ID of the entity.
	 */
	public function getId(): string;

	/**
	 * Sets the ID of the entity.
	 * @param string $id The ID of the entity1.
	 */
	public function setId( string $id ): void;
}
