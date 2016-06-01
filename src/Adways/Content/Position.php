<?php
namespace Adways\Content;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class Position implements PositionInterface
{		
	private $coef;
	private $relative;
	private $revert;
	
	public function __construct($coef, $relative = true, $revert = false) {
		$this->coef = $coef;
		$this->relative = $relative;
		$this->revert = $revert;     
	}
    
	public function getCoef() { return $this->value; }
	public function setCoef( $value ) { $this->value = (float) $value; }
    
	public function getRelative() { return $this->relative; }
	public function setRelative( $relative ) { $this->relative = (bool) $relative; }
    
	public function getRevert() { return $this->revert; }    
	public function setRevert( $revert ) { $this->revert = $revert; }
	    
//	public function setData($value, $relative, $base){ 
//        $this->value = (float) $value;
//        $this->relative = (bool) $relative;
//        $this->base = $base; 
//    }   
    
    public function getData() {
        $data = array();
        $data[ContentTemplateRPC::POSITION_COEF] = $this->coef;
        $data[ContentTemplateRPC::POSITION_RELATIVE] = $this->relative;
        $data[ContentTemplateRPC::POSITION_REVERT] = $this->revert;
        return $data;
    }
}