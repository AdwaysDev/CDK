<?php
namespace Adways\Content;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */


use Adways\Client;
use Adways\Content\Enrichment;
use Adways\Property\DefaultNodeSet;
use Adways\Property\Categories;
use Adways\Property\Representations;
use Adways\Property\Data;

use Adways\Template\Template as MasterTemplate;

class Template extends MasterTemplate implements TemplateInterface {  

    private $reloadPageDelay = 1;
    private $generalNodeSet;
    private $contentNodeSet;
    private $designNodeSet;
    private $requireUserInput = false;
    private $deactivationDelay = 'NaN';
    private $refWidth;
    private $refHeight;
    
    private $enrichment = null;
    private $desiredWidth = null;
    private $desiredHeight = null;    
    private $lockWidth = false;
    private $lockHeight = false;
    
    protected $staticData = array();

    public function __construct($config = array()) {
		$client_id = (isset($config[ContentTemplateRPC::PROPERTY_KEY])) ? $config[ContentTemplateRPC::PROPERTY_KEY] : null;
		$client_secret = (isset($config[ContentTemplateRPC::SECRET])) ? $config[ContentTemplateRPC::SECRET] : null;

		if(isset($config[ContentTemplateRPC::CONTENT_RELOAD_PAGE_DELAY])) $this->reloadPageDelay = $config[ContentTemplateRPC::CONTENT_RELOAD_PAGE_DELAY];
		if(isset($config[ContentTemplateRPC::CONTENT_CLICK_THROUGH])) $this->requireUserInput = $config[ContentTemplateRPC::CONTENT_CLICK_THROUGH];
		if(isset($config[ContentTemplateRPC::ENRICHMENT_DEACTIVATION_DELAY])) $this->deactivationDelay = $config[ContentTemplateRPC::ENRICHMENT_DEACTIVATION_DELAY];
		if(isset($config[ContentTemplateRPC::ADWAYS_CONTENT_JS_LIB])) $this->adwaysContentJSLib = $config[ContentTemplateRPC::ADWAYS_CONTENT_JS_LIB];
		if(isset($config[ContentTemplateRPC::ADWAYS_SERVICES_PATH])) $this->adwaysServicesPath = $config[ContentTemplateRPC::ADWAYS_SERVICES_PATH];

		$this->client = new Client($client_id, $client_secret);

		$adwRequestType = (isset($_GET[ContentTemplateRPC::REQUEST_TYPE])) ? $_GET[ContentTemplateRPC::REQUEST_TYPE] : RequestTypes::UNDEFINED;
		if($adwRequestType == ContentTemplateRPC::REQUEST_TYPE_PROPERTIES)  $this->requestProperties = true;
		
        $this->environment = new Environment();

        $customPropertyId = isset($_GET[ContentTemplateRPC::CUSTOM_PROPERTY_ID]) ? $_GET[ContentTemplateRPC::CUSTOM_PROPERTY_ID] : null;

        if (!is_null($customPropertyId)) {
            $this->data = $this->loadProperties($customPropertyId);
            
			/**** Chargement des properties, on ajoute chaque property trouvé dans un singleton ****/
			$properties_json = (isset($this->data[ContentTemplateRPC::CONTENT_PROPERTIES])) ? $this->data[ContentTemplateRPC::CONTENT_PROPERTIES] : $this->data;
			Data::loadPool($properties_json);
        }
        
        $propertyId = isset($_GET[ContentTemplateRPC::PROPERTY_ID]) ? $_GET[ContentTemplateRPC::PROPERTY_ID] : null;

        if (!is_null($propertyId)) {
            $this->data = $this->loadProperties($propertyId);
            
			/**** Chargement des properties, on ajoute chaque property trouvé dans un singleton ****/
			$properties_json = (isset($this->data[ContentTemplateRPC::CONTENT_PROPERTIES])) ? $this->data[ContentTemplateRPC::CONTENT_PROPERTIES] : $this->data;
			Data::loadPool($properties_json);
			
            if (isset($this->data[ContentTemplateRPC::META_DATA])) {
                $this->environment->setMetaData($this->data[ContentTemplateRPC::META_DATA]);
            }
            if (isset($this->data[ContentTemplateRPC::USER]) && isset($this->data[ContentTemplateRPC::USER][ContentTemplateRPC::LANGUAGE])) {
                $this->environment->setLanguage($this->data[ContentTemplateRPC::USER][ContentTemplateRPC::LANGUAGE]);
            }
        }
		
        $this->refWidth = (isset($_GET[ContentTemplateRPC::REF_WIDTH])) ? $_GET[ContentTemplateRPC::REF_WIDTH] : NAN;
        $this->refHeight = (isset($_GET[ContentTemplateRPC::REF_HEIGHT])) ? $_GET[ContentTemplateRPC::REF_HEIGHT] : NAN;

        $this->generalNodeSet = new DefaultNodeSet('generalNodeSet', 'general', 'general', Representations::_DEFAULT, '', false, false, Categories::GENERAL);
        $this->properties[] = $this->generalNodeSet;
        $this->contentNodeSet = new DefaultNodeSet('contentNodeSet', 'content', 'content', Representations::_DEFAULT, '', false, false, Categories::CONTENT);
        $this->properties[] = $this->contentNodeSet;
        $this->designNodeSet = new DefaultNodeSet('designNodeSet', 'design', 'design', Representations::_DEFAULT, '', false, false, Categories::DESIGN);
        $this->properties[] = $this->designNodeSet;

        if ($this->requestProperties) {
            header('Content-type: application/json');
            ob_start();
        }
    }
	
    public function __destruct() {
        if ($this->requestProperties) {
            ob_end_clean();

            $data = $this->getData();

            echo json_encode($data);
        }
    }

    public function getNodeSet($category) {
        switch ($category) {
            case Categories::GENERAL:
                return $this->generalNodeSet;
            case Categories::CONTENT:
                return $this->contentNodeSet;
            case Categories::DESIGN:
                return $this->designNodeSet;
        }
    }

    public function getReloadDelay() {
        return $this->reloadPageDelay;
    }

    public function getRequireUserInput() {
        return $this->requireUserInput;
    }
    
    public function getStaticData() {
        return $this->staticData;
    }
    
    public function getDeactivationDelay() {
        return $this->deactivationDelay;
    }

    public function getRefWidth() {
        return $this->refWidth;
    }

    public function getRefHeight() {
        return $this->refHeight;
    }

    public function setReloadDelay($newValue) {
        $this->reloadPageDelay = (int) $newValue;
    }

    public function setRequireUserInput($requireUserInput) {
        $this->requireUserInput = (boolean) $requireUserInput;
    }
    public function setStaticData($staticData) {
        if(is_array($staticData)) {
            $this->staticData = $staticData;
        }
    }
    public function setDeactivationDelay($deactivationDelay) {
        if(is_numeric($deactivationDelay)) {
            $this->deactivationDelay = (int) $deactivationDelay;
        } else {
            $this->deactivationDelay = 'NaN';            
        }
    }

    public function setRefWidth($refWidth) {
        $this->refWidth = (int) $refWidth;
    }

    public function setRefHeight($refHeight) {
        $this->refHeight = (int) $refHeight;
    }    
    
	public function setDesiredWidth($desiredWidth){
        $this->desiredWidth = $desiredWidth;
    }    
	public function setDesiredHeight($desiredHeight){
        $this->desiredHeight = $desiredHeight;
    }    	
    
	public function getDesiredWidth(){
        return $this->desiredWidth;
    }
	public function getDesiredHeight(){
        return $this->desiredHeight;
    }
    
    public function setLockWidth($lockWidth){
        $this->lockWidth = (boolean) $lockWidth;        
    }
	public function setLockHeight($lockHeight){
        $this->lockHeight = (boolean) $lockHeight;        
    }      
    
    public function getLockWidth(){
        return $this->lockWidth;
    }
	public function getLockHeight(){
        return $this->lockHeight;
    } 
    
    public function getEnrichment(){
        if($this->enrichment==null)
            $this->enrichment = new Enrichment();
        return $this->enrichment;
    }
    
    protected function getData() {
        $data = array();

        $data[ContentTemplateRPC::CONTENT_RELOAD_PAGE_DELAY] = $this->reloadPageDelay;
        $data[ContentTemplateRPC::CONTENT_CLICK_THROUGH] = $this->requireUserInput;

        if(is_numeric($this->deactivationDelay)) {
            $data[ContentTemplateRPC::ENRICHMENT_DEACTIVATION_DELAY] = $this->deactivationDelay;
        }

        $data[ContentTemplateRPC::CONTENT_PROPERTIES] = array();
        foreach ($this->properties as $property) {
            $data[ContentTemplateRPC::CONTENT_PROPERTIES][] = $property->getData();
        }
        
        if($this->enrichment!=null)
            $data[ContentTemplateRPC::ENRICHMENT] = $this->enrichment->getData();
        
        if(count($this->staticData>0)) {
            $data[ContentTemplateRPC::CONTENT_STATIC_DATA] = $this->staticData;
        }
                
        if($this->desiredWidth!=null)
            $data[ContentTemplateRPC::CONTENT_DESIRED_WIDTH] = $this->desiredWidth->getData(); 
        if($this->desiredHeight!=null)
            $data[ContentTemplateRPC::CONTENT_DESIRED_HEIGHT] = $this->desiredHeight->getData();     
        
        $data[ContentTemplateRPC::CONTENT_LOCK_WIDTH] = $this->lockWidth;
        $data[ContentTemplateRPC::CONTENT_LOCK_HEIGHT] = $this->lockHeight;        

        return $data;
    }
}
