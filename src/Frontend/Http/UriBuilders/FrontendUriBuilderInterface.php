<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Http\UriBuilders;

/**
 * Represents the interface of any frontend URI builder.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface FrontendUriBuilderInterface
{
	/**
	 * Builds the URI of the index.
	 * @return string The URI of the index.
	 */
	public function buildIndexUri(): string;

	/**
	 * Builds the URI of the signout.
	 * @return string The URI of the signout.
	 */
	public function buildSignoutUri(): string;
}
