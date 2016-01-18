<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways\Property;

class DefaultNodeSet extends NodeSet{		
	private $category;
	protected $type = 'default_node_set';
	 
	public function __construct($key, $label = '', $tooltip = '', $representation = null, $defaultValue = '', $reloadPageOnChange = true,
            $reloadPropertiesOnChange = false, $category = null) {
        parent::__construct($key, $label, $tooltip, $representation, $defaultValue, $reloadPageOnChange, $reloadPropertiesOnChange, false);		
		        $this->category = ($category != null) ? $category : Categories::CONTENT;	
	}
	
	public function getData() {
		$property = parent::getData();		
		$property['category'] = $this->category;		
		return $property; 
	}
    
	public function getCategory() { return $this->category; }        
}