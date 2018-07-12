<?php

namespace Adways\Tools\VastGenerator;
require_once( __DIR__ . '/../../../../vendor/autoload.php');

use Adways\Property\Characters;
use Adways\Property\NodeSet;
use Adways\Property\SimpleSelection;
use Adways\Property\Representations;
use Adways\Property\MultiInstance;
use Adways\Property\Boolean;
use Adways\Property\Number;
use Adways\Constant\IO\ContentTemplateRPC;
use Adways\Content\Tags;

class VastGeneratorController {

    private $protocol = 'auto';
    private $generalProps = array();
    private $trackingProps = array(); 
    private $previewProps = array(); 
    private $tracking_group = null;

    public function __construct($videoSrc = null) {
        // if($videoSrc == null)
        //     return;
        // initialisation de toutes les variables en mode props
        $this->generalProps['useDefaultVideoSlot'] = new Boolean('useDefaultVideoSlot', 'Use default video slot', '', Representations::_DEFAULT, false);
        $ListCreative = array(
            array('key' => 'linear', 'value' => 'Linear'),
            array('key' => 'nonlinear', 'value' => 'NonLinear')
        );
        $this->generalProps['selectCreative'] = new SimpleSelection('creative', 'Creative Type', '', Representations::_DEFAULT, $ListCreative, $ListCreative[0], true, true);
        $ListProtocol = array(
            array('key' => 'https', 'value' => 'HTTPS'),
            array('key' => 'http', 'value' => 'HTTP'),
            array('key' => 'auto', 'value' => 'Auto')
        );
        $this->generalProps['selectProtocol'] = new SimpleSelection('protocol', 'Protocol', '', Representations::_DEFAULT, $ListProtocol, $ListProtocol[0], true, true);

        $ListVastVersion = array(
            array('key' => '2.0', 'value' => '2.0'),
            array('key' => '3.0', 'value' => '3.0')
        );
        $this->generalProps['selectVastVersion'] = new SimpleSelection('vast_version', 'Vast Version', '', Representations::_DEFAULT, $ListVastVersion, $ListVastVersion[0], true, true);

        $this->generalProps['ad_title'] = new Characters('ad_title', 'AdTitle', '', Representations::_DEFAULT, '');
        $this->generalProps['ad_system'] = new Characters('ad_system', 'AdSystem', '', Representations::_DEFAULT, 'adpaths');

        $this->generalProps['ad_description'] = new Characters('ad_description', 'Description', '', Representations::_DEFAULT, '');
        $this->generalProps['cachebusting_placeholder'] = new Characters('cachebusting_placeholder', 'Custom name for var cachebusting', '', Representations::_DEFAULT, 'CACHEBUSTING');
        $this->generalProps['nb_media_file'] = new Characters('nb_media_file', 'Number of Media File', '', Representations::_DEFAULT, '1');

        if(isset($videoSrc) && $videoSrc != null){
            $video_duration = date("H:i:s", mktime (0, 0, $videoSrc->getDuration()));
            $this->generalProps['duration'] = new Characters('duration', 'Duration', '', Representations::_DEFAULT, $video_duration);
            $this->generalProps['width'] = new Characters('width', 'Width', '', Representations::_DEFAULT, $videoSrc->getWidth());
            $this->generalProps['height'] = new Characters('height', 'Height', '', Representations::_DEFAULT, $videoSrc->getHeight());
        }else{
            $video_duration = null;
            $this->generalProps['duration'] = null;
            $this->generalProps['width'] = null;
            $this->generalProps['height'] = null;
        }

        $this->generalProps['skip_offset'] = new Characters('skip_offset', 'Skip Offset', '', Representations::_DEFAULT, '');

        $ListTracking = array(
            array('key' => 'vast-tracking-click', 'value' => 'Click'),
            array('key' => 'vast-tracking-error', 'value' => 'Error'),
            array('key' => 'vast-tracking-impression', 'value' => 'Impression'),
            array('key' => 'vast-tracking-creativeView', 'value' => 'Creative View'),
            array('key' => 'vast-tracking-start', 'value' => 'Start'),
            array('key' => 'vast-tracking-firstQuartile', 'value' => 'First Quartile'),
            array('key' => 'vast-tracking-midpoint', 'value' => 'Midpoint'),
            array('key' => 'vast-tracking-thirdQuartile', 'value' => 'Third Quartile'),
            array('key' => 'vast-tracking-complete', 'value' => 'Complete'),
            array('key' => 'vast-tracking-mute', 'value' => 'Mute'),
            array('key' => 'vast-tracking-unmute', 'value' => 'Unmute'),
            array('key' => 'vast-tracking-pause', 'value' => 'Pause'),
            array('key' => 'vast-tracking-resume', 'value' => 'Resume'),
            array('key' => 'vast-tracking-rewind', 'value' => 'Rewind'),
            array('key' => 'vast-tracking-expand', 'value' => 'Expand'),
            array('key' => 'vast-tracking-collapse', 'value' => 'Collapse'),
            array('key' => 'vast-tracking-close', 'value' => 'Close'),
            array('key' => 'vast-tracking-fullscreen', 'value' => 'Fullscreen'),
            array('key' => 'vast-tracking-acceptInvitation', 'value' => 'Accept Invitation'),
            array('key' => 'vast-tracking-acceptInvitationLinear', 'value' => 'Accept Invitation Linear'),
            array('key' => 'vast-tracking-exitFullscreen', 'value' => 'Exit Fullscreen'),
            array('key' => 'vast-tracking-closeLinear', 'value' => 'Close Linear'),
            array('key' => 'vast-tracking-skip', 'value' => 'Skip'),
        );

        foreach($ListTracking as $current){
            $tracking = new Characters($current['key'], $current['value'], '', Representations::_DEFAULT, '');
            if($tracking->getValue() == '') {
                $defaultValue = array();
                $defaultValue[] = '';
                $tracking = new MultiInstance($current['key'], $current['value'], '', ContentTemplateRPC::PROPERTY_TYPE_STRING, $defaultValue);
            }
            $this->trackingProps[$current['key']] = $tracking;
        }

        $tabListAdTester = array(
            array('key' => 'ima', 'value' => 'Google ad tester'),
            array('key' => 'adwtester', 'value' => 'Adways tester')
        );
        $this->previewProps['select_ad_tester'] = new SimpleSelection('select_ad_tester', 'Ad tester', '', Representations::_DEFAULT, $tabListAdTester, $tabListAdTester[0], true, true);

        $tabListAdTesterType = array(
            array('key' => 'linear', 'value' => 'linear'),
            array('key' => 'nonlinear', 'value' => 'nonlinear')
        );
        $this->previewProps['ad_tester_type'] = new SimpleSelection('ad_tester_type', 'Creative type', '', Representations::_DEFAULT, $tabListAdTesterType, $tabListAdTesterType[1], true, true);

        $tabListAdTesterVideo = array(
            array('key' => 'dailymotion', 'value' => 'Dailymotion'),
            array('key' => 'videojs4', 'value' => 'VideoJS 4'),
            array('key' => 'jwplayer7', 'value' => 'JWPlayer 7')
        );
        $this->previewProps['ad_tester_video'] = new SimpleSelection('ad_tester_video', 'Video player', '', Representations::_DEFAULT, $tabListAdTesterVideo, $tabListAdTesterVideo[1], true, true);

    }

    public function generateGeneralProps($config = array(), $representation = Representations::_DEFAULT) {
        // Possibilité d'overwrite une variable $this avec la config
        $this->general_group =  new NodeSet('general_vast_group', 'General', '', $representation);
        foreach($config as $key => $value) {
            $this->generalProps[$key] = $config[$key];
            // var_dump($key, $this->generalProps[$key]);
            // die();
        }
        $this->general_group->addProperty($this->generalProps['selectCreative']);
        if($this->generalProps['selectCreative']->getValue()['key'] == 'linear')
            $this->general_group->addProperty($this->generalProps['useDefaultVideoSlot']);
        $this->general_group->addProperty($this->generalProps['selectVastVersion']);
        $this->general_group->addProperty($this->generalProps['ad_system']);
        $this->general_group->addProperty($this->generalProps['ad_title']);
        $this->general_group->addProperty($this->generalProps['ad_description']);
        $this->general_group->addProperty($this->generalProps['selectProtocol']);

        if($this->generalProps['duration'] != null && $this->generalProps['width'] != null && $this->generalProps['height']){
            $this->general_group->addProperty($this->generalProps['duration']);
            $this->general_group->addProperty($this->generalProps['width']);
            $this->general_group->addProperty($this->generalProps['height']);  
        }


        if(version_compare($this->generalProps['selectVastVersion']->getValue()['key'], "3.0") >= 0 && $this->generalProps['selectCreative']->getValue()['key'] == 'linear'){  // ajout champ skipoffset
            $this->general_group->addProperty($this->generalProps['skip_offset']);
        }

        return $this->general_group;

    }

    public function generateTrackingProps($config = array(), $representation = Representations::_DEFAULT) {
        // Possibilité d'overwrite une variable $this avec la config
        $this->tracking_group =  new NodeSet('tracking_group', 'Tracking Links', '', $representation);
        foreach($this->trackingProps as $current){
            $this->tracking_group->addProperty($current);
        }

        return $this->tracking_group;
    }

    public function generateVast($template = null, $url) {
        // A utiliser pour les VPAID only
        $adwaysTracker = (isset($params['adways_tracker']) ? $params['adways_tracker'] : false);
        $vast_id;
        $vast_template_id;
        if ($template != null && $template->getCurrentEntityResource() == 'publication') {
            $vast_id = $template->getCurrentEntity()["id"]; // même que id de publication
            $vast_template_id = $template->getCurrentEntity()["template_id"]; // même que id de publication
        } else {
            $vast_id = uniqid();
            $vast_template_id = uniqid();
        }

        $this->protocol = $this->generalProps['selectProtocol']->getValue()['key'];

        $vpaid_url = $url . '?creativeType=' . $this->generalProps['selectCreative']->getValue()['key'] . '&publicationId=' . $template->getCurrentEntity()["id"];        
        if($this->generalProps['useDefaultVideoSlot']->getValue() || $this->generalProps['useDefaultVideoSlot']->getValue() == 'true')
            $vpaid_url .= '&useDefaultVideoSlot=1';        
        
        if(isset($_GET['iab'])) {
            $vpaid_url .= '&iab='.$_GET['iab'];
        }
        $media_location = $vpaid_url;
        
        $analytics_host = $this->formatEndpointProtocol('//www.adwstats.com/generic.pixel');
        $scheme = parse_url($analytics_host, PHP_URL_SCHEME);
        if ($scheme == null && $this->generalProps['selectProtocol']->getValue()['key'] != 'auto') {
            $analytics_host = $this->generalProps['selectProtocol']->getValue()['key'] . ':' . $vpaid_url;
        }

        $format = $this->generalProps['selectCreative']->getValue()['key'];
        if($format == 'linear' && $template != null){
            $template->addTag(Tags::KIND_LINEAR);  
        }else if($format == 'nonlinear' && $template != null){
            $template->addTag(Tags::KIND_NONLINEAR);
        }
        $ad_title = $this->generalProps['ad_title']->getValue();
        $ad_system = $this->generalProps['ad_system']->getValue();
        $vast_version = $this->generalProps['selectVastVersion']->getValue()['key'];
        $ad_description = $this->generalProps['ad_description']->getValue();

        $publication_id = null;
        // $media_id = (!isset($params['media_id']) || $params['media_id'] == null) ? null : $params['media_id'];

        $media_width = ($this->generalProps['width'] == null || $this->generalProps['width'] == '0') ? '640' : $this->generalProps['width'];
        $media_height = ($this->generalProps['height'] == null || $this->generalProps['height']== '0') ? '360' : $this->generalProps['height'];
        $media_duration = ($this->generalProps['duration'] == null || $this->generalProps['duration'] == '0' || $this->generalProps['duration'] == '00:00:00') ? '00:00:30' : $this->generalProps['duration'] ;

        $video_type = "vpaid";

        $vpaid_object_mimetype = array('application/javascript','application/x-javascript');
        $cachebusting_placeholder = $this->generalProps['cachebusting_placeholder'];

        $ad_skipoffset = $this->generalProps['skip_offset'] == '' ? null : $this->generalProps['skip_offset'];
        $click_through = null;

        $params = array();
        for($i=0;$i<count($this->tracking_group->propertiesToArray());$i++){
            $current = $this->tracking_group->propertiesToArray()[$i];
            $currentArray = $current->getValue();
            $value = [];
            if(is_array($currentArray)){
                $removed = array_shift($currentArray);
                // reconstruire $value
                for($j=0; $j<count($currentArray); $j++){
                    $value[] = $currentArray[$j]->getValue();
                }
            }else{
                $value = $currentArray;
            }
            $params['trackings'][$current->getKey()] = $value;
        }
        $trackingEvents = ($params['trackings'] == null) ? null : $params['trackings'];
        // $url_parameter = (!isset($params['url_parameter']) || $params['url_parameter'] == null) ? null : $params['url_parameter'];

        // $video_method = $params['video_method'];

        // $ad_parameters = (!isset($params['ad_parameters']) || $params['ad_parameters'] == null) ? null : $params['ad_parameters'];
        $ad_parameters = null;

        $player_host = $this->formatEndpointProtocol('//play.adpaths.com/');
        // $newAdress = $player_host . 'libs/compiler/iab.js?vpaid_format=' . $format . '&publication=' . $publication_id . '&vpaid_version=1.4.0&' . $url_parameter;
        $media_file = $vpaid_url;

        $scheme = parse_url($media_file, PHP_URL_SCHEME);
        if ($scheme == null && $this->generalProps['selectProtocol']->getValue()['key'] != 'auto') {
            $media_file = $this->generalProps['selectProtocol']->getValue()['key'] . ':' . $vpaid_url;
        }

        $listAssets = (!isset($params['listAssets']) || $params['listAssets'] == null) ? null : $params['listAssets'];
        $media_duration = (!isset($params['media_duration']) || $params['media_duration'] == null) ? $media_duration : $params['media_duration'];


        switch ($format) {
            case "linear":
                require_once(__DIR__ . '/Templates/StandardLinear.xml.php');
                // return file_get_contents(__DIR__ . '/Templates/StandardLinear.xml.php');
                break;
            case "nonlinear":
                require_once(__DIR__ . '/Templates/StandardNonLinear.xml.php');
                break;
            case "criteononlinear":
                // require_once(__DIR__ . '/Templates/CriteoNonLinear.xml.php');
                break;
            case "wrapper":
                // require_once(__DIR__ . '/Templates/Wrapper.xml.php');
                break;
        }
        return null;
    }

    public function generatePreviewProps($config = array()) {
        foreach($config as $key => $value) {
            $this->previewProps[$key] = $config[$key];
        }
        $general_group = new NodeSet('general_share_group', 'Preview VAST', '', Representations::_DEFAULT);
        $general_group->addProperty($this->previewProps['select_ad_tester']);

        if($this->previewProps['select_ad_tester']->getValue()['key'] == 'adwtester'){
            $general_group->addProperty($this->previewProps['ad_tester_type']);
            $general_group->addProperty($this->previewProps['ad_tester_video']);
        }

        return $general_group;
    }

    public function generatePreviewLink($template) {
        $studioShareURL = array();
        $studioShareURL['shareUrl'] = false;
        $template->addStudioUIConfig('preview', $studioShareURL);  
        $link = '';
        switch($this->previewProps['select_ad_tester']->getValue()['key']){
            case 'ima':
                $link = 'https://developers.google.com/interactive-media-ads/docs/sdks/html5/vastinspector?tag=' . urlencode($template->getCurrentEntity()["url"]);
                break;
            case 'adwtester':
                $link = 'http://www.adways.com/demo/magic-code?player=' . $this->previewProps['ad_tester_video']->getValue()['key'] . '&vasttype=' . $this->previewProps['ad_tester_type']->getValue()['key'] . '&vast=' . urlencode($template->getCurrentEntity()["url"]);
                break;
        }
        return $link;
    }

    private function formatEndpointProtocol($endpoint) {
        $scheme = parse_url($endpoint, PHP_URL_SCHEME);

        if ($scheme == null && $this->protocol != 'auto') {
            $endpoint = $this->protocol . ':' . $endpoint;
        }

        return $endpoint;
    }

}
