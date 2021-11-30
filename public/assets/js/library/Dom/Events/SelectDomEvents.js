'use strict';

import StaticBaseClass from '../../Types/StaticBaseClass.js';

class SelectDomEvents extends StaticBaseClass
{
	static get CHANGE()
	{
		return 'change';
	}

	static get INPUT()
	{
		return 'input';
	}
}

export default SelectDomEvents;
