<?php

namespace Adways\Content;

interface EnrichmentInterface {
    
	public function setDesiredBasePosition($desiredBasePosistion);    
	public function setDesiredHorizontalPosition($desiredHorizontalPosition);
	public function setDesiredVerticalPosition($desiredVerticalPosition);   
	public function setDesiredPivot($desiredPivot);     
    
	public function getDesiredBasePosition();
	public function getDesiredHorizontalPosition();
	public function getDesiredVerticalPosition();    
	public function getDesiredPivot();
    
	public function setLockBasePosition($lockBasePosition);
	public function setLockHorizontalPosition($lockHorizontalPosition);
	public function setLockVerticalPosition($lockVerticalPosition);    
	public function setLockPivot($lockPivot);    
    
	public function getLockBasePosition();
	public function getLockHorizontalPosition();
	public function getLockVerticalPosition();
	public function getLockPivot();
	public function getData();
}
