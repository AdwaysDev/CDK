<?php

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Content;


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
            $data['desiredBasePosition'] = $this->desiredBasePosition;        
        if($this->desiredHorizontalPosition!=null)
            $data['desiredHorizontalPosition'] = $this->desiredHorizontalPosition->getData();
        if($this->desiredVerticalPosition!=null)
            $data['desiredVerticalPosition'] = $this->desiredVerticalPosition->getData();
        if($this->desiredPivot!=null)
            $data['desiredPivot'] = $this->desiredPivot;
        
        $data['lockBasePosition'] = $this->lockBasePosition;
        $data['lockHorizontalPosition'] = $this->lockHorizontalPosition;
        $data['lockVerticalPosition'] = $this->lockVerticalPosition;
        $data['lockPivot'] = $this->lockPivot;

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
