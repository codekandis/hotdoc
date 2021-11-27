'use strict';

import DebugMode from '../library/Debugging/DebugMode.js';
import DomDocument from '../library/Dom/DomDocument.js';
import '../library/Dom/Element.js';
import '../library/Types/Array.js';
import '../library/Types/Object.js';
import '../library/Types/String.js';

DomDocument.load(
	( event ) =>
	{
		DebugMode.enable();
	}
);
