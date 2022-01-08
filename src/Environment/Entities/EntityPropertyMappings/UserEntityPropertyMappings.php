<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Entities\EntityPropertyMappings;

use CodeKandis\Entities\EntityPropertyMappings\EntityPropertyMapping;

/**
 * Represents the entity property mappings of the order entity.
 * @package codekandis\hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class UserEntityPropertyMappings extends AbstractEntityPropertyMappings
{
	/**
	 * Constructor method.
	 */
	public function __construct()
	{
		parent::__construct(
			new EntityPropertyMapping( 'isActive', null ),
			new EntityPropertyMapping( 'name', null ),
			new EntityPropertyMapping( 'eMail', null ),
			new EntityPropertyMapping( 'password', null )
		);
	}
}
