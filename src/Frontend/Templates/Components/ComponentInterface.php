<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

/**
 * Represents the interface of any component.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ComponentInterface
{
	/**
	 * Renders the component.
	 * @return string The rendered component.
	 */
	public function render():string;
}
