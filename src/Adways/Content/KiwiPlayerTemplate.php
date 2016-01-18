<?php

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Content;

class KiwiPlayerTemplate extends Template implements KiwiPlayerTemplateInterface {
    
    private $media = null;
    
    public function __construct($config = array()) {		
        parent::__construct($config);
        if (isset($this->data['project']) && isset($this->data['project']['current']) && isset($this->data['project']['current']['media'])) {
            $this->media = $this->data['project']['current']['media'];
        }	
	}

    public function getMedia() {
        return $this->media;
    }

}
