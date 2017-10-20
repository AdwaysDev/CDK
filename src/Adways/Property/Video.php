<?php

namespace Adways\Property;

require_once( __DIR__ . '/../../../vendor/autoload.php');

use Adways\Property\SimpleSelection;
use Adways\Property\Characters;
use Adways\Property\Representations;
use Adways\Property\Media;

/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
class Video extends NodeSet implements MediaElementInterface {

    protected $mediaProperty = null;
    protected $selectionKind = null;
    protected $selectionProperty = null;
    protected $mp4URLProperty = null;
    protected $assetsSelectionProperty = null;
    protected $useAssets = false;

    public function __construct($key, $label = '', $tooltip = '', $defaultValue = '//d3iuja8fgpny0q.cloudfront.net/studio/Video_base_V13.mp4', $useAssets = false) {
        parent::__construct($key, $label, $tooltip, Representations::_DEFAULT, $defaultValue, true, false, false);

        $this->selectionKind = Array(
            array('key' => 'url', 'value' => 'URL'),
            array('key' => 'media', 'value' => 'Media')
        );
        $this->selectionProperty = new SimpleSelection('selectionKind_' . $key, 'Video type', '', Representations::_DEFAULT, $this->selectionKind, $this->selectionKind[0], true, true);
//
        $this->addProperty($this->selectionProperty);
        $this->useAssets = $useAssets;
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            $this->mp4URLProperty = new Characters('mp4_' . $key, 'URL', '', Representations::_DEFAULT, $defaultValue);
            $this->addProperty($this->mp4URLProperty);
        } else {
            $this->mediaProperty = new Media('media_' . $key, 'Upload Media', '', Representations::_DEFAULT, '');
            $this->addProperty($this->mediaProperty);
            
            if($this->useAssets && count($this->mediaProperty->getAssets()) > 0) {
                $assets = Array();
                $mediaElementsCount = 0;
                foreach ($this->mediaProperty->getAssets() as $value){
                  $assets[] = array('key' => $mediaElementsCount, 'value' => $value->getMime().' '.$value->getWidth().' x '.$value->getHeight());
                    $mediaElementsCount++;
                }   
                $this->assetsSelectionProperty = new SimpleSelection('assetsSelection_' . $value->getId(), 'Assets', '', Representations::_DEFAULT, $assets, $assets[0], true, true);
                $this->addProperty($this->assetsSelectionProperty);
            }
        }
    }

    public function getSelectionKind() {
        return $this->selectionProperty->getValue()['key'];
    }

    public function getAssets() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return null;
        } else {
            return $this->mediaProperty->getAssets();
        } 
    }

    public function getLocation() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return $this->mp4URLProperty->getValue();
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getLocation();
        } else {
            return '';
        } 
    }

    public function getThumbnail() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return '';
        } else if (count($this->mediaProperty->getThumbnails()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getThumbnails()[$assetId]->getLocation();
        }  else {
            return '';
        }
    }

    public function getMime() {        
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return 'video/mp4';
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getMime();
        } else {
            return '';
        } 
    }

    public function getWidth() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return 0;
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getWidth();
        } else {
            return 0;
        }
    }

    public function getHeight() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return 0;
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getHeight();
        } else {
            return 0;
        }
    }

    public function getRatio() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return 1;
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getRatio();
        } else {
            return 1;
        }
    }

    public function getSize() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return 0;
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getSize();
        } else {
            return 0;
        }
    }

    public function getDuration() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return 0;
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getDuration();
        } else {
            return 0;
        }
    }

    public function getFramerate() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return 0;
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getFramerate();
        } else {
            return 0;
        }
    }

    public function getBitrate() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return null;
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getBitrate();
        } else {
            return null;
        }
    }
    
    public function getMinBitrate() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return null;
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getMinBitrate();
        } else {
            return 0;
        }
    }
    
    public function getMaxBitrate() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return null;
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getMaxBitrate();
        } else {
            return 0;
        }
    }

    public function getId() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return $this->mp4URLProperty->getValue();
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            return $this->mediaProperty->getAssets()[$assetId]->getId();
        } else {
            return 0;
        }
    }
}
