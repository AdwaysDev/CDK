<?php
require_once( __DIR__ . '/../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways\Property;

class Time extends Number implements TimeInterface
{
	protected $type = '.ContentTemplateRPC::PROPERTY_TYPE_TIME.';
}