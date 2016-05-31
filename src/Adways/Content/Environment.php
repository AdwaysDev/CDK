<?php
require_once( __DIR__ . '/../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
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
        if(isset($_GET['.ContentTemplateRPC::CONTENT_CONTEXT.'])) {
            switch($_GET['.ContentTemplateRPC::CONTENT_CONTEXT.']) {
                case '.ContentTemplateRPC::CONTENT_CONTEXT_KIWI.':
                    $this->context = Contexts::KIWI;
                break;
                case '.ContentTemplateRPC::CONTENT_CONTEXT_INTERACTIVE.':
                    $this->context = Contexts::INTERACTIVE;
                break;
                case '.ContentTemplateRPC::CONTENT_CONTEXT_THUMBNAIL.':
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