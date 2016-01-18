<?php

namespace Adways\Tools;

/**
 *
 *
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 *
 * Usage example:
 * $translator = new Translator( 'path/to/lang/repository/', 'fr_FR');
 * echo $translator->translate('translation key');
 *
 */

class Translator {

    private $language;
    private $translations;

	public function __construct($path = null, $language = 'en_US') {
        $this->language = $language;
		$this->translations = array();
		
		// Check if path has been given
		// Not able to load translations if we don't where to find them
		if($path!=null) {
		
			$file_path = $path . $this->language . '.json';
			
			// Make a test to be sure the translation for given language exists
			if(!is_file($file_path)) {
				// If translation doesn't exists we load the english one (we hope this one exists too)
				$file_path = $path . 'en_US.json';
			}
			
			// Loading translation array
			$this->translations = json_decode(file_get_contents($file_path), true);
		}
    }
	
    public function translate($key, $default = '') {
		// If the given key doesnt exists, we return the default value
		// We could check, if default is empty or null, we could return the key
        return isset($this->translations[$key]) ? $this->translations[$key] : $default;
    }

    public function getTranslationsArray() {
		// Return the full translation array
        return $this->translations;
    }
}
