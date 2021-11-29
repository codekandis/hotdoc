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
		$generatedBookItems = [
			sprintf(
				'<option value="" disabled%s>Select a book ...</option>',
				null === $this->currentBook
					? ' selected'
					: ''
			)
		];

		$boolToStringConverter = new BoolToCustomizedStringBiDirectionalConverter(
			( new EnumToArrayUniDirectionalConverter() )
				->convert( SelectedStates::class )
		);
		foreach ( $this->books as $book )
		{
			$isSelected           = $book === $this->currentBook;
			$generatedBookItems[] = sprintf(
				'<option value="%s" data-selected-state="%s"%s>%s</option>',
				$book->getCanonicalName(),
				$boolToStringConverter->convertTo( $isSelected ),
				$isSelected
					? ' selected'
					: '',
				$book->getName()
			);
		}

		return 0 === count( $generatedBookItems )
			? ''
			: sprintf(
				'<select data-purpose="%s">%s</select>',
				ElementPurposes::BOOK_SELECTOR,
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
