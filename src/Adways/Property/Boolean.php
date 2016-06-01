<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
  * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class Boolean extends Property implements BooleanInterface
{
	protected $type = ContentTemplateRPC::PROPERTY_TYPE_BOOLEAN;

	public function setValue( $value ) { 
            parent::setValue($value);
            $this->value = (bool) $value; 
            
        }
	public function setDefaultValue( $newValue ) { $this->defaultValue = (bool) $newValue; }
}