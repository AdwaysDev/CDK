<?php
require_once( __DIR__ . '/../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
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
		if(!isset($this->type)) $this->type = '.ContentTemplateRPC::REQUEST_TYPE_UNDEFINED.';				
	}
	
	public function getData() {
		$property = array();		
		$property['.ContentTemplateRPC::PROPERTY_KEY.'] = $this->key;
		$property['.ContentTemplateRPC::PROPERTY_LABEL.'] = $this->label;
		$property['.ContentTemplateRPC::PROPERTY_TOOLTIP.'] = $this->tooltip;
		$property['.ContentTemplateRPC::PROPERTY_REPRESENTATION.'] = $this->representation;
		$property['.ContentTemplateRPC::PROPERTY_PARENT.'] = $this->parentProperty;
		$property['.ContentTemplateRPC::PROPERTY_TYPE.'] = $this->type;
		
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