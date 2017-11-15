<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface MultiInstanceInterface extends NodeSetInterface
{
	public function getInstanceKind();
	public function getNumberOfEntry();
}
