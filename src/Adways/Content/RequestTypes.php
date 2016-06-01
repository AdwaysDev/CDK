<?php
namespace Adways\Content;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
 

class RequestTypes
{	
	const UNDEFINED = ContentTemplateRPC::REQUEST_TYPE_UNDEFINED;
	const PROPERTIES = ContentTemplateRPC::REQUEST_TYPE_PROPERTIES;
	const CLIENT = ContentTemplateRPC::REQUEST_TYPE_CLIENT;
	const PAGE = ContentTemplateRPC::REQUEST_TYPE_PAGE;
}