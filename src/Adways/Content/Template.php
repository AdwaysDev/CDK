<?php

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Content;

use Adways\Client;
use Adways\Content\Enrichment;
use Adways\Property\DefaultNodeSet;
use Adways\Property\Categories;
use Adways\Property\Representations;
use Adways\Property\Data;

class Template implements TemplateInterface {

    private $environment;
    private $client;
    private $reloadPageDelay = 1;
    private $generalNodeSet;
    private $contentNodeSet;
    private $designNodeSet;
    private $requireUserInput = false;
    private $refWidth;
    private $refHeight;
    private $adwaysContentJSLib = '//d1xswutoby7io3.cloudfront.net/content/js/Adways-content/1.0.0/release.Adways-min.js';
    private $adwaysServicesPath = 'https://services.adways.com/';
    private $requestProperties = false;
    private $version = 0.1;
    protected $data;
    
    private $enrichment = null;
    private $desiredWidth = null;
    private $desiredHeight = null;    
    private $lockWidth = false;
    private $lockHeight = false;

    public function __construct($config = array()) {
		$client_id = (isset($config['key'])) ? $config['key'] : null;
		$client_secret = (isset($config['secret'])) ? $config['secret'] : null;

		if(isset($config['reloadPageDelay'])) $this->reloadPageDelay = $config['reloadPageDelay'];
		if(isset($config['requireUserInput'])) $this->requireUserInput = $config['requireUserInput'];
		if(isset($config['adwaysContentJSLib'])) $this->adwaysContentJSLib = $config['adwaysContentJSLib'];
		if(isset($config['adwaysServicesPath'])) $this->adwaysServicesPath = $config['adwaysServicesPath'];

		$this->client = new Client($client_id, $client_secret);

		$adwRequestType = (isset($_GET['adw_request_type'])) ? $_GET['adw_request_type'] : RequestTypes::UNDEFINED;
		if($adwRequestType == 'prop')  $this->requestProperties = true;
		
        $this->environment = new Environment();

        $propertyId = isset($_GET['propertyId']) ? $_GET['propertyId'] : null;

        if (!is_null($propertyId)) {
            $this->data = $this->loadProperties($propertyId);
            
			/**** Chargement des properties, on ajoute chaque property trouvé dans un singleton ****/
			$properties_json = (isset($this->data['properties'])) ? $this->data['properties'] : $this->data;
			Data::loadPool($properties_json);
			
            if (isset($this->data['metadata'])) {
                $this->environment->setMetaData($this->data['metadata']);
            }
            if (isset($this->data['user']) && isset($this->data['user']['language'])) {
                $this->environment->setLanguage($this->data['user']['language']);
            }
        }
		
        $this->refWidth = (isset($_GET['ref_width'])) ? $_GET['ref_width'] : NAN;
        $this->refHeight = (isset($_GET['ref_height'])) ? $_GET['ref_height'] : NAN;

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
	
    public function getEnvironment() {
        return $this->environment;
    }

    public function getJSLibPath() {
        return $this->adwaysContentJSLib;
    }
    public function getVersion() {
        return $this->version;
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

    public function setRefWidth($refWidth) {
        $this->refWidth = (int) $refWidth;
    }

    public function setRefHeight($refHeight) {
        $this->refHeight = (int) $refHeight;
    }    

    public function setVersion($version) {
        $this->version = (float) $version;
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
    
    private function getData() {
        $data = array();

        $data['reloadPageDelay'] = $this->reloadPageDelay;
        $data['requireUserInput'] = $this->requireUserInput;

        $data['properties'] = array();
        foreach ($this->properties as $property) {
            $data['properties'][] = $property->getData();
        }
        
        if($this->enrichment!=null)
            $data['enrichment'] = $this->enrichment->getData();
        
        if($this->desiredWidth!=null)
            $data['desiredWidth'] = $this->desiredWidth->getData(); 
        if($this->desiredHeight!=null)
            $data['desiredHeight'] = $this->desiredHeight->getData();     
        
        $data['lockWidth'] = $this->lockWidth;
        $data['lockHeight'] = $this->lockHeight;        

        return $data;
    }

    private function loadProperties($propertyId) {
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here

        $options = array();
        $options[CURLOPT_RETURNTRANSFER] = 1;
        $options[CURLOPT_URL] = $this->adwaysServicesPath . 'load-properties-json/' . $propertyId;
        $options[CURLOPT_SSL_VERIFYPEER] = false;

        curl_setopt_array($curl, $options);
        $headers = array();
        $headers[] = 'Content-Type: application/json';

        if(!empty($headers)) curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);

        // Send the request & save response to $resp
        $response = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);

        return json_decode($response, true);
    }
}
