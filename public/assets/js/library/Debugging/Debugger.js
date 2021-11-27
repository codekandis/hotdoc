'use strict';

import StaticBaseClass from '../Types/StaticBaseClass.js';
import DebugMode from './DebugMode.js';

class Debugger extends StaticBaseClass
{
	static log( ...values )
	{
		if ( DebugMode.MODE_ENABLED === DebugMode.mode )
		{
			values.forEach(
				( value ) =>
				{
					console.log( value );
				}
			);
		}
	}
}

export default Debugger;
