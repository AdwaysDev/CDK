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
    protected $vastURLProperty = null;
    protected $assetsSelectionProperty = null;
    protected $useAssets = false;
    protected $videoDomainName = null;

    public function __construct($key, $label = '', $tooltip = '', $defaultValue = '//d3iuja8fgpny0q.cloudfront.net/studio/Video_base_V13.mp4', $useAssets = false, $videoDomainName = 'videos.adpaths.com') {
        parent::__construct($key, $label, $tooltip, Representations::_DEFAULT, $defaultValue, true, false, false);

        $this->videoDomainName = $videoDomainName;
        $this->selectionKind = Array(
            array('key' => 'url', 'value' => 'URL'),
            array('key' => 'media', 'value' => 'Media'),
            array('key' => 'vast', 'value' => 'VAST-mp4 (BETA)')
        );
        $this->selectionProperty = new SimpleSelection('selectionKind_' . $key, 'Video type', '', Representations::_DEFAULT, $this->selectionKind, $this->selectionKind[0], true, true);
//
        $this->addProperty($this->selectionProperty);
        $this->useAssets = $useAssets;
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            $this->mp4URLProperty = new Characters('mp4_' . $key, 'URL', '', Representations::_DEFAULT, $defaultValue);
            $this->addProperty($this->mp4URLProperty);
        } else if ($this->selectionProperty->getValue()['key'] == 'media') {
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
            $this->vastURLProperty = new Characters('vast_' . $key, 'URL', '', Representations::_DEFAULT, '');
            $this->addProperty($this->vastURLProperty);
        }
    }

    public function getSelectionKind() {
        return $this->selectionProperty->getValue()['key'];
    }
    
    public function getVideoProps() {
        $data = array();        
		$data['kind'] = $this->selectionProperty->getValue()['key'];
		$data['location'] = $this->getLocation(true);
        return json_encode($data);
    }
    
    public function getAssets() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return null;
        } if ($this->selectionProperty->getValue()['key'] == 'media') {
            return $this->mediaProperty->getAssets();
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
            return null;
        }
    }

    public function getLocation($secure = false) {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return $this->mp4URLProperty->getValue();
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
            return  $this->vastURLProperty->getValue();
        } else if (count($this->mediaProperty->getAssets()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
            } 
            $value = $this->mediaProperty->getAssets()[$assetId]->getLocation(); 
            if($this->videoDomainName && $this->videoDomainName != null)
                $value = str_replace("dip5sgyvj5owd.cloudfront.net", $this->videoDomainName, $value);
            if($secure){
                $urlArray = parse_url($value);
                if(!isset($urlArray['scheme'])) // si pas de protocol, alors c'est un asset uploadé
                    return 'https:' . $value;
                else
                    return $value; 
            }else
                return $value;
        } else {
            return '';
        } 
    }

    public function getThumbnail() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return '';
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
            return '';
        } else if (count($this->mediaProperty->getThumbnails()) > 0) {
            $assetId = 0;
            if($this->useAssets) {
                $assetId = $this->assetsSelectionProperty->getValue()['key'];
                if($assetId >= count($this->mediaProperty->getThumbnails())) {
                    $assetId = count($this->mediaProperty->getThumbnails())-1;
                }
            } 
            return $this->mediaProperty->getThumbnails()[$assetId]->getLocation();
        }  else {
            return '';
        }
    }

    public function getMime() {        
        if ($this->selectionProperty->getValue()['key'] == 'url') {
            return 'video/mp4';
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
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
            return (16/9);
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
            return (16/9);
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
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
        } else if ($this->selectionProperty->getValue()['key'] == 'vast') {
            return $this->vastURLProperty->getValue();
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
