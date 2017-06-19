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
        $this->value = json_decode((string) $value);
        $this->mime = $this->value->mime;
        $this->xkey = $this->value->xkey;
        $this->path = $this->value->path;
        $this->name = $this->value->name;
        $this->id = $this->value->id;
        
        $mediaElementsCount = 0;
        foreach ($this->value->assets as $asset) {
            $mediaElement = new MediaElement($this->id+'_mediaElement_'+$mediaElementsCount, '', '', Representations::_DEFAULT, $asset);
            $this->assets[] = $mediaElement;
            $mediaElementsCount++;
        }
        
        $thumbnailCount = 0;	
        foreach ($this->value->thumbnails as $thumbnail) {
            $mediaElement = new MediaElement($this->id+'_thumbnail_'+$thumbnailCount, '', '', Representations::_DEFAULT, $thumbnail);
            $this->thumbnails[] = $mediaElement;
            $thumbnailCount++;
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
/*
 "{"mime":"video/x-adways","xkey":null,"path":"Haribo TAGADA - Pub 2016 - Kids Voices.mp4","thumbnails":["607","608"],"assets":[{"state":1,"location":"https://d2zmjmh9pxcrfq.cloudfront.net/64/assets/bcpfeaz-output-720-auto.mp4","mime":"video/mp4","width":1280,"height":720,"ratio":1.778,"size":6133876,"duration":30,"framerate":"29.97","bitrate":0,"id":605,"created":"2017-06-19 14:33:47","author":1,"updated":"2017-06-19 14:33:47","updator":1,"level":15,"min_bitrate":200,"max_bitrate":1300,"buffer_size":13000,"_links":{"self":{"href":"http://192.168.1.110/adways/services/public/media-element/605"}}},{"state":1,"location":"https://d2zmjmh9pxcrfq.cloudfront.net/64/assets/bcpfeaz-output-360-auto.mp4","mime":"video/mp4","width":640,"height":360,"ratio":1.778,"size":3952227,"duration":30,"framerate":"29.97","bitrate":0,"id":606,"created":"2017-06-19 14:33:48","author":1,"updated":"2017-06-19 14:33:48","updator":1,"level":15,"min_bitrate":200,"max_bitrate":1300,"buffer_size":13000,"_links":{"self":{"href":"http://192.168.1.110/adways/services/public/media-element/606"}}}],"name":"Haribo TAGADA - Pub 2016 - Kids Voices.mp4","state":1,"id":64,"created":"2017-06-19 14:33:22","author":1,"updated":"2017-06-19 14:33:53","updator":1,"level":15,"_links":{"self":{"href":"http://192.168.1.110/adways/services/public/media/64"}}}" 
 */
/*
{
    "mime":"video/x-adways",
     "xkey":null,
     "path":"Haribo TAGADA - Pub 2016 - Kids Voices.mp4",
     "thumbnails":["607", "608"],
     "assets":[
        {
            "location":"https://d2zmjmh9pxcrfq.cloudfront.net/64/assets/bcpfeaz-output-720-auto.mp4",
             "mime":"video/mp4",
             "width":1280,
             "height":720,
             "ratio":1.778,
             "size":6133876,
             "duration":30,
             "framerate":"29.97",
             "bitrate":0,
             "id":605 
        },
         {
            "location":"https://d2zmjmh9pxcrfq.cloudfront.net/64/assets/bcpfeaz-output-360-auto.mp4",
             "mime":"video/mp4",
             "width":640,
             "height":360,
             "ratio":1.778,
             "size":3952227,
             "duration":30,
             "framerate":"29.97",
             "bitrate":0,
             "id":606
         }
    ],
     "name":"Haribo TAGADA - Pub 2016 - Kids Voices.mp4",
     "id":64
}*/