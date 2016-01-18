<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface PropertyRInterface
{
	public function getValue();
	
	public function getDefaultValue();
//	public function setDefaultValue( $mixed );
	public function getReloadPropertiesOnChange();	
	public function getReloadPageOnChange();
	public function getOptions();
}
