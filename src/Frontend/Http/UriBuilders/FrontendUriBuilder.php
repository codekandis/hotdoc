<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Http\UriBuilders;

use CodeKandis\Tiphy\Http\UriBuilders\AbstractUriBuilder;

/**
 * Represents a frontend URI builder.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class FrontendUriBuilder extends AbstractUriBuilder implements FrontendUriBuilderInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function buildIndexUri(): string
	{
		return $this->build( 'index' );
	}

	/**
	 * {@inheritDoc}
	 */
	public function buildSignoutUri(): string
	{
		return $this->build( 'signout' );
	}
}
