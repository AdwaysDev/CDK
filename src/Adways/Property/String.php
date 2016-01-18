<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways\Property;

class String extends Property implements StringInterface
{
	protected $type = 'string';

	public function setValue( $value ) { $this->value = (string) $value; }
	public function setDefaultValue( $newValue ) { $this->defaultValue = (string) $newValue; }
}