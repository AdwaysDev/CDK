<?php

namespace Adways\Property;

require_once( __DIR__ . '/../../../vendor/autoload.php');

use Adways\Constant\IO\ContentTemplateRPC;

/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
class MediaElement extends Property implements PropertyInterface, MediaElementInterface {

    protected $type = ContentTemplateRPC::PROPERTY_TYPE_MEDIA_ELEMENT;
    protected $location = '';
    protected $mime = '';
    protected $width = 0;
    protected $height = 0;
    protected $ratio = 0;
    protected $size = 0;
    protected $duration = 0;
    protected $framerate = 0;
    protected $bitrate = 0;
    protected $minBitrate = null;
    protected $maxBitrate = null;
    protected $id = '';

    public function __construct($key, $label = '', $tooltip = '', $representation = null, $defaultValue = '', $reloadPageOnChange = true, $reloadPropertiesOnChange = false, $options = null) {
        parent::__construct($key, $label, $tooltip, $representation, $defaultValue, $reloadPageOnChange, $reloadPropertiesOnChange, $options);
    }

    public function setValue($value) {
        if ($value !== '') {
            $this->value = $value;
            $this->location = $this->value->location;
            $this->mime = $this->value->mime;
            $this->width = $this->value->width;
            $this->height = $this->value->height;
            $this->ratio = $this->value->ratio;
            $this->size = $this->value->size;
            $this->duration = $this->value->duration;
            $this->framerate = $this->value->framerate;
            $this->bitrate = $this->value->bitrate;
            $this->minBitrate = $this->value->min_bitrate;
            $this->maxBitrate = $this->value->max_bitrate;
            $this->id = $this->value->id;
        }
    }

    public function setDefaultValue($newValue) {
        $this->defaultValue = $newValue;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getMime() {
        return $this->mime;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getRatio() {
        return $this->ratio;
    }

    public function getSize() {
        return $this->size;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getFramerate() {
        return $this->framerate;
    }

    public function getBitrate() {
        return $this->bitrate;
    }
    
    public function getMinBitrate() {
        return $this->minBitrate;
    }
    
    public function getMaxBitrate() {
        return $this->maxBitrate;
    }

    public function getId() {
        return $this->id;
    }

}