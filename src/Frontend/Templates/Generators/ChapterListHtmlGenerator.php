<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Generators;

use CodeKandis\Converters\UniDirectionalConverters\EnumToArrayUniDirectionalConverter;
use CodeKandis\HotDoc\Environment\Converters\BoolToCustomizedStringBiDirectionalConverter;
use CodeKandis\HotDoc\Environment\Entities\ChapterEntityInterface;
use CodeKandis\HotDoc\Environment\Entities\Collections\ChapterEntityCollectionInterface;
use function count;
use function implode;
use function sprintf;

/**
 * Represents a chapter list HTML generator.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class ChapterListHtmlGenerator implements HtmlGeneratorInterface
{
	/**
	 * Stores the chapters.
	 * @var ChapterEntityCollectionInterface
	 */
	private ChapterEntityCollectionInterface $chapters;

	/**
	 * Stores the current chapter.
	 * @var ?ChapterEntityInterface
	 */
	private ?ChapterEntityInterface $currentChapter;

	/**
	 * Constructor method.
	 * @param ChapterEntityCollectionInterface $chapters The chapters.
	 * @param ?ChapterEntityInterface $currentChapter The current selected chapter.
	 */
	public function __construct( ChapterEntityCollectionInterface $chapters, ?ChapterEntityInterface $currentChapter )
	{
		$this->chapters       = $chapters;
		$this->currentChapter = $currentChapter;
	}

	private function generateList( ChapterEntityCollectionInterface $chapters ): string
	{
		$generatedChapterItems = [];

		$boolToStringConverter = new BoolToCustomizedStringBiDirectionalConverter(
			( new EnumToArrayUniDirectionalConverter() )
				->convert( SelectedStates::class )
		);
		foreach ( $chapters as $chapter )
		{
			$generatedChapterItems[] = sprintf(
				'<li><a href="/books/%s" data-selected-state="%s">%s</a>%s</li>',
				$chapter->getCanonicalName(),
				$boolToStringConverter->convertTo(
					null !== $this->currentChapter && $chapter->getCanonicalName() === $this->currentChapter->getCanonicalName()
				),
				$chapter->getName(),
				0 === count( $chapter->getSubChapters() )
					? ''
					: $this->generateList(
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
		return $this->generateList( $this->chapters );
	}
}
