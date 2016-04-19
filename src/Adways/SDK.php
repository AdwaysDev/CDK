<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways;

class SDK implements SDKInterface
{		
	private static $version = 0.2;
	public static function getVersion() { return self::$version; }
}