'use strict';

import DomDocument from '../../library/Dom/DomDocument.js';
import SyntaxHighlighter from '../CodeBlockDecorators/SyntaxHighlighter.js';

DomDocument.load(
	( event ) =>
	{
		( new SyntaxHighlighter() ).decorate();
	}
);
