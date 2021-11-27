'use strict';

import BaseClass from '../../library/Types/BaseClass.js';

class BookCatalog extends BaseClass
{
	#books;

	constructor( books )
	{
		super();

		this.#books = books;
	}

	findBookByCanonicalBookName( canonicalBookName )
	{
		const book = this.#books.find(
			( book ) =>
			{
				return book.canonicalName === canonicalBookName;
			}
		);

		return undefined === book
			? null
			: book;
	}

	findChaptersByCanonicalBookName( canonicalBookName )
	{
		const book = this.findBookByCanonicalBookName( canonicalBookName );

		return null === book
			? []
			: book.chapters;
	}

	findChapterByCanonicalChapterName( canonicalChapterName )
	{
		let foundChapter = null;

		const predicate = ( chapter ) =>
		{
			if ( chapter.canonicalName === canonicalChapterName )
			{
				foundChapter = chapter;

				return true;
			}

			return undefined !== chapter.subChapters.find( predicate );
		};

		this.#books.every(
			( book ) =>
			{
				return undefined === book.chapters.find( predicate );
			}
		);

		return foundChapter;
	}
}

export default BookCatalog;
