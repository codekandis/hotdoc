<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Io;

use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollectionInterface;

/**
 * Represents the interface of any books reader.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
interface BooksReaderInterface
{
	/**
	 * Reads the books.
	 * @return BookEntityCollectionInterface The read books.
	 */
	public function read(): BookEntityCollectionInterface;
}
