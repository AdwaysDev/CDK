<?php

namespace Adways\StudioPlugin;

require_once( __DIR__ . '/../../../vendor/autoload.php');

use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
use Adways\Client;
use Adways\Content\RequestTypes;
use Adways\Content\Environment;
use Adways\Property\DefaultNodeSet;
use Adways\Property\Categories;
use Adways\Property\Representations;
use Adways\Property\Data;

class Plugin implements PluginInterface {

    private $environment;
    private $client;
    private $refreshInterval = -1;
    private $generalNodeSet;
    private $contentNodeSet;
    private $designNodeSet;
    private $media;
    private $adwaysContentJSLib = '//d1xswutoby7io3.cloudfront.net/content/js/Adways-content/1.0.0/release.Adways-min.js';
    private $adwaysServicesPath = 'https://services.adways.com/';
    private $requestProperties = false;
    private $version = 0.1;
    protected $data;
    private $callbackString;

	private $properties;

    public function __construct($config = array()) {
        $client_id = (isset($config[ContentTemplateRPC::PROPERTY_KEY])) ? $config[ContentTemplateRPC::PROPERTY_KEY] : null;
        $client_secret = (isset($config[ContentTemplateRPC::SECRET])) ? $config[ContentTemplateRPC::SECRET] : null;



        if (isset($config["refreshInterval"]))
            $this->refreshInterval = $config["refreshInterval"];

        if (isset($config["callbackString"]))
            $this->callbackString = $config["callbackString"];

        if (isset($config[ContentTemplateRPC::ADWAYS_CONTENT_JS_LIB]))
            $this->adwaysContentJSLib = $config[ContentTemplateRPC::ADWAYS_CONTENT_JS_LIB];
        if (isset($config[ContentTemplateRPC::ADWAYS_SERVICES_PATH]))
            $this->adwaysServicesPath = $config[ContentTemplateRPC::ADWAYS_SERVICES_PATH];

        $this->client = new Client($client_id, $client_secret);

        $adwRequestType = (isset($_GET[ContentTemplateRPC::REQUEST_TYPE])) ? $_GET[ContentTemplateRPC::REQUEST_TYPE] : RequestTypes::UNDEFINED;
        if ($adwRequestType == ContentTemplateRPC::REQUEST_TYPE_PROPERTIES)
            $this->requestProperties = true;

        $this->environment = new Environment();

        $propertyId = isset($_GET[ContentTemplateRPC::PROPERTY_ID]) ? $_GET[ContentTemplateRPC::PROPERTY_ID] : null;

        if (!is_null($propertyId)) {
            $this->data = $this->loadProperties($propertyId);
            /* Chargement des properties, on ajoute chaque property trouvé dans un singleton */
            $properties_json = (isset($this->data[ContentTemplateRPC::CONTENT_PROPERTIES])) ? $this->data[ContentTemplateRPC::CONTENT_PROPERTIES] : $this->data;
            Data::loadPool($properties_json);

            if (isset($this->data[ContentTemplateRPC::PROJECT]) && isset($this->data[ContentTemplateRPC::PROJECT][ContentTemplateRPC::CURRENT]) && isset($this->data[ContentTemplateRPC::PROJECT][ContentTemplateRPC::CURRENT][ContentTemplateRPC::MEDIA])) {
                $this->media = $this->data[ContentTemplateRPC::PROJECT][ContentTemplateRPC::CURRENT][ContentTemplateRPC::MEDIA];
            }

            if (isset($this->data[ContentTemplateRPC::META_DATA])) {
                $this->environment->setMetaData($this->data[ContentTemplateRPC::META_DATA]);
            }
            if (isset($this->data[ContentTemplateRPC::USER]) && isset($this->data[ContentTemplateRPC::USER][ContentTemplateRPC::LANGUAGE])) {
                $this->environment->setLanguage($this->data[ContentTemplateRPC::USER][ContentTemplateRPC::LANGUAGE]);
            }
        }

//        $this->generalNodeSet = new DefaultNodeSet('generalNodeSet', 'general', 'general', Representations::_DEFAULT, '', false, false, Categories::GENERAL);
//        $this->properties[] = $this->generalNodeSet;
//        $this->contentNodeSet = new DefaultNodeSet('contentNodeSet', 'content', 'content', Representations::_DEFAULT, '', false, false, Categories::CONTENT);
//        $this->properties[] = $this->contentNodeSet;
//        $this->designNodeSet = new DefaultNodeSet('designNodeSet', 'design', 'design', Representations::_DEFAULT, '', false, false, Categories::DESIGN);
//        $this->properties[] = $this->designNodeSet;
        $this->properties = array();

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

    public function getRefreshInterval() {
        return $this->refreshInterval;
    }

    public function setRefreshInterval($refreshInterval) {
        $this->refreshInterval = (int) $refreshInterval;
    }

    public function setEvalStringJS($evalStringJS) {
        $this->evalStringJS = (string) $evalStringJS;
    }

    public function getMethodName() {
        return $this->methodName;
    }

    public function setVersion($version) {
        $this->version = (float) $version;
    }

    private function getData() {
        $data = array();
        $data["media"] = $this->getMedia()["mime"];
        $data["refreshInterval"] = $this->refreshInterval;
        $data["callbackString"] = $this->callbackString;
        $data["executeCallback"] = $this->executeCallback;

        $data[ContentTemplateRPC::CONTENT_PROPERTIES] = array();
        foreach ($this->properties as $property) {
            $data[ContentTemplateRPC::CONTENT_PROPERTIES][] = $property->getData();
        }

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

        if (!empty($headers))
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // Send the request & save response to $resp
        $response = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);

        return json_decode($response, true);
    }

    public function getMedia() {
        return $this->media;
    }

    public function getCallbackString() {
        return $this->callbackString;
    }

    public function setCallbackString($callbackString) {
        $this->callbackString = (string) $callbackString;
    }

    public function getExecuteCallback() {
        return $this->executeCallback;
    }

    public function setExecuteCallback($executeCallback) {
        $this->executeCallback = (boolean) $executeCallback;
    }

	public function addProperty($addedProperty) {
            $this->properties[] = $addedProperty;
    }

}
