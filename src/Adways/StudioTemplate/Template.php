<?php
namespace Adways\StudioTemplate;
require_once( __DIR__ . '/../../../vendor/autoload.php');

/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

use Adways\Template\Template as MasterTemplate;

class Template extends MasterTemplate implements TemplateInterface {  
    
    public function __construct($config = array()) {		
        parent::__construct($config);
	}
}

