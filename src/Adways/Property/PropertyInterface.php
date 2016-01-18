<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface PropertyInterface extends NodeInterface, PropertyRInterface
{
	public function setDefaultValue( $mixed );
	public function setReloadPropertiesOnChange( $int );	
	public function setReloadPageOnChange( $int );
	public function setOptions( $json );
}
