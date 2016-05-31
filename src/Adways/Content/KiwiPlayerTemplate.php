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
        if (isset($this->data['.ContentTemplateRPC::PROJECT.']) && isset($this->data['.ContentTemplateRPC::PROJECT.']['.ContentTemplateRPC::CURRENT.']) && isset($this->data['.ContentTemplateRPC::PROJECT.']['.ContentTemplateRPC::CURRENT.']['.ContentTemplateRPC::MEDIA.'])) {
            $this->media = $this->data['.ContentTemplateRPC::PROJECT.']['.ContentTemplateRPC::CURRENT.']['.ContentTemplateRPC::MEDIA.'];
        }	
	}

    public function getMedia() {
        return $this->media;
    }

}
