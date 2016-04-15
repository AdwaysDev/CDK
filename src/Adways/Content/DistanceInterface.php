<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Content;

interface DistanceInterface
{    
	public function setValue($value);
	public function setRelative($relative);
	public function setBase($base);
	public function setData($value, $relative, $base);
    
	public function getValue();
	public function getRelative();
	public function getBase();
}
