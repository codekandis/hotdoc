<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

/**
 * Represents an enumeration of component subtypes.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class ComponentSubTypes
{
	/**
	 * Represents the component subtype of a header.
	 * @var string
	 */
	public const HEADER = 'HEADER';

	/**
	 * Represents the component subtype of a body.
	 * @var string
	 */
	public const BODY = 'BODY';

	/**
	 * Represents the component subtype of a footer.
	 * @var string
	 */
	public const FOOTER = 'FOOTER';
}
