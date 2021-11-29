<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Actions\Get;

use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollectionInterface;
use CodeKandis\HotDoc\Environment\Io\BooksDirectoryReader;
use CodeKandis\HotDoc\Frontend\Actions\AbstractAction;
use CodeKandis\Tiphy\Data\ArrayAccessor;
use CodeKandis\Tiphy\Http\Responses\HtmlTemplateResponder;
use CodeKandis\Tiphy\Http\Responses\StatusCodes;
use ReflectionException;
use function str_replace;
use function strpos;

/**
 * Represents the action to show a book.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class ShowBookAction extends AbstractAction
{
	public function execute(): void
	{
		$inputData                  = $this->getInputData();
		$requestedCanonicalBookName = $inputData[ 'canonicalBookName' ];

		$sanitizedRequestedBook = $requestedCanonicalBookName;
		while ( false !== strpos( '..', $sanitizedRequestedBook ) )
		{
			$sanitizedRequestedBook = str_replace( '..', '', $sanitizedRequestedBook );
		}

		$books = $this->readBooks();
		$data  = [
			'books'         => $books,
			'requestedBook' => $books->findBookByCanonicalBookName( $requestedCanonicalBookName ),
		];

		( new HtmlTemplateResponder(
			$this->getFrontendConfigurationRegistry()
				 ->getTemplateRendererConfiguration(),
			StatusCodes::OK,
			new ArrayAccessor( $data ),
			null,
			'show-book.phtml'
		) )
			->respond();
	}

	/**
	 * Reads the known books.
	 * @return BookEntityCollectionInterface The known books.
	 * @throws ReflectionException An error occured during an entity creation.
	 */
	private function readBooks(): BookEntityCollectionInterface
	{
		return ( new BooksDirectoryReader(
			$this
				->getFrontendConfigurationRegistry()
				->getBooksConfiguration()
				->getBooksPath()
		) )
			->read();
	}
}
