<?php
namespace Adways\Template;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */


use Adways\Client;
use Adways\Property\Data;
use Adways\Content\RequestTypes;
use Adways\Content\Environment;


class Template implements TemplateInterface {

    protected $environment;
    protected $client;
    protected $properties;
    protected $adwaysContentJSLib = '//d1xswutoby7io3.cloudfront.net/content/js/Adways-content/1.0.0/release.Adways-min.js';
    protected $adwaysServicesPath = 'https://services.adways.com/';
    protected $requestProperties = false;
    protected $currentEntity = null;
    protected $currentEntityResource = null;
    protected $version = 0.1;
    protected $data;
    

    public function __construct($config = array()) {
		$client_id = (isset($config[ContentTemplateRPC::PROPERTY_KEY])) ? $config[ContentTemplateRPC::PROPERTY_KEY] : null;
		$client_secret = (isset($config[ContentTemplateRPC::SECRET])) ? $config[ContentTemplateRPC::SECRET] : null;

		if(isset($config[ContentTemplateRPC::ADWAYS_CONTENT_JS_LIB])) $this->adwaysContentJSLib = $config[ContentTemplateRPC::ADWAYS_CONTENT_JS_LIB];
		if(isset($config[ContentTemplateRPC::ADWAYS_SERVICES_PATH])) $this->adwaysServicesPath = $config[ContentTemplateRPC::ADWAYS_SERVICES_PATH];

		$this->client = new Client($client_id, $client_secret);

		$adwRequestType = (isset($_GET[ContentTemplateRPC::REQUEST_TYPE])) ? $_GET[ContentTemplateRPC::REQUEST_TYPE] : RequestTypes::UNDEFINED;
		if($adwRequestType == ContentTemplateRPC::REQUEST_TYPE_PROPERTIES)  $this->requestProperties = true;
		
        $this->environment = new Environment();

        $propertyId = isset($_GET[ContentTemplateRPC::PROPERTY_ID]) ? $_GET[ContentTemplateRPC::PROPERTY_ID] : null;

        if (!is_null($propertyId)) {
            $this->data = $this->loadProperties($propertyId);
            
			/**** Chargement des properties, on ajoute chaque property trouvé dans un singleton ****/
			$properties_json = (isset($this->data[ContentTemplateRPC::CONTENT_PROPERTIES])) ? $this->data[ContentTemplateRPC::CONTENT_PROPERTIES] : $this->data;
			Data::loadPool($properties_json);
			
            if (isset($this->data['entity'])) {
                $this->currentEntity = $this->data['entity'];
            }
			
            if (isset($this->data['resource'])) {
                $this->currentEntityResource = $this->data['resource'];
            }
			
            if (isset($this->data[ContentTemplateRPC::META_DATA])) {
                $this->environment->setMetaData($this->data[ContentTemplateRPC::META_DATA]);
            }
            if (isset($this->data[ContentTemplateRPC::USER]) && isset($this->data[ContentTemplateRPC::USER][ContentTemplateRPC::LANGUAGE])) {
                $this->environment->setLanguage($this->data[ContentTemplateRPC::USER][ContentTemplateRPC::LANGUAGE]);
            }
        }	

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
	
    public function getCurrentEntity() {
        return $this->currentEntity;
    }
	
    public function getCurrentEntityResource() {
        return $this->currentEntityResource;
    }
    
    public function getEnvironment() {
        return $this->environment;
    }
    
    public function getProperties() {
        return $this->properties;
    }
    
    public function addProperty($prop) {
        $this->properties[] = $prop;
    }

    public function getJSLibPath() {
        return $this->adwaysContentJSLib;
    }
    public function getVersion() {
        return $this->version;
    }
    
    public function setVersion($version) {
        $this->version = (float) $version;
    }    
    
    protected function getData() {
        $data = array();        
        $data[ContentTemplateRPC::CONTENT_PROPERTIES] = array();
        if($this->properties != null) {
            foreach ($this->properties as $property) {
                $data[ContentTemplateRPC::CONTENT_PROPERTIES][] = $property->getData();
            }        
        }

        return $data;
    }

    protected function loadProperties($propertyId) {
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
