'use strict';

import BaseClass from '../../library/Types/BaseClass.js';

class BookFromUriDeterminator extends BaseClass
{
	#bookCatalog;
	#regularExpression;
	#uri;

	constructor( bookCatalog, regularExpression, uri )
	{
		super();

		this.#bookCatalog       = bookCatalog;
		this.#regularExpression = regularExpression;
		this.#uri               = uri;
	}

	determineBook()
	{
		const matches = this.#uri.match( this.#regularExpression );

		return null === matches
			? null
			: this.#bookCatalog.findBookByCanonicalBookName( matches.groups.canonicalBookName );
	}

	determineChapter()
	{
		const matches = this.#uri.match( this.#regularExpression );

		return null === matches
			? null
			: this.#bookCatalog.findChapterByCanonicalChapterName(
				String.format`${ 0 }/${ 1 }`(
					this.determineBook().canonicalName,
					matches.groups.canonicalChapterName
				)
			);
	}
}

export default BookFromUriDeterminator;
