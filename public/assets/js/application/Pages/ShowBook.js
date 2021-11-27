'use strict';

import DomDocument from '../../library/Dom/DomDocument.js';
import BookCatalog from '../Books/BookCatalog.js';
import BookFromUriDeterminator from '../Books/BookFromUriDeterminator.js';
import BookSelector from '../Books/BookSelector.js';
import '../Core.js';

DomDocument.load(
	( event ) =>
	{
		const bookCatalog      = new BookCatalog( books );
		const bookDeterminator = new BookFromUriDeterminator(
			bookCatalog,
			/^\/books\/(?<canonicalBookName>.+?)(:?\/(?<canonicalChapterName>.+))?$/,
			window.location.pathname
		);
		const bookSelector     = new BookSelector( bookCatalog, bookDeterminator, '.sidebar.left .content select', '.sidebar.left .content div' );
		bookSelector.register();
	}
);
