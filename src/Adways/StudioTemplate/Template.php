<?php
namespace Adways\StudioTemplate;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;

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
        $data =  parent::getData();      
        $data[ContentTemplateRPC::CONTENT_PERMANENT_ENTITY] = $this->permanentEntity;   
        $data[ContentTemplateRPC::CONTENT_STUDIO_UI] = $this->studioUIConfig;
        return $data;
    }
}

