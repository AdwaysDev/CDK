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
    const DEVICE_DESKTOP = "101";
    const DEVICE_MOBILE = "102";
    const DEVICE_ANDROID = "118";
    const DEVICE_IOS = "119";
    
    const TYPE_VAST = "103";
    const TYPE_VAST_VPAID = "104";
    const TYPE_VPAID = "105";
    const TYPE_MRAID = "106";
    const TYPE_ZIP = "107";
    const TYPE_HTML = "108";
    // const TYPE_SCRIPT = "109";
    const TYPE_MRAID_READY = "116";
    const TYPE_TAG_JS = "117";

    const KIND_LINEAR = "110";
    const KIND_NONLINEAR = "111";
    const KIND_COMPANION = "112";
    const KIND_INTERSTITIAL = "113";
    const KIND_BANNER = "114";
    const KIND_DISPLAY = "115";
}