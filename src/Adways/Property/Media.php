<?php

namespace Adways\Property;

require_once( __DIR__ . '/../../../vendor/autoload.php');

use Adways\Constant\IO\ContentTemplateRPC;
use Adways\Property\MediaElement;

/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
class Media extends Property implements MediaInterface {

    protected $type = ContentTemplateRPC::PROPERTY_TYPE_MEDIA;
    protected $mime = '';
    protected $xkey = '';
    protected $path = '';
    protected $thumbnails = array();
    protected $assets = array();
    protected $name = '';
    protected $id = '';

    public function __construct($key, $label = '', $tooltip = '', $representation = null, $defaultValue = '', $reloadPageOnChange = true, $reloadPropertiesOnChange = false, $options = null) {
        parent::__construct($key, $label, $tooltip, $representation, $defaultValue, $reloadPageOnChange, $reloadPropertiesOnChange, $options);
    }

    public function setValue($value) {
        if ($value !== '') {
            $this->value = json_decode((string) $value);
            $this->mime = $this->value->mime;
            $this->xkey = $this->value->xkey;
            $this->path = $this->value->path;
            $this->name = $this->value->name;
            $this->id = $this->value->id;

            $mediaElementsCount = 0;
            foreach ($this->value->assets as $asset) {
                $mediaElement = new MediaElement($this->id + '_mediaElement_' + $mediaElementsCount, '', '', Representations::_DEFAULT, $asset);
                $this->assets[] = $mediaElement;
                $mediaElementsCount++;
            }

            $thumbnailCount = 0;
            foreach ($this->value->thumbnails as $thumbnail) {
                $mediaElement = new MediaElement($this->id + '_thumbnail_' + $thumbnailCount, '', '', Representations::_DEFAULT, $thumbnail);
                $this->thumbnails[] = $mediaElement;
                $thumbnailCount++;
            }
        }
    }

    public function setDefaultValue($newValue) {
        $this->defaultValue = (string) $newValue;
    }

    public function getMime() {
        return $this->mime;
    }

    public function getXKey() {
        return $this->xkey;
    }

    public function getPath() {
        return $this->path;
    }

    public function getThumbnails() {
        return $this->thumbnails;
    }

    public function getAssets() {
        return $this->assets;
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }

}