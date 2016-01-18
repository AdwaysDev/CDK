<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways\Property;

abstract class Node implements NodeInterface
{		
	protected $key;
	private $label;
	private $tooltip;
	private $representation;
	private $parentProperty;
	
	public function __construct($key, $label = '', $tooltip = '', $representation = null) {		
		$this->key = $key;
		$this->label = $label;
		$this->tooltip = $tooltip;
		$this->representation = ($representation != null) ? $representation : Representations::_DEFAULT;	
		$this->parentProperty = null;	
		if(!isset($this->type)) $this->type = 'undefined';				
	}
	
	public function getData() {
		$property = array();		
		$property['key'] = $this->key;
		$property['label'] = $this->label;
		$property['tooltip'] = $this->tooltip;
		$property['representation'] = $this->representation;
		$property['parentProperty'] = $this->parentProperty;
		$property['type'] = $this->type;
		
		return $property; 
	}
	
	public function getKey() { return $this->key; }
    
	public function setLabel( $newValue ) { $this->label = $newValue; }
	public function getLabel() { return $this->label; }
    
	public function setTooltip( $newValue ) { $this->tooltip = $newValue; }
	public function getTooltip() { return $this->tooltip; }
	
	public function setRepresentation( $newValue ) { $this->representation = $newValue; }
	public function getRepresentation() { return $this->representation; }    
    
	public function getParentProperty() { return $this->parentProperty; }
	public function parentPropertyChangedTo($newValue) { $this->parentProperty = $newValue; }    
}