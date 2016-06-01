<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class NodeSet extends Node implements NodeSetInterface
{		
	private $properties;
//	private $propertiesValue;
//	private $propertiesData;
	protected $type = ContentTemplateRPC::PROPERTY_TYPE_NODE_SET;
	protected $collapsed = false;
	 
	public function __construct($key, $label = '', $tooltip = '', $representation = null, $defaultValue = '', $reloadPageOnChange = true, 
            $reloadPropertiesOnChange = false, $collapsed = false) {
        parent::__construct($key, $label, $tooltip, $representation, $defaultValue, $reloadPageOnChange, $reloadPropertiesOnChange);		
		
		$this->properties = array();
		$this->collapsed = $collapsed;
//        $this->propertiesValue = (isset($_GET[$this->key])) ? $_GET[$this->key] : array();
	}
	
	public function getData() {
		$property = parent::getData();	
        $arrayProps = array();
        foreach ($this->properties as $prop) {
            $arrayProps[] = $prop->getData();
        }	
		$property[ContentTemplateRPC::CONTENT_PROPERTIES] = $arrayProps;		
		$property[ContentTemplateRPC::PROPERTY_NODE_SET_COLLAPSED] = $this->collapsed;		
		return $property; 
	}
    
	public function setValue( $values ) { 
        foreach ($this->properties as $key => $property) {
            $property->setValue($values[$key][ContentTemplateRPC::PROPERTY_VALUE]);
        }
    }
    
    public function setCollapsed( $collapsed ) { $this->collapsed = $collapsed; }
	public function getCollapsed() { return $this->collapsed; }
        
	public function propertiesToArray() { return $this->properties;}
    
	public function addProperty($addedProperty) {
//            foreach ($this->propertiesValue as $propertyValue) {
//                if($addedProperty->getKey()==$propertyValue[ContentTemplateRPC::PROPERTY_KEY]) {
//                    $addedProperty->setValue($propertyValue[ContentTemplateRPC::PROPERTY_VALUE]);
//                }
//            }
            $this->properties[] = $addedProperty;
        }
    
	public function removeProperty($removedProperty) { 
    }
  
}