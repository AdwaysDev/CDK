<?php
namespace Adways\Content;

require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
 

class Bases
{	
	const RENDERER = ContentTemplateRPC::BASE_RENDERER;
	const STREAM = ContentTemplateRPC::BASE_STREAM;
	const PLAYER = ContentTemplateRPC::BASE_PLAYER;
}