<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Generators;

use CodeKandis\Converters\UniDirectionalConverters\EnumToArrayUniDirectionalConverter;
use CodeKandis\HotDoc\Environment\Converters\BoolToCustomizedStringBiDirectionalConverter;
use CodeKandis\HotDoc\Environment\Entities\BookEntityInterface;
use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollectionInterface;
use CodeKandis\HotDoc\Frontend\Templates\Components\ComponentStyles;
use CodeKandis\HotDoc\Frontend\Templates\Components\DropDownComponent;
use function count;
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
	 * @var ?BookEntityInterface
	 */
	private ?BookEntityInterface $currentBook;

	/**
	 * Constructor method.
	 * @param BookEntityCollectionInterface $books The books.
	 * @param ?BookEntityInterface $currentBook The current selected book.
	 */
	public function __construct( BookEntityCollectionInterface $books, ?BookEntityInterface $currentBook )
	{
		$this->books       = $books;
		$this->currentBook = $currentBook;
	}

	/**
	 * {@inheritDoc}
	 */
	public function generate(): string
	{
		$generatedBookItems = [];

		$boolToStringConverter = new BoolToCustomizedStringBiDirectionalConverter(
			( new EnumToArrayUniDirectionalConverter() )
				->convert( SelectedStates::class )
		);
		foreach ( $this->books as $book )
		{
			$isSelected           = $book === $this->currentBook;
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
			: ( new DropDownComponent(
				'div',
				'bookSelectorId',
				[],
				[
					'purpose' => ElementPurposes::BOOK_SELECTOR
				],
				'bookSelector',
				'Select a book ...',
				ComponentStyles::DEFAULT,
				$generatedBookItems,
				null === $this->currentBook
					? null
					: $this->currentBook->getName(),
			) )
				->render();
	}
}
