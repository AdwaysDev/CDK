<?php
namespace Adways\Content;

require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
 
class Tags
{   
    const DEVICE_DESKTOP = "22";
    const DEVICE_MOBILE = "23";
    const TYPE_VAST = "24";
    const TYPE_VAST_VPAID = "25";
    const TYPE_VPAID = "26";
    const TYPE_MRAID = "27";
    const TYPE_ZIP = "28";
    const TYPE_HTML = "29";
    const TYPE_SCRIPT = "30";
    const KIND_LINEAR = "31";
    const KIND_NONLINEAR = "32";
    const KIND_COMPANION = "33";
    const KIND_INTERSTITIAL = "34";
    const KIND_BANNER = "35";
    const KIND_DISPLAY = "36";
}