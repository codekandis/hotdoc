<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Io;

use CodeKandis\HotDoc\Environment\Entities\BookEntity;
use CodeKandis\HotDoc\Environment\Entities\ChapterEntity;
use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollection;
use CodeKandis\HotDoc\Environment\Entities\Collections\BookEntityCollectionInterface;
use CodeKandis\HotDoc\Environment\Entities\Collections\ChapterEntityCollection;
use CodeKandis\HotDoc\Environment\Entities\Collections\ChapterEntityCollectionInterface;
use CodeKandis\RegularExpressions\RegularExpression;
use DirectoryIterator;
use ReflectionException;
use function is_dir;
use function pathinfo;
use function sort;
use function sprintf;
use const PATHINFO_EXTENSION;

/**
 * Represents an books reader reading a directory.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class BooksDirectoryReader implements BooksReaderInterface
{
	private const REGEX_DOUBLE_DASH_PATTERN     = '~--~';

	private const REGEX_DOUBLE_DASH_REPLACEMENT = ' - ';

	private const REGEX_SINGLE_DASH_PATTERN     = '~([^ ])-([^ ])~';

	private const REGEX_SINGLE_DASH_REPLACEMENT = '$1 $2';

	/**
	 * Stores the path of the directory to read.
	 * @var string
	 */
	private string $path;

	/**
	 * Constructor method.
	 * @param string $path The path of the directory to read.
	 */
	public function __construct( string $path )
	{
		$this->path = $path;
	}

	/**
	 * Parses a canonical name and returns the parsed name.
	 * @param string $canonicalName The canonical name.
	 * @return string The parsed name.
	 */
	private function parseCanonicalName( string $canonicalName ): string
	{
		$parsedName = ( new RegularExpression( static::REGEX_DOUBLE_DASH_PATTERN ) )
			->replace( static::REGEX_DOUBLE_DASH_REPLACEMENT, $canonicalName, false );
		$parsedName = ( new RegularExpression( static::REGEX_SINGLE_DASH_PATTERN ) )
			->replace( static::REGEX_SINGLE_DASH_REPLACEMENT, $parsedName, false );

		return $parsedName;
	}

	/**
	 * Reads the known books.
	 * @return BookEntityCollectionInterface The read books.
	 * @throws ReflectionException An error occured during an entity creation.
	 */
	private function readBooks(): BookEntityCollectionInterface
	{
		$books = [];

		$directory = new DirectoryIterator( $this->path );
		/**
		 * @var DirectoryIterator $directoryEntry
		 */
		foreach ( $directory as $directoryEntry )
		{
			if ( true === $directoryEntry->isDot()
				 || false === $directoryEntry->isDir() )
			{
				continue;
			}

			$canonicalName = $directoryEntry->getBasename( '.md' );
			$books[]       = BookEntity::fromArray(
				[
					'canonicalName' => $canonicalName,
					'name'          => $this->parseCanonicalName( $canonicalName ),
					'chapters'      => $this->readChapters(
						$directoryEntry->getRealPath(),
						$canonicalName
					)
				]
			);
		}

		sort( $books );

		return new BookEntityCollection( ...$books );
	}

	/**
	 * Reads the chapters of book or chapter.
	 * @param string $path The path of the book or chapter to read its chapters.
	 * @param string $canonicalBaseName The canonicalBaseName of the book or chapter.
	 * @return ChapterEntityCollectionInterface The read chapters.
	 * @throws ReflectionException An error occured during an entity creation.
	 */
	private function readChapters( string $path, string $canonicalBaseName ): ChapterEntityCollectionInterface
	{
		$chapters = [];

		$directory = new DirectoryIterator( $path );
		/**
		 * @var DirectoryIterator $directoryEntry
		 */
		foreach ( $directory as $directoryEntry )
		{
			if ( true === $directoryEntry->isDot()
				 || true === $directoryEntry->isDir()
				 || 'md' !== pathinfo( $directoryEntry->getBasename(), PATHINFO_EXTENSION ) )
			{
				continue;
			}

			$canonicalName   = sprintf(
				'%s/%s',
				$canonicalBaseName,
				$directoryEntry->getBasename( '.md' )
			);
			$subChaptersPath = sprintf(
				'%s/%s',
				$directoryEntry->getPath(),
				$directoryEntry->getBasename( '.md' )
			);

			$chapters[] = ChapterEntity::fromArray(
				[
					'canonicalName' => $canonicalName,
					'name'          => $this->parseCanonicalName(
						$directoryEntry->getBasename( '.md' )
					),
					'subChapters'   => false === is_dir( $subChaptersPath )
						? new ChapterEntityCollection()
						: $this->readChapters( $subChaptersPath, $canonicalName )
				]
			);
		}

		sort( $chapters );

		return new ChapterEntityCollection( ...$chapters );
	}

	/**
	 * {@inheritDoc}
	 * @throws ReflectionException An error occured during an entity creation.
	 */
	public function read(): BookEntityCollectionInterface
	{
		return $this->readBooks();
	}
}
