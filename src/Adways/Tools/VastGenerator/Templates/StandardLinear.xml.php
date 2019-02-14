<VAST version="<?php echo $vast_version; ?>">
    <Ad id="<?php echo $vast_id; ?>">
        <InLine>
            <AdSystem><?php echo $ad_system; ?></AdSystem>
            <AdTitle><?php echo $ad_title; ?></AdTitle>
            <Description><?php echo $ad_description; ?></Description>
            <?php if($adwaysTracker) { ?><Impression><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=impression]]></Impression><?php } ?>
            <?php echo addTrackingEvent($trackingEvents, 'Impression', 'normal'); ?>
            <?php if($adwaysTracker) { ?><Error><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=error&event_name=[ERRORCODE]]]></Error><?php } ?>
            <?php echo addTrackingEvent($trackingEvents, 'Error', 'normal'); ?>
            <Creatives>
                <Creative>
                    <Linear <?php if($ad_skipoffset != null) echo "skipoffset='" . $ad_skipoffset . "'"; ?>>
                        <Duration><?php echo $media_duration; ?></Duration>
                        <TrackingEvents>
                            <?php if($adwaysTracker) { ?><Tracking event="creativeView"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=creativeView]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'creativeView'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="start"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=completion&event_name=<?php echo $vast_id; ?>&event_data=0&event_unit=%25]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'start'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="firstQuartile"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=completion&event_name=<?php echo $vast_id; ?>&event_data=25&event_unit=%25]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'firstQuartile'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="midpoint"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=completion&event_name=<?php echo $vast_id; ?>&event_data=50&event_unit=%25]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'midpoint'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="thirdQuartile"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=completion&event_name=<?php echo $vast_id; ?>&event_data=75&event_unit=%25]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'thirdQuartile'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="complete"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=completion&event_name=<?php echo $vast_id; ?>&event_data=100&event_unit=%25]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'complete'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="mute"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=mute]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'mute'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="unmute"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=unmute]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'unmute'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="pause"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=pause]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'pause'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="resume"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=resume]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'resume'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="rewind"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=rewind]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'rewind'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="expand"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=expand]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'expand'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="collapse"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=collapse]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'collapse'); ?>
                            <?php if($adwaysTracker) { ?><Tracking event="close"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=close]]></Tracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'close'); ?>
<?php if ($vast_version == '3.0') { ?>
                                <?php if($adwaysTracker) { ?><Tracking event="fullscreen"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=fullscreen]]></Tracking><?php } ?>
                                <?php echo addTrackingEvent($trackingEvents, 'fullscreen'); ?>
                                <?php if($adwaysTracker) { ?><Tracking event="acceptInvitationLinear"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=acceptInvitationLinear]]></Tracking><?php } ?>
                                <?php echo addTrackingEvent($trackingEvents, 'acceptInvitationLinear'); ?>
                                <?php if($adwaysTracker) { ?><Tracking event="exitFullscreen"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=exitFullscreen]]></Tracking><?php } ?>
                                <?php echo addTrackingEvent($trackingEvents, 'exitFullscreen'); ?>
                                <?php if($adwaysTracker) { ?><Tracking event="closeLinear"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=closeLinear]]></Tracking><?php } ?>
                                <?php echo addTrackingEvent($trackingEvents, 'closeLinear'); ?>
                                <?php if($adwaysTracker) { ?><Tracking event="skip"><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=state&event_name=skip]]></Tracking><?php } ?>
                                <?php echo addTrackingEvent($trackingEvents, 'skip'); ?>
<?php } ?>
                        </TrackingEvents>       

                        <VideoClicks>
                            <?php if($adwaysTracker) { ?><ClickTracking><![CDATA[<?php echo $analytics_host; ?>?client_cache_buster=[<?php echo $cachebusting_placeholder; ?>]&record_interface=generic&creative_format=<?php echo $vast_template_id; ?>&creative_id=<?php echo $vast_id; ?>&event_type=interaction&event_name=click]]></ClickTracking><?php } ?>
                            <?php echo addTrackingEvent($trackingEvents, 'ClickTracking', 'normal'); ?>
                            <?php if($click_through!=null){ ?>
                                <ClickThrough><![CDATA[<?php echo $click_through;?>]]></ClickThrough>
                            <?php } ?>
                        </VideoClicks>
                        <MediaFiles>
                            <?php if($video_type=="vpaid"){ 
                                if(gettype($vpaid_object_mimetype) != 'array')
                                    $vpaid_object_mimetype = array($vpaid_object_mimetype);
                                for($i=0;$i<count($vpaid_object_mimetype);$i++){
                                ?>
                                    <MediaFile apiFramework="VPAID" delivery="progressive" type="<?php echo $vpaid_object_mimetype[$i]; ?>" width="<?php echo $media_width; ?>" height="<?php echo $media_height; ?>" maintainAspectRatio="true"><![CDATA[<?php echo $media_file; ?>]]></MediaFile>
                                    
                                <?php } ?>
                            <?php }else if($listAssets!=null) {
                                    for( $i=0; $i<count($listAssets); $i++){ ?>
                                        <MediaFile delivery="progressive" width="<?php echo $listAssets[$i]->getWidth(); ?>" height="<?php echo $listAssets[$i]->getHeight(); ?>" type="<?php echo $listAssets[$i]->getMime(); ?>" <?php if($listAssets[$i]->getMaxBitrate() != null) { echo "maxBitrate='" . $listAssets[$i]->getMaxBitrate() . "' minBitrate='" . $listAssets[$i]->getMinBitrate() . "'"; } else if($listAssets[$i]->getBitrate() != null) { echo "bitrate='" . $listAssets[$i]->getBitrate() . "'"; } ?> scalable="true" maintainAspectRatio="true"><![CDATA[<?php echo $listAssets[$i]->getLocation();?>]]></MediaFile>
                                    <?php }   
                                } else {?>
                                <MediaFile delivery="progressive" width="<?php echo $media_width; ?>" height="<?php echo $media_height; ?>" type="<?php echo $vpaid_object_mimetype; ?>" bitrate="720" scalable="true" maintainAspectRatio="true"><![CDATA[<?php echo $media_location;?>]]></MediaFile>
                            <?php } ?>
                        </MediaFiles>
                        <?php if($publication_id!=null){ ?>
                        <AdParameters>
                            <![CDATA[{"publicationID":"<?php echo $publication_id; ?>","vastID":"<?php echo $vast_id; ?>"}]]>
                        </AdParameters>
                        <?php }else if($ad_parameters != null){ ?>
                        <AdParameters>
                            <![CDATA[ {<?php echo $ad_parameters; ?>} ]]>
                        </AdParameters>
                        <?php } ?>
                    </Linear>
                </Creative>
            </Creatives>
            <Extensions>
                <Extension>
                </Extension>
            </Extensions>
        </InLine>
    </Ad>
</VAST>

<?php 

function produceTrackingLink($eventLink, $desired, $typeTracking) {
    if($eventLink != ''){
        return ($typeTracking == 'TrackingEvents') ? '<Tracking event="'.$desired.'"><![CDATA['.$eventLink.']]></Tracking>' : '<'.$desired.'><![CDATA['.$eventLink.']]></'.$desired.'>';
    }else
        return '';
}

function addTrackingEvent($events, $desired, $typeTracking = 'TrackingEvents') {
    $lowerDesired = ($desired == 'ClickTracking') ? 'click' : lcfirst($desired);
    // var_dump($events);
    // die();
    if(isset($events['vast-tracking-' . $lowerDesired]) && !empty($events['vast-tracking-' . $lowerDesired])){
        $trackingLinks = '';
        if(is_array($events['vast-tracking-' . $lowerDesired])){
            for($i=0; $i < count($events['vast-tracking-' . $lowerDesired]); $i++){
                $trackingLinks .= produceTrackingLink($events['vast-tracking-' . $lowerDesired][$i], $desired, $typeTracking);
            }
        }else{
            $trackingLinks = produceTrackingLink($events['vast-tracking-' . $lowerDesired], $desired, $typeTracking);
        }
        return $trackingLinks;
    }else{
        return '';
    }
}

?>