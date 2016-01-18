<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface NodeSetRInterface extends NodeRInterface
{
	public function propertiesToArray();
	public function getCollapsed();
}
