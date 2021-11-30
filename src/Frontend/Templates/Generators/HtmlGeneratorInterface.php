<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Generators;

/**
 * Represents the interface of any HTML generator.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface HtmlGeneratorInterface
{
	/**
	 * Generates the HTML.
	 * @return string The generated HTML.
	 */
	public function generate(): string;
}
