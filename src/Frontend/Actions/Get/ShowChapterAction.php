<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Actions\Get;

use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollectionInterface;
use CodeKandis\HotDoc\Environment\Io\BooksDirectoryReader;
use CodeKandis\HotDoc\Frontend\Actions\AbstractAction;
use CodeKandis\Tiphy\Http\Responses\HtmlTemplateResponder;
use CodeKandis\Tiphy\Http\Responses\StatusCodes;
use ReflectionException;
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
		$inputData        = $this->getInputData();
		$requestedBook    = $inputData[ 'book' ];
		$requestedChapter = $inputData[ 'chapter' ];

		$sanitizedRequestedChapter = $requestedChapter;
		while ( false !== strpos( '..', $sanitizedRequestedChapter ) )
		{
			$sanitizedRequestedChapter = str_replace( '..', '', $sanitizedRequestedChapter );
		}

		$documentPath = sprintf(
			'%s/%s/%s',
			$this->getFrontendConfigurationRegistry()
				 ->getBooksConfiguration()
				 ->getBooksPath(),
			$requestedBook,
			$sanitizedRequestedChapter
		);

		( new HtmlTemplateResponder(
			$this->getFrontendConfigurationRegistry()
				 ->getTemplateRendererConfiguration(),
			StatusCodes::OK,
			[
				'books'        => $this->readBooks(),
				'documentPath' => $documentPath
			],
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
