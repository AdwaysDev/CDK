<?php

namespace Adways\Content;


require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
class Enrichment implements EnrichmentInterface {

    protected $data;
    
    private $desiredBasePosition = null;
    private $desiredHorizontalPosition = null;
    private $desiredVerticalPosition = null;
    private $desiredPivot = null;
    
    private $lockBasePosition = false;
    private $lockHorizontalPosition = false;
    private $lockVerticalPosition = false;
    private $lockPivot = false;

    public function __construct() {
    }
    
    public function getData() {
        $data = array();
        
        if($this->desiredBasePosition!=null)
            $data['.ContentTemplateRPC::DESIRED_BASE_POSITION.'] = $this->desiredBasePosition;        
        if($this->desiredHorizontalPosition!=null)
            $data['.ContentTemplateRPC::DESIRED_HORIZONTAL_POSITION.'] = $this->desiredHorizontalPosition->getData();
        if($this->desiredVerticalPosition!=null)
            $data['.ContentTemplateRPC::DESIRED_VERTICAL_POSITION.'] = $this->desiredVerticalPosition->getData();
        if($this->desiredPivot!=null)
            $data['.ContentTemplateRPC::DESIRED_PIVOT.'] = $this->desiredPivot;
        
        $data['.ContentTemplateRPC::LOCK_BASE_POSITION.'] = $this->lockBasePosition;
        $data['.ContentTemplateRPC::LOCK_HORIZONTAL_POSITION.'] = $this->lockHorizontalPosition;
        $data['.ContentTemplateRPC::LOCK_VERTICAL_POSITION.'] = $this->lockVerticalPosition;
        $data['.ContentTemplateRPC::LOCK_PIVOT.'] = $this->lockPivot;

        return $data;
    }
    
    public function setDesiredBasePosition($desiredBasePosition){
        $this->desiredBasePosition = $desiredBasePosition;
    }
	public function setDesiredHorizontalPosition($desiredHorizontalPosition){
        $this->desiredHorizontalPosition = $desiredHorizontalPosition;        
    }
	public function setDesiredVerticalPosition($desiredVerticalPosition){
        $this->desiredVerticalPosition = $desiredVerticalPosition;        
    }
	public function setDesiredPivot($desiredPivot){
        $this->desiredPivot = $desiredPivot;        
    }
	public function getDesiredBasePosition(){
        return $this->desiredBasePosition;
    }
	public function getDesiredHorizontalPosition(){
        return $this->desiredHorizontalPosition;
    }
	public function getDesiredVerticalPosition(){
        return $this->desiredVerticalPosition;
    }
	public function getDesiredPivot(){
        return $this->desiredPivot;
    }
	public function setLockBasePosition($lockBasePosition){
        $this->lockBasePosition = (boolean) $lockBasePosition;        
    }    
	public function setLockHorizontalPosition($lockHorizontalPosition){
        $this->lockHorizontalPosition = (boolean) $lockHorizontalPosition;        
    }    
	public function setLockVerticalPosition($lockVerticalPosition){
        $this->lockVerticalPosition = (boolean) $lockVerticalPosition;        
    }  
	public function setLockPivot($lockPivot){
        $this->lockPivot = (boolean) $lockPivot;        
    }  
	public function getLockBasePosition(){
        return $this->lockBasePosition;
    }
	public function getLockHorizontalPosition(){
        return $this->lockHorizontalPosition;
    }
	public function getLockVerticalPosition(){
        return $this->lockVerticalPosition;
    }
	public function getLockPivot(){
        return $this->lockPivot;
    }
}
