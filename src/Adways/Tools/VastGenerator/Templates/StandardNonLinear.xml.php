<VAST version="<?php echo $vast_version; ?>">
	<Ad id="<?php echo $vast_id; ?>">
		<InLine>
			<AdSystem><?php echo $ad_system; ?></AdSystem>
			<AdTitle><?php echo $ad_title; ?></AdTitle>
			<Description><?php echo $ad_description; ?></Description>
			<?php echo addTrackingEvent($trackingEvents, 'Impression', 'normal'); ?>
			<?php echo addTrackingEvent($trackingEvents, 'Error', 'normal'); ?>
			<Creatives>
				<Creative>
					<NonLinearAds>
                                        <?php 
                                        $trackings = '';
                                        $trackings .= addTrackingEvent($trackingEvents, 'creativeView');
                                        $trackings .= addTrackingEvent($trackingEvents, 'start');
                                        $trackings .= addTrackingEvent($trackingEvents, 'firstQuartile');
                                        $trackings .= addTrackingEvent($trackingEvents, 'midpoint');
                                        $trackings .= addTrackingEvent($trackingEvents, 'thirdQuartile');
                                        $trackings .= addTrackingEvent($trackingEvents, 'complete');
                                        $trackings .= addTrackingEvent($trackingEvents, 'mute');
                                        $trackings .= addTrackingEvent($trackingEvents, 'unmute');
                                        $trackings .= addTrackingEvent($trackingEvents, 'pause');
                                        $trackings .= addTrackingEvent($trackingEvents, 'resume');
                                        $trackings .= addTrackingEvent($trackingEvents, 'rewind');
                                        $trackings .= addTrackingEvent($trackingEvents, 'expand');
                                        $trackings .= addTrackingEvent($trackingEvents, 'collapse');
                                        $trackings .= addTrackingEvent($trackingEvents, 'close');
                                        if($vast_version == '3.0') { 
                                            $trackings .= addTrackingEvent($trackingEvents, 'fullscreen');
                                            $trackings .= addTrackingEvent($trackingEvents, 'acceptInvitationLinear');
                                            $trackings .= addTrackingEvent($trackingEvents, 'exitFullscreen');
                                            $trackings .= addTrackingEvent($trackingEvents, 'closeLinear');
                                            $trackings .= addTrackingEvent($trackingEvents, 'skip');
                                        } 
                                        if(!empty($trackings)) { ?>
                                            <TrackingEvents>
                                                <?php echo $trackings; ?>
                                            </TrackingEvents>		
                                        <?php } ?>
                                            
                                            <?php 
                                                if(gettype($vpaid_object_mimetype) != 'array')
                                                    $vpaid_object_mimetype = array($vpaid_object_mimetype);
                                                for($i=0;$i<count($vpaid_object_mimetype);$i++){
                                            ?>
                                            <NonLinear apiFramework="VPAID" width="<?php echo $media_width; ?>" height="<?php echo $media_height; ?>">
                                                
                                                <?php echo addTrackingEvent($trackingEvents, 'NonLinearClickTracking', 'normal'); ?>
                                                
                                                    <StaticResource creativeType="<?php echo $vpaid_object_mimetype[$i]; ?>"><![CDATA[<?php echo $media_location; ?>]]></StaticResource>
                                                    
                                                    <?php if($publication_id!=null){ ?>
                                                    <AdParameters>
                                                            <![CDATA[{"publicationID":"<?php echo $publication_id; ?>","vastID":"<?php echo $vast_id; ?>"}]]>
                                                    </AdParameters>
                                                    <?php }else if($ad_parameters != null){ ?>
                                                    <AdParameters>
                                                        <?php echo $ad_parameters; ?>
                                                    </AdParameters>
                                                    <?php } ?>
                                            </NonLinear>
                                            <?php } ?>
					</NonLinearAds>
				</Creative>
			</Creatives>
            <Extensions>
                <Extension type="Adways" xmlns:a="http://www.adways.com/tech/vast/adExtension">
                    <a:nonLinearVPAIDSlotGeometry left="0px" top="0px" width="100%" height="100%" />
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
    $lowerDesired = ($desired == 'NonLinearClickTracking') ? 'click' : lcfirst($desired);
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