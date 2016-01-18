<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface NodeInterface extends NodeRInterface
{		
	public function setLabel($label);
	public function setTooltip($tooltip);
	public function setRepresentation($representation);
}