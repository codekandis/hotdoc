'use strict';

import InvalidStaticClassInstantiationException from './InvalidStaticClassInstantiationException.js';

class StaticBaseClass
{
	constructor()
	{
		throw InvalidStaticClassInstantiationException.with_OBJECT( this );
	}
}

export default StaticBaseClass;
