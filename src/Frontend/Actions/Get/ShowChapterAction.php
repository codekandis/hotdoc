<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Actions\Get;

use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollectionInterface;
use CodeKandis\HotDoc\Environment\Io\BooksDirectoryReader;
use CodeKandis\HotDoc\Frontend\Actions\AbstractAction;
use CodeKandis\Tiphy\Data\ArrayAccessor;
use CodeKandis\Tiphy\Http\Responses\HtmlTemplateResponder;
use CodeKandis\Tiphy\Http\Responses\StatusCodes;
use ReflectionException;
use function sprintf;
use function str_replace;
use function strpos;

/**
 * Represents the action to show a chapter.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class ShowChapterAction extends AbstractAction
{
	public function execute(): void
	{
		$inputData                     = $this->getInputData();
		$requestedCanonicalBookName    = $inputData[ 'canonicalBookName' ];
		$requestedCanonicalChapterName = $inputData[ 'canonicalChapterName' ];

		$sanitizedRequestedBook = $requestedCanonicalBookName;
		while ( false !== strpos( '..', $sanitizedRequestedBook ) )
		{
			$sanitizedRequestedBook = str_replace( '..', '', $sanitizedRequestedBook );
		}

		$sanitizedRequestedChapter = $requestedCanonicalChapterName;
		while ( false !== strpos( '..', $sanitizedRequestedChapter ) )
		{
			$sanitizedRequestedChapter = str_replace( '..', '', $sanitizedRequestedChapter );
		}

		$documentPath = sprintf(
			'%s/%s/%s',
			$this->getFrontendConfigurationRegistry()
				 ->getBooksConfiguration()
				 ->getBooksPath(),
			$sanitizedRequestedBook,
			$sanitizedRequestedChapter
		);

		$books = $this->readBooks();
		$data  = [
			'signedInUser'     => $this->getSignedInUser(),
			'books'            => $books,
			'requestedBook'    => $books->findBookByCanonicalBookName( $requestedCanonicalBookName ),
			'requestedChapter' => $books->findChapterByCanonicalChapterName(
				sprintf(
					'%s/%s',
					$requestedCanonicalBookName,
					$requestedCanonicalChapterName
				)
			),
			'documentPath'     => $documentPath
		];

		( new HtmlTemplateResponder(
			$this->getFrontendConfigurationRegistry()
				 ->getTemplateRendererConfiguration(),
			StatusCodes::OK,
			new ArrayAccessor( $data ),
			null,
			'show-chapter.phtml'
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
