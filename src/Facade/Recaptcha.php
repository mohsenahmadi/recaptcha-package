<?php

namespace Dakyaco\Recaptcha\Facade;

use Illuminate\Support\Facades\Facade;


/**
 * @method static verify($request)
 */

class Recaptcha extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'Recaptcha';
	}
}