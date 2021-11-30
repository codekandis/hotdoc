'use strict';

import StaticBaseClass from '../Types/StaticBaseClass.js';

class DomInsertPositions extends StaticBaseClass
{
	static get BEFORE()
	{
		return 'before';
	}

	static get AFTER()
	{
		return 'after';
	}
}

export default DomInsertPositions;
