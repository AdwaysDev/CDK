<?php

namespace Adways\Content;

interface EnrichmentInterface {
    
	public function setDesiredBasePosition($desiredBasePosistion);    
	public function setDesiredHorizontalPosition($desiredHorizontalPosition);
	public function setDesiredVerticalPosition($desiredVerticalPosition);     
    
	public function getDesiredBasePosition();
	public function getDesiredHorizontalPosition();
	public function getDesiredVerticalPosition();    
    
	public function setLockBasePosition($lockBasePosition);
	public function setLockHorizontalPosition($lockHorizontalPosition);
	public function setLockVerticalPosition($lockVerticalPosition);    
    
	public function getLockBasePosition();
	public function getLockHorizontalPosition();
	public function getLockVerticalPosition();
	public function getData();
}
