<?php
require_once( __DIR__ . '/../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
 
namespace Adways\Content;

class Contexts
{	
	const UNDEFINED = '.ContentTemplateRPC::CONTENT_CONTEXT_UNDEFINED.';
	const KIWI = '.ContentTemplateRPC::CONTENT_CONTEXT_KIWI.';
	const INTERACTIVE = '.ContentTemplateRPC::CONTENT_CONTEXT_INTERACTIVE.';
	const THUMBNAIL = '.ContentTemplateRPC::CONTENT_CONTEXT_THUMBNAIL.';
	const KIWI_PLAYER = '.ContentTemplateRPC::CONTENT_CONTEXT_KIWI_PLAYER.';
}