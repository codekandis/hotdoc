<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Actions\Get;

use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollectionInterface;
use CodeKandis\HotDoc\Environment\Io\BooksDirectoryReader;
use CodeKandis\HotDoc\Frontend\Actions\AbstractAction;
use CodeKandis\Tiphy\Data\ArrayAccessor;
use CodeKandis\Tiphy\Http\Responses\HtmlTemplateResponder;
use CodeKandis\Tiphy\Http\Responses\StatusCodes;
use ReflectionException;

/**
 * Represents the action to show the index.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class ShowIndexAction extends AbstractAction
{
	public function execute(): void
	{
		$books = $this->readBooks();
		$data  = [
			'signedInUser' => $this->getSignedInUser(),
			'books'        => $books
		];

		( new HtmlTemplateResponder(
			$this->getFrontendConfigurationRegistry()
				 ->getTemplateRendererConfiguration(),
			StatusCodes::OK,
			new ArrayAccessor( $data ),
			null,
			'show-index.phtml'
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
