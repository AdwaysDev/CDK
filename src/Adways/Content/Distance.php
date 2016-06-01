<?php
namespace Adways\Content;

require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
use Adways\Content\Bases;

class Distance implements DistanceInterface
{		
	private $value;
	private $relative;
	private $base;
	
	public function __construct($value, $relative = true, $base = Bases::STREAM) {
		$this->value = $value;
		$this->relative = $relative;
		$this->base = $base;     
	}
    
	public function getValue() { return $this->value; }
	public function setValue( $value ) { $this->value = (float) $value; }
    
	public function getRelative() { return $this->relative; }
	public function setRelative( $relative ) { $this->relative = (bool) $relative; }
    
	public function getBase() { return $this->base; }    
	public function setBase( $base ) { $this->base = $base; }
	    
//	public function setData($value, $relative, $base){ 
//        $this->value = (float) $value;
//        $this->relative = (bool) $relative;
//        $this->base = $base; 
//    }   
    
    public function getData() {
        $data = array();
        $data[ContentTemplateRPC::PROPERTY_VALUE] = $this->value;
        $data[ContentTemplateRPC::DISTANCE_RELATIVE] = $this->relative;
        $data[ContentTemplateRPC::DISTANCE_BASE] = $this->base;
        return $data;
    }
}