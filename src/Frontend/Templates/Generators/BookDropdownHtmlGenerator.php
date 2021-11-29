<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Generators;

use CodeKandis\Converters\UniDirectionalConverters\EnumToArrayUniDirectionalConverter;
use CodeKandis\HotDoc\Environment\Converters\BoolToCustomizedStringBiDirectionalConverter;
use CodeKandis\HotDoc\Environment\Entities\BookEntityInterface;
use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollectionInterface;
use function count;
use function implode;
use function sprintf;

/**
 * Represents a book dropdown HTML generator.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class BookDropdownHtmlGenerator implements HtmlGeneratorInterface
{
	/**
	 * Stores the books.
	 * @var BookEntityCollectionInterface
	 */
	private BookEntityCollectionInterface $books;

	/**
	 * Stores the current book.
	 * @var BookEntityInterface
	 */
	private BookEntityInterface $currentBook;

	/**
	 * Constructor method.
	 * @param BookEntityCollectionInterface $books The books.
	 * @param BookEntityInterface $currentBook The current selected book.
	 */
	public function __construct( BookEntityCollectionInterface $books, BookEntityInterface $currentBook )
	{
		$this->books       = $books;
		$this->currentBook = $currentBook;
	}

	private function generateSelectOptions(): string
	{
		$generatedBookItems = [];

		$boolToStringConverter = new BoolToCustomizedStringBiDirectionalConverter(
			( new EnumToArrayUniDirectionalConverter() )
				->convert( SelectedStates::class )
		);
		foreach ( $this->books as $book )
		{
			$isSelected           = $book->getCanonicalName() === $this->currentBook->getCanonicalName();
			$generatedBookItems[] = sprintf(
				'<li data-selected-state="%s"%s><a href="%s">%s</a></li>',
				$boolToStringConverter->convertTo( $isSelected ),
				$isSelected
					? ' selected'
					: '',
				sprintf(
					'/books/%s',
					$book->getCanonicalName()
				),
				$book->getName()
			);
		}

		return 0 === count( $generatedBookItems )
			? ''
			: sprintf(
				<<<END
					<div data-purpose="%s" data-component-type="dropdown">
						<input type="checkbox" id="bookSelector" />
						<label for="bookSelector">%s</label>
						<ul>%s</ul>
					</div>
				END,
				ElementPurposes::BOOK_SELECTOR,
				null === $this->currentBook
					? 'Select a book ...'
					: $this->currentBook->getName(),
				implode( '', $generatedBookItems )
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
