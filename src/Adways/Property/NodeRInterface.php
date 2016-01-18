<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface NodeRInterface
{		
	public function getKey();
	public function getLabel();
	public function getToolTip();
	public function getRepresentation();
	public function getParentProperty();
	public function parentPropertyChangedTo($nodeSet);
}