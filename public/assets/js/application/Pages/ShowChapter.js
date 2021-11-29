'use strict';

import DomDocument from '../../library/Dom/DomDocument.js';
import LineNumberer from '../CodeBlockDecorators/LineNumberer.js';
import SyntaxHighlighter from '../CodeBlockDecorators/SyntaxHighlighter.js';

DomDocument.load(
	( event ) =>
	{
		( new SyntaxHighlighter() ).decorate();
		( new LineNumberer() ).decorate();
	}
);
