<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways\Property;

class NodeSet extends Node implements NodeSetInterface
{		
	private $properties;
//	private $propertiesValue;
//	private $propertiesData;
	protected $type = 'node_set';
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
		$property['properties'] = $arrayProps;		
		$property['collapsed'] = $this->collapsed;		
		return $property; 
	}
    
	public function setValue( $values ) { 
        foreach ($this->properties as $key => $property) {
            $property->setValue($values[$key]['value']);
        }
    }
    
    public function setCollapsed( $collapsed ) { $this->collapsed = $collapsed; }
	public function getCollapsed() { return $this->collapsed; }
        
	public function propertiesToArray() { return $this->properties;}
    
	public function addProperty($addedProperty) {
//            foreach ($this->propertiesValue as $propertyValue) {
//                if($addedProperty->getKey()==$propertyValue['key']) {
//                    $addedProperty->setValue($propertyValue['value']);
//                }
//            }
            $this->properties[] = $addedProperty;
        }
    
	public function removeProperty($removedProperty) { 
    }
  
}