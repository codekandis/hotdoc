'use strict';

import Exception from '../Types/Exception.js';

class DomElementNotFoundException extends Exception
{
	static with_UNRESOLVABLE_SELECTOR( selector )
	{
		return new DomElementNotFoundException( String.format`The selector \`${ 0 }\` cannot be resolved.`( selector ) );
	}
}

export default DomElementNotFoundException;
