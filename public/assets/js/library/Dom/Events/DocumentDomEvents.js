'use strict';

import StaticBaseClass from '../../Types/StaticBaseClass.js';

class DocumentDomEvents extends StaticBaseClass
{
	static get DOM_CONTENT_LOADED()
	{
		return 'DOMContentLoaded';
	}
}

export default DocumentDomEvents;
