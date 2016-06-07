<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class DefaultNodeSet extends NodeSet{		
	private $category;
	protected $type = ContentTemplateRPC::PROPERTY_TYPE_DEFAULT_NODE_SET;
	 
	public function __construct($key, $label = '', $tooltip = '', $representation = null, $defaultValue = '', $reloadPageOnChange = true,
            $reloadPropertiesOnChange = false, $category = null) {
        parent::__construct($key, $label, $tooltip, $representation, $defaultValue, $reloadPageOnChange, $reloadPropertiesOnChange, false);		
		        $this->category = ($category != null) ? $category : Categories::CONTENT;	
	}
	
	public function getData() {
		$property = parent::getData();		
		$property[ContentTemplateRPC::PROPERTY_CATEGORY] = $this->category;		
		return $property; 
	}
    
	public function getCategory() { return $this->category; }        
}