<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class EnrichmentSelection extends String implements EnrichmentSelectionInterface
{
	protected $type = ContentTemplateRPC::PROPERTY_TYPE_ENRICHMENT_SELECTION;
}