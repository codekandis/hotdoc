'use strict';

import DomHelper from '../../library/Dom/DomHelper.js';
import SelectDomEvents from '../../library/Dom/Events/SelectDomEvents.js';
import BaseClass from '../../library/Types/BaseClass.js';
import BookChaptersGenerator from './BookChaptersGenerator.js';

class BookSelector extends BaseClass
{
	#bookCatalog;
	#bookDeterminator;
	#booksSelectElementSelector;
	#booksSelectElement;
	#chaptersContainerElementSelector;
	#chaptersContainerElement;

	constructor( bookCatalog, bookDeterminator, booksSelectElementSelector, chaptersContainerElementSelector )
	{
		super();

		this.#bookCatalog                      = bookCatalog;
		this.#bookDeterminator                 = bookDeterminator;
		this.#booksSelectElementSelector       = booksSelectElementSelector;
		this.#chaptersContainerElementSelector = chaptersContainerElementSelector;
	}

	#bookSelectedEventHandler( event )
	{
		this.#updateChapters(
			this.#bookCatalog.findChaptersByCanonicalBookName( this.#booksSelectElement.value )
		);
	};

	#updateChapters( chapters )
	{
		const generatedChapters = ( new BookChaptersGenerator(
			chapters,
			this.#bookDeterminator.determineChapter()
		) )
			.generate();

		if ( null === generatedChapters )
		{
			this.#chaptersContainerElement.replaceChildren();

			return;
		}

		this.#chaptersContainerElement.replaceChildren( generatedChapters );
	}

	#select()
	{
		const book = this.#bookDeterminator.determineBook();

		let selectedCanonicalName;
		switch ( book )
		{
			case null:
			{
				selectedCanonicalName = '';

				break;
			}
			default:
			{
				selectedCanonicalName = true === [ ...this.#booksSelectElement.options ]
					.one(
						( option ) =>
						{
							return option.value === book.canonicalName;
						}
					)
					? ''
					: book.canonicalName;
			}
		}

		this.#booksSelectElement.value = selectedCanonicalName;

		this.#updateChapters( this.#bookCatalog.findChaptersByCanonicalBookName( selectedCanonicalName ) );
	}

	register()
	{
		this.#booksSelectElement       = DomHelper.querySelector( this.#booksSelectElementSelector );
		this.#chaptersContainerElement = DomHelper.querySelector( this.#chaptersContainerElementSelector );

		DomHelper.addEventHandlers(
			this.#booksSelectElement,
			{
				[ SelectDomEvents.CHANGE ]: this.bindToEventHandler( this.#bookSelectedEventHandler )
			}
		);

		this.#select();
	}
}

export default BookSelector;
