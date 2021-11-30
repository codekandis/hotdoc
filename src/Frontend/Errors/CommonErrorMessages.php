<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Errors;

/**
 * Represents an enumeration of error messages of Common errors.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class CommonErrorMessages
{
	/**
	 * Represents an internal error.
	 * @var string
	 */
	public const INTERNAL_ERROR = 'An internal error occurred.';

	/**
	 * Represents an error if a content type is invalid.
	 * @var string
	 */
	public const INVALID_CONTENT_TYPE = 'The request content type is invalid.';

	/**
	 * Represents an error if a request body is malformed.
	 * @var string
	 */
	public const MALFORMED_REQUEST_BODY = 'The request body is malformed.';

	/**
	 * Represents an error if a request body is invalid.
	 * @var string
	 */
	public const INVALID_REQUEST_BODY = 'The request body is invalid.';
}
