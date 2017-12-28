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
    private $tags = array();
    
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
    public function addStudioUIConfig($key, $value) {
        $this->studioUIConfig[$key] = $value;
    }
    public function addTag($tag) {
        $this->tags[] = $tag;
    }
    public function removeTag($tag) {
        array_splice($this->tags, array_search($tag, $this->tags), 1);
    }
    
    protected function getData() {        
        $data =  parent::getData();      
        $data[ContentTemplateRPC::CONTENT_PERMANENT_ENTITY] = $this->permanentEntity;   
        $data[ContentTemplateRPC::CONTENT_STUDIO_UI] = $this->studioUIConfig;
        $data[ContentTemplateRPC::CONTENT_STUDIO_ENTITY_TAGS] = $this->tags;
        return $data;
    }
}