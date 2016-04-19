<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Content;

interface PositionInterface
{    
	public function setCoef($coef);
	public function setRelative($relative);
//	public function setBase($base);
	public function setRevert($revert);
//	public function setData($coef, $relative, /*$base,*/ $revert);
    
	public function getCoef();
	public function getRelative();
//	public function getBase();
	public function getRevert();
	public function getData();
}