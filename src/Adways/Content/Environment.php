<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways\Content;

class Environment implements EnvironmentInterface
{		
	private $context;
	private $metaData = null;
	private $language = "en_US";
	
	public function __construct() {
        if(isset($_GET['adw_context'])) {
            switch($_GET['adw_context']) {
                case 'kiwi':
                    $this->context = Contexts::KIWI;
                break;
                case 'interactive':
                    $this->context = Contexts::INTERACTIVE;
                break;
                case 'thumbnail':
                    $this->context = Contexts::THUMBNAIL;
                break;
                default:
                    $this->context = Contexts::UNDEFINED;
                break;
            }
        }
        else {
            $this->context = Contexts::UNDEFINED;
        }
//        $this->metaData = array();
	}
	
	public function getContext() {
        return $this->context;
	}
	
	public function getMetaData($which = null) {
        if($which == null) {
            return $this->metaData;
        } else {
            if($this->metaData!=null && isset($this->metaData[$which])) {
                return ($this->metaData[$which]);
            }
            else {
                return null;
            }
        }
	}

    public function setMetaData($metadata) {
        $this->metaData = (array) $metadata;
    }
    
	public function getLanguage() {
        return $this->language;
	}

    public function setLanguage($language) {
        $this->language = (string) $language;
    }
}