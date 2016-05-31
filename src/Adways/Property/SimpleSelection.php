<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class SimpleSelection extends Property implements SimpleSelectionInterface
{
	protected $type = '.ContentTemplateRPC::PROPERTY_TYPE_CONTENT_SIMPLE_SELECTION.';
    
    public function __construct($key, $label = '', $tooltip = '', $representation = null, $selectables = array(), $defaultValue = '', $reloadPageOnChange = true, $reloadPropertiesOnChange = false, $options = null) {
		parent::__construct($key, $label, $tooltip, $representation, $defaultValue, $reloadPageOnChange, $reloadPropertiesOnChange, $options);		

		$this->selectables = $selectables;
	}
        
    public function setValue( $value ) {
        parent::setValue($value);
        $this->value = (array) $value; 
    }
    
	public function setDefaultValue( $newValue ) { $this->defaultValue = (array) $newValue; }
      	

    public function getData() {
		$property = parent::getData();		
		$property['selectables'] = $this->selectables;	
		return $property; 
	}
    
	public function getSelectables() { return $this->selectables; }
	public function setSelectables( $newValue ) { $this->selectables = $newValue; }
}