<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\StudioPlugin;


interface PluginInterface
{
    public function getVersion();
    public function getJSLibPath();
    public function getEnvironment();
    
	public function getRefreshInterval();
	public function setRefreshInterval( $int );
    
	public function getNodeSet( $category );

	public function getMedia();
        
	public function getCallbackString();    
	public function setCallbackString($string);
    
	public function getExecuteCallback();    
	public function setExecuteCallback($boolean);    
    
	public function addProperty($property);
    
}
