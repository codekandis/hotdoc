<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Generators;

/**
 * Represents an enumeration of selected states.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class SelectedStates
{
	/**
	 * Represents the selected state `DESELECTED`.
	 * @var string
	 */
	public const DESELECTED = 'DESELECTED';

	/**
	 * Represents the selected state `SELECTED`.
	 * @var string
	 */
	public const SELECTED = 'SELECTED';
}
