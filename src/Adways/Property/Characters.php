<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class Characters extends Property implements CharactersInterface
{
	protected $type = ContentTemplateRPC::PROPERTY_TYPE_STRING;

	public function setValue( $value ) {         
            parent::setValue($value);
            $this->value = htmlentities ((string) $value);
    }
    
	public function setDefaultValue( $newValue ) { $this->defaultValue = htmlentities ((string) $newValue); }
    
}