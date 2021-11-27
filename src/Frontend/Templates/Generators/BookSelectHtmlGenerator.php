<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Generators;

use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollectionInterface;
use CodeKandis\HotDoc\Environment\Entities\Collections\ChapterEntityCollectionInterface;
use function count;
use function implode;
use function sprintf;

/**
 * Represents a book select HTML generator.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class BookSelectHtmlGenerator implements HtmlGeneratorInterface
{
	/**
	 * Stores the books.
	 * @var BookEntityCollectionInterface
	 */
	private BookEntityCollectionInterface $books;

	/**
	 * Constructor method.
	 * @param BookEntityCollectionInterface $books The books.
	 */
	public function __construct( BookEntityCollectionInterface $books )
	{
		$this->books = $books;
	}

	private function generateSelectOptions(): string
	{
		$generatedBookItems = [
			'<option value="" disabled="disabled" selected="selected">Select a book ...</option>'
		];
		foreach ( $this->books as $book )
		{
			$generatedBookItems[] = sprintf(
				'<option value="%s">%s</option>',
				$book->getCanonicalName(),
				$book->getName()
			);
		}

		return 0 === count( $generatedBookItems )
			? ''
			: sprintf(
				'<select>%s</select>',
				implode( '', $generatedBookItems )
			);
	}

	private function generateChaptersIndex( ChapterEntityCollectionInterface $chapters ): string
	{
		$generatedChapterItems = [];
		foreach ( $chapters as $chapter )
		{
			$generatedChapterItems[] = sprintf(
				'<li><a href="/books/%s">%s</a>%s</li>',
				$chapter->getCanonicalName(),
				$chapter->getName(),
				$this->generateChaptersIndex(
					$chapter->getSubChapters()
				)
			);
		}

		return 0 === count( $generatedChapterItems )
			? ''
			: sprintf(
				'<ul>%s</ul>',
				implode( '', $generatedChapterItems )
			);
	}

	/**
	 * {@inheritDoc}
	 */
	public function generate(): string
	{
		return $this->generateSelectOptions();
	}
}
