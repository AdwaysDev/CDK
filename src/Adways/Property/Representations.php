<?php
require_once( __DIR__ . '/../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
 
namespace Adways\Property;

class Representations
{
	const _DEFAULT = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_DEFAULT.';
	const SIMPLE_LINE = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_SIMPLELINE.';
	const MULTI_LINE = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_MULTILINE.';
	const RICH_TEXT = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_RICH_TEXT.';
	const URL = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_URL.';
	const CHECK_BOX = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_CHECKBOX.';
	const BUTTON_2_STATES = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_BUTTON_2_STATES.';
	const COLOR = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_COLOR.';
//	const SLIDER_V = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_SLIDER_V.';
	const SLIDER_H = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_COLOR.';
	const HIDDEN = '.ContentTemplateRPC::PROPERTY_REPRESENTATION_HIDDEN.';
}