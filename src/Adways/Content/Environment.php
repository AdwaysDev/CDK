<?php

namespace Adways\Content;

require_once( __DIR__ . '/../../../vendor/autoload.php');

use Adways\Constant\IO\ContentTemplateRPC;

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
class Environment implements EnvironmentInterface {

    private $context;
    private $step;
    private $metaData = null;
    private $language = "en_US";

    public function __construct() {
        if (isset($_GET[ContentTemplateRPC::CONTENT_CONTEXT])) {
            $this->setContext($_GET[ContentTemplateRPC::CONTENT_CONTEXT]);
        } else {
            $this->context = Contexts::UNDEFINED;
        }
//        $this->metaData = array();
    }

    public function getContext() {
        return $this->context;
    }

    public function getMetaData($which = null) {
        if ($which == null) {
            return $this->metaData;
        } else {
            if ($this->metaData != null && isset($this->metaData[$which])) {
                return ($this->metaData[$which]);
            } else {
                return null;
            }
        }
    }

    public function setMetaData($metadata) {
        $this->metaData = (array) $metadata;

        if (isset($metadata[ContentTemplateRPC::CONTENT_CONTEXT])) {
            $this->setContext($metadata[ContentTemplateRPC::CONTENT_CONTEXT]);
        }
        if (isset($metadata[ContentTemplateRPC::CONTENT_STEP])) {
            $this->setStep($metadata[ContentTemplateRPC::CONTENT_STEP]);
        }
    }

    public function getLanguage() {
        return $this->language;
    }

    public function setLanguage($language) {
        $this->language = (string) $language;
    }

    private function setStep($step) {
        $this->step = $step;
    }
    
    public function getStep() {
        return $this->step;
    }

    private function setContext($context) {
        switch ($context) {
            case ContentTemplateRPC::CONTENT_CONTEXT_KIWI:
                $this->context = Contexts::KIWI;
                break;
            case ContentTemplateRPC::CONTENT_CONTEXT_INTERACTIVE:
            case 'publication':
            case 'preview':
                $this->context = Contexts::INTERACTIVE;
                break;
            case ContentTemplateRPC::CONTENT_CONTEXT_STUDIO:
                $this->context = Contexts::STUDIO;
                break;
            case ContentTemplateRPC::CONTENT_CONTEXT_KIWI_PLAYER:
                $this->context = Contexts::KIWI_PLAYER;
                break;
//            case ContentTemplateRPC::CONTENT_CONTEXT_HTML:
//                $this->context = Contexts::HTML;
//                break;
//            case ContentTemplateRPC::CONTENT_CONTEXT_PACKAGE:
//                $this->context = Contexts::PACKAGE;
//                break;
//            case ContentTemplateRPC::CONTENT_CONTEXT_PUBLISH:
//                $this->context = Contexts::PUBLISH;
//                break;
            case ContentTemplateRPC::CONTENT_CONTEXT_THUMBNAIL:
                $this->context = Contexts::THUMBNAIL;
                break;
//            case ContentTemplateRPC::CONTENT_CONTEXT_VPAID_LINEAR:
//                $this->context = Contexts::VPAID_LINEAR;
//                break;
//            case ContentTemplateRPC::CONTENT_CONTEXT_VPAID_NON_LINEAR:
//                $this->context = Contexts::VPAID_NON_LINEAR;
//                break;
            default:
                $this->context = Contexts::UNDEFINED;
                break;
        }
    }
}
