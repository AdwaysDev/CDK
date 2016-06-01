<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class Data
{
	private static $pool = array();
	
	public static function loadPool($properties_json = array()) {
		if (!empty($properties_json)) {
			foreach ($properties_json as $keyTab => $valueTab) {
				foreach ($valueTab as $key => $value) {
					self::parseArgumentsValue($key, $properties_json);
				}
			}
		}
	}
	
	private static function parseArgumentsValue($key, $value) {
		/** Normalement t'as juste des tableaux de key/value mais quand on stoque un noeud de properties, le "value" c'est un array ***/
        if (!is_array($value) || (isset($value[ContentTemplateRPC::PROPERTY_KEY]) && isset($value[ContentTemplateRPC::PROPERTY_VALUE]))) {
            if ($key != ContentTemplateRPC::PROPERTY_KEY) self::$pool[$key] = $value;
        }
        else {
            foreach ($value as $key => $valueEntry) {
                if ((count($valueEntry) == 2) && isset($valueEntry[ContentTemplateRPC::PROPERTY_KEY]) && isset($valueEntry[ContentTemplateRPC::PROPERTY_VALUE]))
                    self::parseArgumentsValue($valueEntry[ContentTemplateRPC::PROPERTY_KEY], $valueEntry[ContentTemplateRPC::PROPERTY_VALUE]);
                else {
                    self::parseArgumentsValue($key, $valueEntry);
                }
            }
        }
    }

	public static function getValueFromKey($key) {		
		return isset(self::$pool[$key]) ? self::$pool[$key] : null;
	}
}