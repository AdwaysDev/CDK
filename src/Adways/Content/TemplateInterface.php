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
	public function getDeactivationDelay();
	public function setDeactivationDelay( $int );
    
    public function getEnrichment();
    
    //Deals with content size. In current kiwi implementation content size = enrichment size.
	public function setDesiredWidth($desiredWidth);
	public function setDesiredHeight($desiredHeight); 
    
	public function getDesiredWidth();
	public function getDesiredHeight();
    
    public function setLockWidth($lockWidth);    
	public function setLockHeight($lockHeight);    
    
    public function getLockWidth();
	public function getLockHeight();
    

}
