<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Content;

interface TemplateInterface
{
    public function getVersion();
    public function getJSLibPath();
    public function getEnvironment();
	public function getReloadDelay();
	public function setReloadDelay( $int );
	public function getNodeSet( $category );
	public function getRefWidth();
	public function getRefHeight();
	public function setRefWidth( $int );
	public function setRefHeight( $int );
	public function getRequireUserInput();
	public function setRequireUserInput( $boolean );
    
	public function setDesiredWidth($desiredWidth);
	public function setDesiredHeight($desiredHeight);    
	public function setDesiredBasePosition($desiredBasePosistion);
	public function setDesiredHorizontalPosition($desiredHorizontalPosition);
	public function setDesiredVerticalPosition($desiredVerticalPosition);
    
	public function getDesiredWidth();
	public function getDesiredHeight();
	public function getDesiredBasePosition();
	public function getDesiredHorizontalPosition();
	public function getDesiredVerticalPosition();
    
    public function setLockWidth($lockWidth);
	public function setLockHeight($lockHeight);    
	public function setLockBasePosition($lockBasePosition);
	public function setLockHorizontalPosition($lockHorizontalPosition);
	public function setLockVerticalPosition($lockVerticalPosition);
    
    public function getLockWidth();
	public function getLockHeight();
	public function getLockBasePosition();
	public function getLockHorizontalPosition();
	public function getLockVerticalPosition();
}
