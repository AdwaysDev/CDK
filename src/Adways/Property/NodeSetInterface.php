<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface NodeSetInterface extends NodeSetRInterface
{
	public function addProperty($property);
	public function removeProperty($property);
	public function setCollapsed($collapsed);
}
