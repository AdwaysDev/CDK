<?php
require_once( __DIR__ . '/../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
 
namespace Adways\Content;

class PivotPresets
{	
	const TOP_LEFT = '.ContentTemplateRPC::PIVOT_PRESET_TOP_LEFT.';
	const TOP_CENTER = '.ContentTemplateRPC::PIVOT_PRESET_TOP_CENTER.';
	const TOP_RIGHT = '.ContentTemplateRPC::PIVOT_PRESET_TOP_RIGHT.';
	const MIDDLE_LEFT = '.ContentTemplateRPC::PIVOT_PRESET_MIDDLE_LEFT.';
	const MIDDLE_CENTER = '.ContentTemplateRPC::PIVOT_PRESET_MIDDLE_CENTER.';
	const MIDDLE_RIGHT = '.ContentTemplateRPC::PIVOT_PRESET_MIDDLE_RIGHT.';
	const BOTTOM_LEFT = '.ContentTemplateRPC::PIVOT_PRESET_BOTTOM_LEFT.';
	const BOTTOM_CENTER = '.ContentTemplateRPC::PIVOT_PRESET_BOTTOM_CENTER.';
	const BOTTOM_RIGHT = '.ContentTemplateRPC::PIVOT_PRESET_BOTTOM_RIGHT.';
}