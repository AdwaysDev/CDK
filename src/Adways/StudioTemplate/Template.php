<?php
namespace Adways\StudioTemplate;
require_once( __DIR__ . '/../../../vendor/autoload.php');

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

use Adways\Template\Template as MasterTemplate;

class Template extends MasterTemplate implements TemplateInterface {  
    
    private $permanentEntity = false;
    private $studioUIConfig = array();
    
    public function __construct($config = array()) {		
        parent::__construct($config);
	}
        
	public function setPermanentEntity($permanentEntity){
        $this->permanentEntity = (boolean) $permanentEntity;        
    }      
	public function getPermanentEntity(){
        return $this->permanentEntity;
    } 
	public function getStudioUIConfig(){
        return $this->studioUIConfig;
    }    
    public function addStudioUIConfig($config) {
        $this->studioUIConfig[] = $config;
    }
    
    protected function getData() {
        $data = array();        
        $data[ContentTemplateRPC::CONTENT_PROPERTIES] = array();
        if($this->properties != null) {
            foreach ($this->properties as $property) {
                $data[ContentTemplateRPC::CONTENT_PROPERTIES][] = $property->getData();
            }        
        }
        
        $data[ContentTemplateRPC::CONTENT_PERMANENT_ENTITY] = $this->permanentEntity;   
        $data[ContentTemplateRPC::CONTENT_STUDIO_UI] = $this->studioUIConfig;

        return $data;
    }
}

