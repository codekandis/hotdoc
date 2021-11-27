'use strict';

import StaticBaseClass from '../Types/StaticBaseClass.js';
import DomHelper from './DomHelper.js';
import DocumentDomEvents from './Events/DocumentDomEvents.js';

class DomDocument extends StaticBaseClass
{
	static load( handler )
	{
		DomHelper.addEventHandler(
			document,
			DocumentDomEvents.DOM_CONTENT_LOADED,
			handler
		);
	}
}

export default DomDocument;
