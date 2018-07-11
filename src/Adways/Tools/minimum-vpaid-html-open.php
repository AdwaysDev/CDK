<?php

require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Model\Sphere;

header('Content-Type: text/javascript; charset=utf-8');
$useDefaultVideoSlot = (isset($_GET['useDefaultVideoSlot'])) ? $_GET['useDefaultVideoSlot'] : false;

/* Netbeans hack to have js syntax color hilighting */ if (false) {
    ?> <script> <?php } 
    ?>
        (function(window) {
            
            window.adwMobileAndTabletcheck = function() {
                var check = false;
                (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
                return check;
            };
            var htmlAddEventListener = function(source, eventName, callback, useCapture) {
                if (arguments.length < 4)
                    useCapture = false;
                if ((eventName === "load") && (typeof source.onload === "undefined")) {
                    var onreadystatechangeEventHandler = function() {
                        if (source.readyState === "loaded" || source.readyState === "complete") {
                            callback.call();
                            if (source.removeEventListener)
                                source.removeEventListener("readystatechange", onreadystatechangeEventHandler);
                            else if (source.detachEvent)
                                source.detachEvent("onreadystatechange", onreadystatechangeEventHandler);
                            else
                                source.onreadystatechange = null;
                        }
                    };

                    if (source.addEventListener)
                        source.addEventListener("readystatechange", onreadystatechangeEventHandler);
                    else if (source.attachEvent)
                        source.attachEvent("onreadystatechange", onreadystatechangeEventHandler);
                    else
                        source.onreadystatechange = onreadystatechangeEventHandler;
                }
                else {
                    if (source.addEventListener) {
                        source.addEventListener(eventName, callback, useCapture);
                    }
                    else if (source.attachEvent) {
                        source.attachEvent("on" + eventName, callback, useCapture);
                    }
                }
            };

            var htmlRemoveEventListener = function(source, eventName, callback, useCapture) {
                if (arguments.length < 4)
                    useCapture = false;
                if (source.removeEventListener) {
                    source.removeEventListener(eventName, callback, useCapture);
                }
                else if (source.detachEvent) {
                    source.detachEvent("on" + eventName, callback, useCapture);
                }
            };
            var adwaysLibScriptTag = null;
            var delegateScriptTag = null;
            var analyticsScriptTag = null;
            var that;
            var adwaysLibLoaded = false;
            var analyticsLibLoaded = false;

            LinearAd = function() {
                this.delegate = null;
                this._slot = null;
                this._videoSlot = null;
                this.VPAIDVersion = "2.0";
                this.listeners = new Array();
                this.duration = -2;

                this.remainingTime = -2;
                this.quartiles = {};
                this.quartiles.zero = false;
                this.quartiles.first = false;
                this.quartiles.mid = false;
                this.quartiles.third = false;
                this.quartiles.last = false;
                this.finalStop = false;
                this.p2s = null;
                this.s2p = null;
                this.videoStarted = false;
                this.tracker = null;
                this.container = null;
                this.videoContainer = null;
                this.trueViewed = false;
                that = this;
                this.completionValue = 0;
                this.requestVolume = null;
                this.mediaTag = null;
    <?php if (isset($skipOffset) && $skipOffset->getValue() > 0) { ?>
                    this.skipDiv = null;
                    this.skipSpan = null;
                    this.skipImg = null;
                    this.skipOffset = Number.NaN;
                    this.canSkip = false;
                    this.skipPosition = 0;
    <?php
    }
    if (isset($skipDisplayActive) && $skipDisplayActive->getValue()) {
        ?>
                    this.skipDisplayDiv = null;
                    this.skipDisplayTime = '<?php echo $skipDisplayImageTime->getValue(); ?>';
    <?php } ?>
                this.adwaysLibScriptTagLoadCb = function() {
                    adwaysLibLoaded = true;
                    htmlRemoveEventListener(adwaysLibScriptTag, "load", that.adwaysLibScriptTagLoadCb);
                    that.loadAd();
                };
                this.delegateScriptTagLoadCb = function() {
                    htmlRemoveEventListener(delegateScriptTag, "load", that.delegateScriptTagLoadCb);
                    that.init();
                };
                this.analyticsScriptTagLoadCb = function() {
                    analyticsLibLoaded = true;
                    htmlRemoveEventListener(analyticsScriptTag, "load", that.analyticsScriptTagLoadCb);

                    that.tracker = new window.adways.analytics.Tracker({
                        record_interface: "generic",
                        creative_format: "<?php echo $template->getCurrentEntity()['template_id']; ?>",
                        creative_id: "<?php echo $template->getCurrentEntity()['id']; ?>",
                        random_number: function() {
                            return Math.random();
                        }
                    });

                    that.loadAd();
                };
            };
    <?php if (isset($skipOffset) && $skipOffset->getValue() > 0) { ?>
                LinearAd.prototype.addSkipButton = function() {
                    this.skipOffset = "<?php echo $skipOffset->getValue(); ?>";
                    this.skipDiv = window.document.createElement("div");
                    this.skipDiv.style.background = "rgba(0, 0, 0, 0.8) none repeat scroll 0% 0%";
                    this.skipDiv.style.color = "rgba(0, 0, 0, 0.8) rgb(255, 255, 255)";
                    this.skipDiv.style.fontSize = "11px";
                    this.skipDiv.style.fontFamily = "arial,sans-serif";
                    this.skipDiv.style.position = "absolute";
                    this.skipDiv.style.textAlign = "center";
                    this.skipDiv.style.right = "0px";
//                    this.skipDiv.style.bottom = "10%";
                    this.skipPosition = <?php echo $skipOffsetPosition->getValue(); ?>;
                    this.skipDiv.style.padding = "2%";
                    this.skipDiv.style.cursor = "pointer";
					this.skipDiv.style.visibility = "hidden";
                    this.skipDiv.style.zIndex = 9999;

                    this.skipSpan = window.document.createElement("span");
                    this.skipSpan.style.verticalAlign = "middle";
                    this.skipSpan.style.fontSize = "11px";
                    this.skipSpan.style.fontFamily = "arial,sans-serif";
                    this.skipSpan.style.color = "rgb(255, 255, 255)";
                    this.skipSpan.style.cursor = "pointer";

                    this.skipImg = window.document.createElement("img");
                    this.skipImg.style.verticalAlign = "middle";
                    this.skipImg.style.display = "none";
                    this.skipImg.src = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABGdBTUEAALGPC/xhBQAAAKBJREFUOBFjYBgFsBD4////TCBmg/Hx0UB1FUD8CYi7cKoDSoLAMSCWxKkIKgFU8xSkGAh+4VQLkQeTz4CkJU6FQAmg/CuYepzqYAqg9E8gnYZLMVCOZANh5mMNV0oMBBmMEa6UGggyFCVckQ1kwhUuVBcHOQMHoKqXqRYpVE02KBGALWyBQUN0OsQILxwGEpX1sIYXDgNhhUM3NvlhLgYAYuCVi7Jf+AUAAAAASUVORK5CYII=";
                    this.skipImg.style.cursor = "pointer";

                    this.skipDiv.appendChild(this.skipSpan);
                    this.skipDiv.appendChild(this.skipImg);
                    this._slot.appendChild(this.skipDiv);
                    var that = this;
                    setTimeout(function(){that.updateSkipButtonPosition();}, 200);
                };
                
                LinearAd.prototype.updateSkipButtonPosition = function() {
                    if(this.skipDiv) {
                        var height = this.skipDiv.offsetHeight;
                        if(this.skipPosition > 50) {
                            this.skipDiv.style.top = "calc("+this.skipPosition+"% - "+height+"px)";
                        } else if(this.skipPosition === 50){
                            this.skipDiv.style.top = "calc("+this.skipPosition+"% - "+(height/2)+"px)";
                        }else {
                            this.skipDiv.style.top = this.skipPosition+"%";
                        }
						this.skipDiv.style.visibility = "visible";
                    }
                };

                LinearAd.prototype.updateSkipButton = function(currentTime) {                    
                    if (this.canSkip)
                        return;
                    if (!this.canSkip && currentTime < this.skipOffset) {
//                        this.skipSpan.innerHTML = "you can skip this ad in " + Math.floor(this.skipOffset - currentTime);
                        var skipRemainingTime = '<?php echo $preSkipAdText->getValue();?>';
                        this.skipSpan.innerHTML = skipRemainingTime.replace("%%%skipAdRemainingTime%%%",Math.floor(this.skipOffset - currentTime));
                    } else {
                        this.canSkip = true;
                        this.skipSpan.innerHTML = '<?php echo $skipAdText->getValue();?>';
                        this.skipSpan.fontSize = "18px;";
                        this.skipSpan.textAlign = "center";
                        this.skipImg.style.display = "inline";
                        var that = this;
                        htmlAddEventListener(this.skipDiv, "click", function() {
                            that.skipAd();
                        });
                    }
                };
    <?php
    }
    if (isset($skipDisplayActive) && $skipDisplayActive->getValue()) {
        ?>
                LinearAd.prototype.addSkipDisplayImage = function() {
                    this.skipDisplayDiv = window.document.createElement("div");
                    this.skipDisplayDiv.style.display = "none";
                    <?php if(isset($skipDisplayImageBackgroundColor)){ ?>
                    this.skipDisplayDiv.style.backgroundColor =  "<?php echo $skipDisplayImageBackgroundColor->getValue(); ?>";
                    <?php }else{ ?>
                    this.skipDisplayDiv.style.backgroundColor =  "#000000";
                    <?php } ?>
                    this.skipDisplayDiv.style.backgroundImage = "url('<?php echo $skipDisplayImage->getValue(); ?>')";
                    <?php if(isset($skipDisplayImageMode) && ($skipDisplayImageMode->getValue())) { ?>
                    this.skipDisplayDiv.style.backgroundSize = "contain";
                    this.skipDisplayDiv.style.backgroundRepeat = "no-repeat";
                    this.skipDisplayDiv.style.backgroundPosition = "center";
                    this.skipDisplayDiv.style.backgroundAttachment = "fixed";
                    <?php }else{ ?>
                    this.skipDisplayDiv.style.backgroundSize = "cover";
                    this.skipDisplayDiv.style.backgroundRepeat = "no-repeat";
                    this.skipDisplayDiv.style.backgroundPosition = "center";
                    this.skipDisplayDiv.style.backgroundAttachment = "fixed";
                    <?php } ?>
                    
                    this.skipDisplayDiv.style.position = "absolute";
                    this.skipDisplayDiv.style.top = 0;
                    this.skipDisplayDiv.style.left = 0;
                    this.skipDisplayDiv.style.zIndex = 998;
                    this.skipDisplayDiv.style.width = "100%";
                    this.skipDisplayDiv.style.height = "100%";
                    this.skipDisplayDiv.style.cursor = "pointer";

                    this._slot.appendChild(this.skipDisplayDiv);
                };
    <?php } ?>
            LinearAd.prototype.initAd = function(width, height, viewMode, desiredBitrate, creativeData, environmentVars) {
                this.prepareCrea(environmentVars);
                this.loadLib();
            };

            LinearAd.prototype.prepareCrea = function(environmentVars) {
                this._slot = environmentVars.slot;
                this._videoSlot = environmentVars.videoSlot;
                if (window.document.body !== null) {
                    window.document.body.style.margin = 0;
                    window.document.body.style.border = 0;
                    window.document.body.style.padding = 0;
                }

            };

            LinearAd.prototype.loadLib = function() {

                if ((typeof window.adways.scw === "undefined") && adwaysLibScriptTag !== null) {
                    htmlAddEventListener(adwaysLibScriptTag, "load", this.adwaysLibScriptTagLoadCb);
                } else {
                    adwaysLibLoaded = true;
                }

                if (typeof window.adways === "undefined" || typeof window.adways.analytics === "undefined") {
                    htmlAddEventListener(analyticsScriptTag, "load", this.analyticsScriptTagLoadCb);
                } else {
                    analyticsLibLoaded = true;
                    this.tracker = new window.adways.analytics.Tracker({
                        record_interface: "generic",
                        creative_format: "<?php echo $template->getCurrentEntity()["template_id"]; ?>",
                        creative_id: "<?php echo $template->getCurrentEntity()["id"]; ?>",
                        random_number: function() {
                            return Math.random();
                        }
                    });
                }

                this.loadAd();

            };

            LinearAd.prototype.loadAd = function() {
                if (adwaysLibLoaded && analyticsLibLoaded) {
                    if (typeof HTMLVideoDelegate == "undefined") {
                        delegateScriptTag = window.document.createElement("script");
                        htmlAddEventListener(delegateScriptTag, "load", this.delegateScriptTagLoadCb);
                        delegateScriptTag.type = "text/javascript";
                        delegateScriptTag.src = "<?php echo Sphere::CDNAdPathsLibs; ?>libs/delegates/htmlvideo.js";
                        if (window.document.body !== null) {
                            window.document.body.appendChild(delegateScriptTag);
                        } else if (window.document.head !== null) {
                            window.document.head.appendChild(delegateScriptTag);
                        }
                    } else
                    {
                        this.init();
                    }
                }
            };

            LinearAd.prototype.init = function() {
                this.initBegin();
                this.initEnd();
            };

            LinearAd.prototype.initBegin = function() {

                var that = this;
                this.s2p = new window.adways.interactive.SceneControllerWrapper();
                this.p2s = new window.adways.interactive.SceneControllerWrapper();

                this.delegate = new HTMLVideoDelegate(this.p2s, this.s2p, this.mediaTag);


                this.updatePosition();
                this.p2s.addEventListener(window.adways.resource.events.STREAM_SIZE_CHANGED, this.updatePosition, this);
                this.p2s.addEventListener(window.adways.resource.events.RENDER_SIZE_CHANGED, this.updatePosition, this);
                this.p2s.addEventListener(window.adways.resource.events.PLAYER_SIZE_CHANGED, this.updatePosition, this);
                this.p2s.addEventListener(window.adways.resource.events.RENDER_TRANSFORM_CHANGED, this.updatePosition, this);
                this.p2s.addEventListener(window.adways.resource.events.STREAM_TRANSFORM_CHANGED, this.updatePosition, this);

                this.p2s.addEventListener(window.adways.resource.events.PLAY_STATE_CHANGED, this.playStateChangedCb, this);

                this.duration = this.p2s.getDuration();
                this.dispatchEvent("AdDurationChange", this.duration);
                this.p2s.addEventListener(window.adways.resource.events.DURATION_CHANGED, this.durationChangedCb, this);
                this.p2s.addEventListener(window.adways.resource.events.VOLUME_CHANGED, this.volumeChangedCb, this);
                this.p2s.addEventListener(window.adways.resource.events.MUTED_CHANGED, this.muteChangedCb, this);
                this.p2s.addEventListener(window.adways.resource.events.FULLSCREEN_CHANGED, this.fullscreenChangedCb, this);
                this.currentTimeChangedCb();
                this.p2s.addEventListener(window.adways.resource.events.CURRENT_TIME_CHANGED, this.currentTimeChangedCb, this);

            };

            LinearAd.prototype.initEnd = function() {
                this.tracker.sendData({event_type: "state", event_name: "loaded"});
                this.dispatchEvent("AdLoaded");
            };

            LinearAd.prototype.updatePosition = function() {
    <?php if (isset($skipOffset) && $skipOffset->getValue() > 0) { ?>
                this.updateSkipButtonPosition();
    <?php } ?>
            };

            LinearAd.prototype.finalStopCb = function() {
                if (this.finalStop)
                    return;
                this.finalStop = true;
                var that = this;
//        console.log("finalStop");
                var stopCb = function() {
                    var that2 = that;
//        console.log("stop");
                    var completionAndStopCb = function() {
//        console.log("completionAndStopCb");   
                        that2.dispatchEvent("AdVideoComplete");
                        that2.destroy();
//                this.finalStop = true;
                        that2.dispatchEvent("AdStopped");
                    };
                    that.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: 100, event_unit: "%", cbFunction: completionAndStopCb});
                };
                //this.finalStop = true;
                this.tracker.sendData({event_type: "state", event_name: "stop", cbFunction: stopCb});
            };


            LinearAd.prototype.setPlayState = function() {
//                console.log("setPlayState");
                if (arguments[0] === window.adways.resource.playStates.PLAYING) {
                    if (!this.videoStarted) {
                        this.videoStarted = true;
                        this.dispatchAdStarted();
                    }
                    this.dispatchEvent("AdPlaying");
                    this.tracker.sendData({event_type: "state", event_name: "play"});
                } else if (arguments[0] === window.adways.resource.playStates.PAUSED) {
                    this.tracker.sendData({event_type: "state", event_name: "pause"});
                    this.dispatchEvent("AdPaused");
//            console.log("setPlayState pause");
                    if (this.duration !== 0 && this.duration !== -2 && (this.p2s.getCurrentTime() + 0.75) >= this.duration) {
                        this.finalStopCb();
                    }
                }
            };

            LinearAd.prototype.fullscreenChangedCb = function(e) {
                if (this.p2s.getFullscreen().valueOf()) {
                    this.tracker.sendData({event_type: "state", event_name: "enterFullscreen"});
                    this.dispatchEvent("AdEnterFullscreen", this.duration);
                } else {
                    this.tracker.sendData({event_type: "state", event_name: "exitFullscreen"});
                    this.dispatchEvent("AdExitFullscreen", this.duration);
                }
            };

            LinearAd.prototype.currentTimeChangedCb = function() {
                if (this.duration === -2)
                    return;
                var currentTime = this.p2s.getCurrentTime().valueOf();
                var newRemainingTime = parseFloat((this.duration - currentTime).toFixed(2));
                this.remainingTime = newRemainingTime;
                this.dispatchEvent("AdRemainingTimeChange");

    <?php if (isset($skipOffset) && $skipOffset->getValue() > 0) { ?>
                    if (!isNaN(this.skipOffset))
                        this.updateSkipButton(currentTime);
    <?php } ?>

                if (typeof this.tracker != "undefined" && !isNaN(this.duration)) { // envoi completion et trueview
                    if (currentTime >= 0.1 && !this.quartiles.zero) {
    <?php
    if (isset($visibilityTracker) && is_array($visibilityTracker->getValue())) {
        $currentArray = $visibilityTracker->getValue();
        $removed = array_shift($currentArray);
        for ($j = 0; $j < count($currentArray); $j++) {
            ?>
                                var visibilityTrackerTag = window.document.createElement("script");
                                visibilityTrackerTag.type = "text/javascript";
                                visibilityTrackerTag.src = "<?php echo $currentArray[$j]->getValue(); ?>";
                                if (window.document.body !== null) {
                                    window.document.body.appendChild(visibilityTrackerTag);
                                } else if (window.document.head !== null) {
                                    window.document.head.appendChild(visibilityTrackerTag);
                                }
        <?php
        }
    }
    ?>
                        this.tracker.sendData({event_type: "state", event_name: "impression"});
                        this.dispatchEvent("AdImpression");
                        this.completionValue = 0;
                        this.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: this.completionValue, event_unit: "%"});
                        this.quartiles.zero = true;
                        this.dispatchEvent("AdVideoStart");
                    }
                    if (currentTime >= (this.duration * 0.25) && !this.quartiles.first) {
                        this.completionValue = 25;
                        this.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: this.completionValue, event_unit: "%"});
                        this.quartiles.first = true;
                        this.dispatchEvent("AdVideoFirstQuartile");
                    }
                    if (currentTime >= (this.duration * 0.50) && !this.quartiles.mid) {
                        this.completionValue = 50;
                        this.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: this.completionValue, event_unit: "%"});
                        this.quartiles.mid = true;
                        this.dispatchEvent("AdVideoMidpoint");
                    }
                    if (currentTime >= (this.duration * 0.75) && !this.quartiles.third) {
                        this.completionValue = 75;
                        this.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: this.completionValue, event_unit: "%"});
                        this.quartiles.third = true;
                        this.dispatchEvent("AdVideoThirdQuartile");
                    }
                    if (currentTime == (this.duration) && !this.quartiles.last) {
                        this.quartiles.last = true;
//                console.log("this.quartiles.last");
                        this.finalStopCb();
                    }
                    var trueviewTime = '<?php echo (isset($trueview) ? $trueview->getValue() : 2); ?>';
                    if ("<?php echo (isset($type_trueview_select) ? $type_trueview_select->getValue()["key"] : "second"); ?>" === "percentage_tv")
                        trueviewTime *= this.duration;
                    if (currentTime >= trueviewTime && !this.trueViewed) {
                        this.trueViewed = true;
                        trueviewTime = Math.floor(trueviewTime);
                        this.tracker.sendData({event_type: "state", event_name: "trueview", event_data: trueviewTime, event_unit: "s"});
                    }
                }
            };

            LinearAd.prototype.muteChangedCb = function(e) {
                if (this.p2s.getMuted().valueOf()) {
                    this.dispatchEvent("AdMuted");
                } else {
                    this.dispatchEvent("AdUnmuted");
                }
            };

            LinearAd.prototype.volumeChangedCb = function(e) {
                this.dispatchEvent("AdVolumeChange");
            };

            LinearAd.prototype.playStateChangedCb = function(e) {
                playstate = this.p2s.getPlayState().valueOf();
                this.setPlayState(playstate);
            };

            LinearAd.prototype.durationChangedCb = function() {
                var newDuration = this.p2s.getDuration();
                if (newDuration !== 0 && this.duration !== newDuration) {
                    this.duration = this.p2s.getDuration();
                    this.dispatchEvent("AdDurationChange", this.duration);
                }
            };

            LinearAd.prototype.dispatchAdStarted = function() {
                this.dispatchEvent("AdStarted");
                if (this.requestVolume != null) {
                    if(!window.adwMobileAndTabletcheck()) {
                        this.s2p.setVolume(this.requestVolume);
                    }
//                    this.setAdVolume(this.requestVolume);
                    this.requestVolume = null;
                }
                this.tracker.sendData({event_type: "state", event_name: "start"});
    <?php if (isset($skipOffset) && $skipOffset->getValue() > 0) { ?>
                    this.addSkipButton();
    <?php }
    if (isset($skipDisplayActive) && $skipDisplayActive->getValue()) {
        ?>
                    this.addSkipDisplayImage();
    <?php } ?>
            };

            LinearAd.prototype.tryPlay = function() {
//        var that = this;
//        this.mediaTag.play().then(function () {
//        }).catch(function (error) {
//            that.tryPlayOnMute();
//        });       
                var that = this;
                var p = this.mediaTag.play();
                if (p === undefined) {
                    this.dispatchEvent("AdPaused");
                    return;
                }
                p.catch(function(error) {
                    if (/*error instanceof DOMException &&*/ error.name === "NotAllowedError") {
                        that.tryPlayOnMute();
                    }
                    else {
                        var errorCode = "902";
                        var that2 = that;
                        var errorCb = function() {
                            that2.dispatchEvent("AdError", errorCode);
                        };
                        that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                    }
                });

            };

            LinearAd.prototype.tryPlayOnMute = function() {
//        this.s2p.mute(true);
//        var that = this;
//        this.mediaTag.play().then(function () {
//        }).catch(function (error) {
//        });

                this.s2p.mute(true);
                var that = this;
                var p = this.mediaTag.play();
                if (p === undefined) {
                    this.dispatchEvent("AdPaused");
                    return;
                }

                p.catch(function(error) {
                    if (/*error instanceof DOMException &&*/ error.name === "NotAllowedError") {
                        that.dispatchEvent("AdPaused");
                    }
                    else {
                        var errorCode = "902";
                        var that2 = that;
                        var errorCb = function() {
                            that2.dispatchEvent("AdError", errorCode);
                        };
                        that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                    }
                });

            };

            LinearAd.prototype.getAdLinear = function() {
                return true;
            };
            LinearAd.prototype.stopAd = function(e, p) {
                this.destroy();
                this.dispatchEvent("AdStopped");
                this.tracker.sendData({event_type: "state", event_name: "stop"});
            };

            LinearAd.prototype.getAdDuration = function() {
                return this.duration;
            };

            LinearAd.prototype.getAdRemainingTime = function() {
                return this.remainingTime;
            };

            LinearAd.prototype.setAdVolume = function(val) {
            if (!this.videoStarted && (val > 0)  && window.adwMobileAndTabletcheck()) 
                return;    
                if (val < 0)
                    val = 0;
                if (val > 1)
                    val = 1;

                if (this.s2p != null) {
                    this.s2p.setVolume(val);
                    if (val > 0) {
                        this.s2p.unmute(true);
                    }
                } else {
                    this.requestVolume = val;
                }
            };
            LinearAd.prototype.getAdVolume = function() {
                this.p2s.getVolume().valueOf();
            };
            LinearAd.prototype.resizeAd = function(width, height, viewMode) {
                if (viewMode === "fullscreen" && !this.p2s.getFullscreen().valueOf()) {
                    this.s2p.enterFullscreen(true);
                } else if (this.p2s.getFullscreen().valueOf()) {
                    this.s2p.exitFullscreen(true);
                }
            };

            LinearAd.prototype.pauseAd = function() {
                this.s2p.pause(true);
            };
            LinearAd.prototype.resumeAd = function() {
                this.s2p.play(true);
            };
            LinearAd.prototype.expandAd = function() {
            };
            LinearAd.prototype.getAdExpanded = function(val) {
            };
            LinearAd.prototype.getAdSkippableState = function(val) {
            };
            LinearAd.prototype.collapseAd = function() {
            };
            LinearAd.prototype.displaySkipImage = function() {
                this.skipDisplayDiv.style.display = "block";
            };
            LinearAd.prototype.skipAd = function() {
                var that = this;
                var skip = function() {
                    var that2 = that;
                    var skipCb = function() {
                        that2.destroy();
                        that2.dispatchEvent("AdSkipped");
                        that2.dispatchEvent("AdStopped");
                    };
                    that.tracker.sendData({event_type: "state", event_name: "skip",
                        completion_value: that.completionValue,
                        completion_ref: "<?php echo $template->getCurrentEntity()["id"]; ?>", cbFunction: skipCb});
                };
    <?php if (isset($skipDisplayActive) && $skipDisplayActive->getValue()) { ?>
                    this.s2p.pause(true);
                    if(this.skipDiv != null)
                        this.skipDiv.style.display = 'none';
                    this.displaySkipImage();
                    setTimeout(skip, that.skipDisplayTime);
    <?php } else { ?>
                    skip();
    <?php } ?>
            };

            LinearAd.prototype.startAd = function() {
                if(window.adwMobileAndTabletcheck()) {
                    this.s2p.mute(true);        
                }
                this.videoContainer.style.visibility = "visible";
                this.tryPlay();
                if (!this.videoStarted) {
                    this.videoStarted = true;
                    this.dispatchAdStarted();
                }
            };

            LinearAd.prototype.handshakeVersion = function(version) {
                return this.VPAIDVersion;
            };

            LinearAd.prototype.getAdIcons = function() {
            };

            LinearAd.prototype.getAdWidth = function() {
                return (typeof this.container !== "undefined") ? this.container.offsetWidth : 0;
            };

            LinearAd.prototype.getAdHeight = function() {
                return (typeof this.container !== "undefined") ? this.container.offsetHeight : 0;
            };

            LinearAd.prototype.subscribe = function(fn, evt, inst) {
                if (typeof (this.listeners[evt]) === "undefined")
                    this.listeners[evt] = new Array();
                var tmpObj = new Object();
                tmpObj.fcn = fn;
                tmpObj.inst = (arguments.length > 2 ? inst : null);
                this.listeners[evt][this.listeners[evt].length] = tmpObj;
            };

            LinearAd.prototype.unsubscribe = function(evt) {
                try {
                    if (typeof (this.listeners[evt]) !== "undefined")
                        delete this.listeners[evt];
                }
                catch (e) {
                    console.warn(e);
                }
            };

            LinearAd.prototype.dispatchEvent = function(evt) {
                var args = new Array();
                for (var i = 1; i < arguments.length; i++)
                    args.push(arguments[i]);
                if (typeof (this.listeners[evt]) !== "undefined") {
                    for (var i = 0; i < this.listeners[evt].length; i++) {
                        this.listeners[evt][i].fcn.apply(this.listeners[evt][i].inst, args);
                    }
                }
            };

            LinearAd.prototype.destroy = function() {
    <?php if (isset($skipOffset) && $skipOffset->getValue() > 0) { ?>
                    if (this.skipDiv !== null && this.skipDiv.parentNode !== null) {
                        this.skipDiv.parentNode.removeChild(this.skipDiv);
                    }
    <?php }
    if (isset($skipDisplayActive) && $skipDisplayActive->getValue()) {
        ?>
                    if (this.skipDisplayDiv !== null && this.skipDisplayDiv.parentNode !== null) {
                        this.skipDisplayDiv.parentNode.removeChild(this.skipDisplayDiv);
                    }
    <?php } ?>
                if (this.s2p !== null)
                    this.s2p.pause(true);

                if (this.delegate !== null)
                    window.adways.destruct(this.delegate);

                if (this.p2s !== null) {
                    this.p2s.removeEventListener(window.adways.resource.events.PLAY_STATE_CHANGED, this.playStateChangedCb, this);
                    this.p2s.removeEventListener(window.adways.resource.events.VOLUME_CHANGED, this.volumeChangedCb, this);
                    this.p2s.removeEventListener(window.adways.resource.events.MUTED_CHANGED, this.muteChangedCb, this);
                    this.p2s.removeEventListener(window.adways.resource.events.CURRENT_TIME_CHANGED, this.currentTimeChangedCb, this);
                    this.p2s.removeEventListener(window.adways.resource.events.FULLSCREEN_CHANGED, this.fullscreenChangedCb, this);
                    this.p2s.removeEventListener(window.adways.resource.events.DURATION_CHANGED, this.durationChangedCb, this);
                    this.p2s.removeEventListener(window.adways.resource.events.STREAM_SIZE_CHANGED, this.updatePosition, this);
                    this.p2s.removeEventListener(window.adways.resource.events.RENDER_SIZE_CHANGED, this.updatePosition, this);
                    this.p2s.removeEventListener(window.adways.resource.events.PLAYER_SIZE_CHANGED, this.updatePosition, this);
                    this.p2s.removeEventListener(window.adways.resource.events.RENDER_TRANSFORM_CHANGED, this.updatePosition, this);
                    this.p2s.removeEventListener(window.adways.resource.events.STREAM_TRANSFORM_CHANGED, this.updatePosition, this);
                    window.adways.destruct(this.p2s);
                }
                if (this.s2p !== null)
                    window.adways.destruct(this.s2p);

                this.delegate = null;
                this.s2p = null;
                this.p2s = null;
            };

            getVPAIDAd = function() {
                return new LinearAd();
            };

            if (typeof window.adways === "undefined") {
                try {
                    var parentWindow = window;
                    while (typeof parentWindow.adways === "undefined" && parentWindow !== parentWindow.parent)
                        parentWindow = parentWindow.parent;
                    if (typeof parentWindow.adways !== "undefined")
                        window.adways = parentWindow.adways;
                } catch (err) {

                }
                if (window.adways === undefined)
                    window.adways = new Object();

                if (typeof window.adways.scw === "undefined") {
                    adwaysLibScriptTag = window.document.createElement("script");
                    adwaysLibScriptTag.type = "text/javascript";
                    adwaysLibScriptTag.src = "<?php echo Sphere::adwaysSCWJSLib; ?>";
                    if (window.document.body !== null) {
                        window.document.body.appendChild(adwaysLibScriptTag);
                    } else if (window.document.head !== null) {
                        window.document.head.appendChild(adwaysLibScriptTag);
                    }
                }
            }

            if (typeof window.adways.analytics === "undefined") {
                analyticsScriptTag = window.document.createElement("script");
                analyticsScriptTag.type = "text/javascript";
                analyticsScriptTag.src = "<?php echo Sphere::sdkAnalytics; ?>";
                if (window.document.body !== null) {
                    window.document.body.appendChild(analyticsScriptTag);
                } else if (window.document.head !== null) {
                    window.document.head.appendChild(analyticsScriptTag);
                }
            }
            var headHTML = window.document.getElementsByTagName("head")[0].innerHTML;

<?php if (false) { ?>
            }(window));
    <?php
}