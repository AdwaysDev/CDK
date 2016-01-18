<?php
/**
  * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways\Property;

class Boolean extends Property implements BooleanInterface
{
	protected $type = 'boolean';

	public function setValue( $value ) { 
            parent::setValue($value);
            $this->value = (bool) $value; 
            
        }
	public function setDefaultValue( $newValue ) { $this->defaultValue = (bool) $newValue; }
}