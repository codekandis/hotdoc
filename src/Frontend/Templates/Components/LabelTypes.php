<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

/**
 * Represents an enumeration of label types.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class LabelTypes
{
	/**
	 * Represents no label.
	 * @var string
	 */
	public const NONE = 'NONE';

	/**
	 * Represents a detached and left positioned label.
	 * @var string
	 */
	public const DETACHED_LEFT = 'DETACHED_LEFT';

	/**
	 * Represents an attached and left positioned label.
	 * @var string
	 */
	public const ATTACHED_LEFT = 'ATTACHED_LEFT';

	/**
	 * Represents a detached and right positioned label.
	 * @var string
	 */
	public const DETACHED_RIGHT = 'DETACHED_RIGHT';

	/**
	 * Represents an attached and right positioned label.
	 * @var string
	 */
	public const ATTACHED_RIGHT = 'ATTACHED_RIGHT';

	/**
	 * Represents a detached and top positioned label.
	 * @var string
	 */
	public const DETACHED_TOP = 'DETACHED_TOP';

	/**
	 * Represents an attached and top positioned label.
	 * @var string
	 */
	public const ATTACHED_TOP = 'ATTACHED_TOP';

	/**
	 * Represents a detached and bottom positioned label.
	 * @var string
	 */
	public const DETACHED_BOTTOM = 'DETACHED_BOTTOM';

	/**
	 * Represents an attached and bottom positioned label.
	 * @var string
	 */
	public const ATTACHED_BOTTOM = 'ATTACHED_BOTTOM';
}
