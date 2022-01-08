<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

/**
 * Represents an enumeration of component styles.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class ComponentStyles
{
	/**
	 * Represents the component style `none`.
	 * @var string
	 */
	public const NONE    = 'NONE';

	/**
	 * Represents the component style `default`.
	 * @var string
	 */
	public const DEFAULT = 'DEFAULT';
}
