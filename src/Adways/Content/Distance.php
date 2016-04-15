<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways\Content;
use Adways\Content\CoordRefSys;

class Distance implements DistanceInterface
{		
	private $value;
	private $relative;
	private $base;
	
	public function __construct($value, $relative = true, $base = CoordRefSys::STREAM) {
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
	    
	public function setData($value, $relative, $base){ 
        $this->value = (float) $value;
        $this->relative = (bool) $relative;
        $this->base = $base; 
    }   
    
    public function getData() {
        $data = array();
        $data['value'] = $this->value;
        $data['relative'] = $this->relative;
        $data['base'] = $this->base;
        return $data;
    }
}