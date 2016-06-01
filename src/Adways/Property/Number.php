<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class Number extends Property implements NumberInterface
{
	protected $type = ContentTemplateRPC::PROPERTY_TYPE_NUMBER;
	
	public function setValue( $value ) { 
            parent::setValue($value);
            $this->value = (float) $value; 
        }
	public function setDefaultValue( $newValue ) { $this->defaultValue = (float) $newValue; }
}