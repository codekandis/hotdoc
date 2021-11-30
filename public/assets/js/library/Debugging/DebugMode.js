'use strict';

import StaticBaseClass from '../Types/StaticBaseClass.js';
import InvalidDebugModeException from './InvalidDebugModeException.js';

class DebugMode extends StaticBaseClass
{
	static get MODE_DISABLED()
	{
		return 'DISABLED';
	}

	static get MODE_ENABLED()
	{
		return 'ENABLED';
	}

	static #mode = DebugMode.MODE_DISABLED;

	static #validDebugModes = [
		DebugMode.MODE_DISABLED,
		DebugMode.MODE_ENABLED
	]

	static get mode()
	{
		return DebugMode.#mode;
	}

	static set mode( mode )
	{
		if ( false === this.#validDebugModes.includes( mode ) )
		{
			throw InvalidDebugModeException.with_DEBUG_MODE( mode );
		}

		DebugMode.#mode = mode;
	}

	static enable()
	{
		DebugMode.mode = DebugMode.MODE_ENABLED;
	}

	static disable()
	{
		DebugMode.mode = DebugMode.MODE_DISABLED;
	}
}

export default DebugMode;
