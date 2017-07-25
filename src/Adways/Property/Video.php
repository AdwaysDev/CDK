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
class Video extends NodeSet implements VideoInterface {

    protected $mediaProperty = null;
    protected $selectionKind = null;
    protected $selectionProperty = null;
    protected $mp4URLProperty = null;

    public function __construct($key, $label = '', $tooltip = '') {
        parent::__construct($key, $label, $tooltip, Representations::_DEFAULT, '', true, false, false);

        $this->selectionKind = Array(
            array('key' => 'url', 'value' => 'URL'),
            array('key' => 'media', 'value' => 'Media')
        );
        $this->selectionProperty = new SimpleSelection('selectionKind_' . $key, 'Video type', '', Representations::_DEFAULT, $this->selectionKind, $this->selectionKind[0], true, true);
//
        $this->addProperty($this->selectionProperty);
        if ($this->selectionProperty->getValue()['key'] == 'url') {
        $this->mp4URLProperty = new Characters('mp4_' . $key, 'URL', '', Representations::_DEFAULT, '');
        $this->addProperty($this->mp4URLProperty);
        } else {
        $this->mediaProperty = new Media('media_' . $key, 'Upload Media', '', Representations::_DEFAULT, '');
        $this->addProperty($this->mediaProperty);
        }
    }

    public function getPath() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
        return $this->mp4URLProperty->getValue();
        } else {
            return (count($this->mediaProperty->getAssets())>0?$this->mediaProperty->getAssets()[0]->getLocation():'');
        }
    }

    public function getThumbnail() {
        if ($this->selectionProperty->getValue()['key'] == 'url') {
        return '';
        } else {
            return (count($this->mediaProperty->getThumbnails())>0?$this->mediaProperty->getThumbnails()[0]->getLocation():'');
        }
    }

}
