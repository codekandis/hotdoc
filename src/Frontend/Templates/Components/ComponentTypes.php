<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

/**
 * Represents an enumeration of component types.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class ComponentTypes
{
	/**
	 * Represents the component type of a form.
	 * @var string
	 */
	public const FORM = 'FORM';

	/**
	 * Represents the component type of a text input.
	 * @var string
	 */
	public const TEXT_INPUT = 'TEXT_INPUT';

	/**
	 * Represents the component type of a text input.
	 * @var string
	 */
	public const PASSWORD_INPUT = 'PASSWORD_INPUT';

	/**
	 * Represents the component type of a dropdown.
	 * @var string
	 */
	public const DROPDOWN = 'DROPDOWN';

	/**
	 * Represents the component type of a submit button.
	 * @var string
	 */
	public const SUBMIT_BUTTON = 'SUBMIT_BUTTON';
}
