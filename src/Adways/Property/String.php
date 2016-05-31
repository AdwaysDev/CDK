<?php
require_once( __DIR__ . '/../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways\Property;

class String extends Property implements StringInterface
{
	protected $type = '.ContentTemplateRPC::PROPERTY_TYPE_STRING.';

	public function setValue( $value ) { $this->value = (string) $value; }
	public function setDefaultValue( $newValue ) { $this->defaultValue = (string) $newValue; }
}