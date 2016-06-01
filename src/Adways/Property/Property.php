<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

abstract class Property extends Node implements PropertyInterface
{		
	private $rawValue;
	private $reloadPropertiesOnChange;
	private $reloadPageOnChange;
	protected $value;
	protected $inputValue;
	protected $defaultValue;
	protected $options;
	
	public function __construct($key, $label = '', $tooltip = '', $representation = null, $defaultValue = '', $reloadPageOnChange = true, $reloadPropertiesOnChange = false, $options = null) {
        parent::__construct($key, $label, $tooltip, $representation);		
		$this->defaultValue = $defaultValue;
		$this->reloadPageOnChange = $reloadPageOnChange;
		$this->reloadPropertiesOnChange = $reloadPropertiesOnChange;
		$this->options =$options;
        
        $this->rawValue = (isset($_GET[$this->key])) ? $_GET[$this->key] : $this->defaultValue;		     

        if (!is_null(Data::getValueFromKey($this->key))) $this->rawValue = Data::getValueFromKey($this->key);
		$this->setValue($this->rawValue);
	}
	
	public function getData() {
		$property = parent::getData();		
		$property[ContentTemplateRPC::PROPERTY_DEFAULT_VALUE] = $this->defaultValue;
		$property[ContentTemplateRPC::PROPERTY_RELOAD_PAGE_ON_CHANGE] = $this->reloadPageOnChange;
		$property[ContentTemplateRPC::PROPERTY_RELOAD_PROPERTIES_ON_CHANGE] = $this->reloadPropertiesOnChange;
		$property[ContentTemplateRPC::PROPERTY_VALUE] = $this->value;    
		$property[ContentTemplateRPC::PROPERTY_OPTIONS] = $this->options;       
        
		return $property; 
	}
    
//    abstract public function setValue( $value );    // David: why public ?
    
    	public function setValue( $value ) { 
            $this->inputValue = $value; 
            $this->value = $value;
        }
        
        
	public function getValue() { return $this->value; }
	public function getInputValue() { return $this->inputValue; }
	
	public function setDefaultValue( $newValue ) { $this->defaultValue = $newValue; }
	public function getDefaultValue() { return $this->defaultValue; }
        
	public function setOptions( $options ) { $this->options = $options; }
	public function getOptions() { return $this->options; }
		
	public function setReloadPropertiesOnChange( $boolean ) { $this->reloadPropertiesOnChange = $boolean; }
	public function getReloadPropertiesOnChange() { return $this->reloadPropertiesOnChange; }
	
	public function setReloadPageOnChange( $boolean ) { $this->reloadPageOnChange = $boolean; }
	public function getReloadPageOnChange() { return $this->reloadPageOnChange; }    
	
//	public function getRawValue() { return $this->rawValue; }
	public function getValueString() { return (string) $this->getValue(); }
	public function __toString() { return $this->getValueString(); }
    
}