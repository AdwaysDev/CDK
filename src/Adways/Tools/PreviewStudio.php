<?php

namespace Adways\Tools;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;

/**
  * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class PreviewStudio
{
    protected $studioConfigEditor = array();

    public function __construct() {
        $studioConfigEditorPreview = array();
        $studioConfigEditorPreview['presets'] = array();
        $studioConfigEditorPreview['presetsOptions'] = array();
        $this->studioConfigEditor['preview'] = $studioConfigEditorPreview;
    }

    public function addPresetPreview($preset) {
        $this->studioConfigEditor['preview']['presets'][] = $preset;
    }   

    public function addCustomPreview($width, $height) {
        $this->addPresetPreview(ContentTemplateRPC::CONTENT_STUDIO_UI_EDITOR_PREVIEW_PRESETS_CUSTOM);
        $this->studioConfigEditor['preview']['presetsOptions'][] = ContentTemplateRPC::CONTENT_STUDIO_UI_EDITOR_PREVIEW_PRESETS_CUSTOM;
        $this->studioConfigEditor['preview']['presetsOptions'][ContentTemplateRPC::CONTENT_STUDIO_UI_EDITOR_PREVIEW_PRESETS_CUSTOM][ContentTemplateRPC::CONTENT_STUDIO_UI_EDITOR_PREVIEW_PRESETS_CUSTOM_WIDTH] = $width;
        $this->studioConfigEditor['preview']['presetsOptions'][ContentTemplateRPC::CONTENT_STUDIO_UI_EDITOR_PREVIEW_PRESETS_CUSTOM][ContentTemplateRPC::CONTENT_STUDIO_UI_EDITOR_PREVIEW_PRESETS_CUSTOM_HEIGHT] = $height;
    }

    public function getConfig() {
        return $this->studioConfigEditor;
    }

    // public function setValue( $value ) { 
            
    //     }
}

?>