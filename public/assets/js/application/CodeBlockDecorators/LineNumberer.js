'use strict';

import BaseClass from '../../library/Types/BaseClass.js';

class SyntaxHighlighter extends BaseClass
{
	decorate()
	{
		hljs.initLineNumbersOnLoad(
			{
				singleLine: true
			}
		);
	}
}

export default SyntaxHighlighter;
