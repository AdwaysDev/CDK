<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface SimpleSelectionInterface extends PropertyInterface, SimpleSelectionRInterface
{
	public function setSelectables($selectables);
}