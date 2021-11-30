'use strict';

import BaseClass from '../../library/Types/BaseClass.js';

class SyntaxHighlighter extends BaseClass
{
	decorate()
	{
		hljs.configure(
			{
				languages: []
			}
		);
		hljs.highlightAll();
	}
}

export default SyntaxHighlighter;
