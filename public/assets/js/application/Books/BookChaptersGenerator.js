'use strict';

import DomHelper from '../../library/Dom/DomHelper.js';
import BaseClass from '../../library/Types/BaseClass.js';

class BookChaptersGenerator extends BaseClass
{
	#chapters;
	#selectedChapter;

	constructor( chapters, selectedChapter )
	{
		super();

		this.#chapters        = chapters;
		this.#selectedChapter = selectedChapter;
	}

	#generateList( chapters )
	{
		const generatedChapters = chapters.map(
			( chapter ) =>
			{
				return String.format`<li><a href="/books/${ 0 }" data-is-selected="${ 1 }">${ 2 }</a>${ 3 }</li>`(
					chapter.canonicalName,
					null !== this.#selectedChapter
					&& chapter.canonicalName === this.#selectedChapter.canonicalName,
					chapter.name,
					0 === chapter.subChapters.length
						? ''
						: this.#generateList( chapter.subChapters )
				)
			}
		);

		return 0 === generatedChapters.length
			? ''
			: String.format`<ul>${ 0 }</ul>`( generatedChapters.join( '' ) );
	}

	generate()
	{
		const list = this.#generateList( this.#chapters );

		return '' === list
			? null
			: DomHelper.createElementFromString( list );
	}
}

export default BookChaptersGenerator;
