<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Generators;

/**
 * Represents an enumeration of element purposes.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class ElementPurposes
{
	/**
	 * Represents the element purpose `BOOK_SELECTOR`.
	 * @var string
	 */
	public const BOOK_SELECTOR = 'BOOK_SELECTOR';

	/**
	 * Represents the element purpose `CHAPTER_SELECTOR`.
	 * @var string
	 */
	public const CHAPTER_SELECTOR = 'CHAPTER_SELECTOR';

	/**
	 * Represents the element purpose `USER_ACTIONS`.
	 * @var string
	 */
	public const USER_ACTIONS = 'USER_ACTIONS';
}
