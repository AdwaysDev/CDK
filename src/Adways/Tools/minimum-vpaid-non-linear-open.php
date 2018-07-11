<?php
header('Content-Type: text/javascript; charset=utf-8');
$useDefaultVideoSlot = (isset($_GET['useDefaultVideoSlot'])) ? $_GET['useDefaultVideoSlot'] : false;
$iab = (isset($_GET['iab'])) ? $_GET['iab'] : '';
    
use Adways\Model\Sphere;

/* Netbeans hack to have js syntax color hilighting */ if (false) {
    ?> <script> <?php } 
    ?>
(function (window) {
    var htmlAddEventListener = function (source, eventName, callback, useCapture) {
        if (arguments.length < 4)
            useCapture = false;
        if ((eventName === "load") && (typeof source.onload === "undefined")) {
            var onreadystatechangeEventHandler = function () {
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
    var htmlRemoveEventListener = function (source, eventName, callback, useCapture) {
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
//    var effectScriptTag = null;
    var that;
    var adwaysLibLoaded = false;
    var analyticsLibLoaded = false;

    NonLinearAd = function() {
        this.delegate = null;
        this._slot = null;
        this._videoSlot = null;
        this.VPAIDVersion = "2.0";
        // iAb object for player events listeners
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
        this.trueViewed = false;
        this.delegateClassname = null;
        this.delegateUrl = null;
        that = this;
        this.completionValue = 0;
        this.adImpressionDispatched = false;
        this.layer = null;
        this.fiframe = null;
        this.fiframeDoc = null;
        this.minTime = Number.NaN;
        this.maxTime = Number.NaN;
        this.width = Number.NaN;
        this.height = Number.NaN;
        this.viewMode = null;
        this.criteoTag = null;
        this.antvoiceTag = null;
        this.privacyLogo = null;
        this.nativeObjectDescription = null;
        this.initReady = false;
        this.cascadeConfig = null;
        this.quantumAdCallUrl = "";
        this.criteoBannerid = "";
        this.criteoZoneid = "";
        this.antvoiceUsePublisherScript = false;
        this.smartScriptURL = false;
        this.currentSSP = "";
        
        this.iab = '<?php echo $iab; ?>';
        
        this.sizeWatcherTimer = null;
        this.sizeWatcherListener = function() {
            that.updatePosition();
        };
    
        this.adwaysLibScriptTagLoadCb = function () {
            adwaysLibLoaded = true;
            htmlRemoveEventListener(adwaysLibScriptTag, "load", that.adwaysLibScriptTagLoadCb);
            that.loadAd();
        };
        this.delegateScriptTagLoadCb = function () {
//            console.log("delegateScriptTagLoadCb");
            htmlRemoveEventListener(delegateScriptTag, "load", that.delegateScriptTagLoadCb);
            // TODO : Cas FranceTVDelegate
            eval("that.delegate = new " + that.delegateClassname + "(that.p2s, that.s2p, that._videoSlot)");
<?php if (!isset($inContent) || !isset($sspMode)) { ?>
      //  that.init();
    <?php  if($timing_cta_select->getValue()["key"] == 'always'){ ?>        
            if (that.delegateClassname === "NoPlayerDelegate") {
                that.minTime = 0;
                that.maxTime = '<?php echo (isset($estimatedDuration) ? $estimatedDuration->getValue() : 0); ?>';
                that.duration = that.maxTime;        
            } else {                
                that.duration = that.p2s.getDuration();   
            }
            that.init();
    <?php }else{ ?>
            that.waitForInitialisation();
    <?php } ?>
<?php } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "smart-agence-v2") { ?>
                that.smartScriptURL = "<?php echo $scriptURL->getValue(); ?>";
                that.currentSSP = "smart-agence-v2";
                that.smartAdCallInit();
<?php } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "quantum") { ?>
                var quantumAdConfig = '<?php echo $sspEndpoint->getValue(); ?>';
                try{ 
                    quantumAdConfig = JSON.parse(quantumAdConfig); 
                } catch(e) {
                    console.log("quantumAdConfig = ",quantumAdConfig);
                }
                if(quantumAdConfig instanceof Object) {
                    that.quantumAdCallUrl = 'https://s.sspqns.com/adn?auid=';
                    if(that.iab !== '') {
                        if(quantumAdConfig[that.iab]) {    
                            that.quantumAdCallUrl += quantumAdConfig[that.iab];
                        } else if (quantumAdConfig['nocat']) {                        
                            that.quantumAdCallUrl += quantumAdConfig['nocat'];
                        } else {
                            var that2 = that;
                            var errorCb = function () {
                                that2.dispatchEvent("AdError", 915);
                            };
                            that.tracker.sendData({event_type: "error", event_name: "915", cbFunction: errorCb});
                        }
                    } else if (quantumAdConfig['nocat']) {                        
                        that.quantumAdCallUrl += quantumAdConfig['nocat'];
                    } else {
                        var that2 = that;
                        var errorCb = function () {
                            that2.dispatchEvent("AdError", 915);
                        };
                        that.tracker.sendData({event_type: "error", event_name: "915", cbFunction: errorCb});
                    }
                } else {
                    that.quantumAdCallUrl = quantumAdConfig;
                }
                that.currentSSP = "quantum";
                that.waitForInitialisation();
<?php } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "criteo") { ?>
                that.criteoBannerid = "<?php echo $bannerid->getValue(); ?>";
                that.criteoZoneid = '<?php echo $zoneid->getValue(); ?>';
                that.currentSSP = "criteo";
                that.waitForInitialisation();
<?php } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "antvoice") { ?>
                that.antvoiceUsePublisherScript  = <?php echo ($usePublisherScript->getValue()?'true':'false'); ?>;
                that.currentSSP = "antvoice";
                that.waitForInitialisation();
<?php } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "headerbidding") { ?>
                var quantumAdConfig = '<?php echo $sspEndpoint->getValue(); ?>';
                try{ 
                    quantumAdConfig = JSON.parse(quantumAdConfig); 
                } catch(e) {
                    console.log("quantumAdConfig = ",quantumAdConfig);
                }
                if(quantumAdConfig instanceof Object) {
                    if(that.iab !== '') {
                        if(quantumAdConfig[that.iab]) {    
                            that.quantumAdCallUrl = quantumAdConfig[that.iab];
                        } else if (quantumAdConfig['nocat']) {                        
                            that.quantumAdCallUrl = quantumAdConfig['nocat'];
                        } else {
                            var that2 = that;
                            var errorCb = function () {
                                that2.dispatchEvent("AdError", 915);
                            };
                            that.tracker.sendData({event_type: "error", event_name: "915", cbFunction: errorCb});
                        }
                    } else if (quantumAdConfig['nocat']) {                        
                        that.quantumAdCallUrl = quantumAdConfig['nocat'];
                    } else {
                        var that2 = that;
                        var errorCb = function () {
                            that2.dispatchEvent("AdError", 915);
                        };
                        that.tracker.sendData({event_type: "error", event_name: "915", cbFunction: errorCb});
                    }
                } else {
                    that.quantumAdCallUrl = quantumAdConfig;
                }
                that.criteoZoneid = '<?php echo $zoneid->getValue(); ?>';
                that.currentSSP = "headerbidding";
                that.waitForInitialisation();
<?php } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "cascade") { ?>
                that.cascadeConfig = new Array();
<?php  for($i=2;$i<count($ssp_group->propertiesToArray());$i++){
            $currentSSPGroup = $ssp_group->propertiesToArray()[$i];            
            $adCallSimpleSelection = $currentSSPGroup->propertiesToArray()[0];  
            if($adCallSimpleSelection->getValue()['key'] === "manual") { ?>
                var sspConfigManual = new Object();
                    sspConfigManual.key = "manual";
                    that.cascadeConfig.push(sspConfigManual);
            <?php }  
            if($adCallSimpleSelection->getValue()['key'] === "smart-agence-v2") {
                $scriptURL = $currentSSPGroup->propertiesToArray()[1]; ?>
                    var sspConfigSmart = new Object();
                    sspConfigSmart.key = "smart-agence-v2";
                    sspConfigSmart.scriptURL = "<?php echo $scriptURL->getValue(); ?>";
                    that.cascadeConfig.push(sspConfigSmart);
            <?php }
            if($adCallSimpleSelection->getValue()['key'] === "headerbidding") {
                $scriptURL = $currentSSPGroup->propertiesToArray()[1]; ?>
                    var sspConfigHeaderBidding = new Object();
                    sspConfigHeaderBidding.key = "headerbidding";
                    sspConfigHeaderBidding.zoneid = '<?php echo $zoneid->getValue(); ?>';                    
                    var quantumAdConfig = '<?php echo $sspEndpoint->getValue(); ?>';
                    try{ 
                        quantumAdConfig = JSON.parse(quantumAdConfig); 
                    } catch(e) {
                        console.log("quantumAdConfig = ",quantumAdConfig);
                    }
                    if(quantumAdConfig instanceof Object) {
                        if(that.iab !== '') {
                            if(quantumAdConfig[that.iab]) {    
                                sspConfigHeaderBidding.sspEndpoint = quantumAdConfig[that.iab];
                            } else if (quantumAdConfig['nocat']) {                        
                                sspConfigHeaderBidding.sspEndpoint = quantumAdConfig['nocat'];
                            } else {
                                var that2 = that;
                                var errorCb = function () {
                                    that2.dispatchEvent("AdError", 915);
                                };
                                that.tracker.sendData({event_type: "error", event_name: "915", cbFunction: errorCb});
                            }
                        } else if (quantumAdConfig['nocat']) {                        
                            sspConfigHeaderBidding.sspEndpoint = quantumAdConfig['nocat'];
                        } else {
                            var that2 = that;
                            var errorCb = function () {
                                that2.dispatchEvent("AdError", 915);
                            };
                            that.tracker.sendData({event_type: "error", event_name: "915", cbFunction: errorCb});
                        }
                    } else {
                        sspConfigHeaderBidding.sspEndpoint = quantumAdConfig;
                    }
                    that.cascadeConfig.push(sspConfigHeaderBidding);
            <?php }
            else if($adCallSimpleSelection->getValue()['key'] === "criteo") {
                $zoneid = $currentSSPGroup->propertiesToArray()[1]; ?>
                    var sspConfigCriteo = new Object();
                    sspConfigCriteo.key = "criteo";
                    sspConfigCriteo.zoneid = "<?php echo $zoneid->getValue(); ?>";
                    sspConfigCriteo.criteoBannerid = "";
                    that.cascadeConfig.push(sspConfigCriteo);
            <?php }
            else if($adCallSimpleSelection->getValue()['key'] === "antvoice") {
                $usePublisherScript = $currentSSPGroup->propertiesToArray()[1]; ?>
                    var sspConfigAntvoice = new Object();
                    sspConfigAntvoice.key = "antvoice";
                    sspConfigAntvoice.usePublisherScript = <?php echo ($usePublisherScript->getValue()?'true':'false'); ?>;
                    that.cascadeConfig.push(sspConfigAntvoice);
            <?php }
            else if($adCallSimpleSelection->getValue()['key'] === "quantum") {
                $sspEndpoint = $currentSSPGroup->propertiesToArray()[1]; ?>
                    var sspConfigQuantum = new Object();
                    sspConfigQuantum.key = "quantum";
//                    sspConfigQuantum.sspEndpoint = "<?php echo $sspEndpoint->getValue(); ?>";
                    
                    var quantumAdConfig = '<?php echo $sspEndpoint->getValue(); ?>';
                    try{ 
                        quantumAdConfig = JSON.parse(quantumAdConfig); 
                    } catch(e) {
                        console.log("quantumAdConfig = ",quantumAdConfig);
                    }
                    if(quantumAdConfig instanceof Object) {
                        sspConfigQuantum.sspEndpoint = 'https://s.sspqns.com/adn?auid=';
                        if(that.iab !== '') {
                            if(quantumAdConfig[that.iab]) {    
                                sspConfigQuantum.sspEndpoint += quantumAdConfig[that.iab];
                            } else if (quantumAdConfig['nocat']) {                        
                                sspConfigQuantum.sspEndpoint += quantumAdConfig['nocat'];
                            } else {
                                var that2 = that;
                                var errorCb = function () {
                                    that2.dispatchEvent("AdError", 915);
                                };
                                that.tracker.sendData({event_type: "error", event_name: "915", cbFunction: errorCb});
                            }
                        } else if (quantumAdConfig['nocat']) {                        
                            sspConfigQuantum.sspEndpoint += quantumAdConfig['nocat'];
                        } else {
                            var that2 = that;
                            var errorCb = function () {
                                that2.dispatchEvent("AdError", 915);
                            };
                            that.tracker.sendData({event_type: "error", event_name: "915", cbFunction: errorCb});
                        }
                    } else {
                        sspConfigQuantum.sspEndpoint = quantumAdConfig;
                    }   
                    that.cascadeConfig.push(sspConfigQuantum);
            <?php }
        } ?>       
//        console.log(that.cascadeConfig);
        that.waitForInitialisation();
    <?php } else { ?>
            that.prepareManualData();
    <?php  if($timing_cta_select->getValue()["key"] == 'always'){ ?>        
            if (that.delegateClassname === "NoPlayerDelegate") {
                that.minTime = 0;
                that.maxTime = '<?php echo (isset($estimatedDuration) ? $estimatedDuration->getValue() : 0); ?>';
                that.duration = that.maxTime;        
            } else {                
                that.duration = that.p2s.getDuration();;    
            }
            that.init();
    <?php }else{ ?>
            that.waitForInitialisation();
    <?php }
    } ?>
     };
        this.analyticsScriptTagLoadCb = function () {
            analyticsLibLoaded = true;
            htmlRemoveEventListener(analyticsScriptTag, "load", that.analyticsScriptTagLoadCb);
            that.tracker = new window.adways.analytics.Tracker({
                record_interface: "generic",
                creative_format: "<?php echo $template->getCurrentEntity()["template_id"]; ?>",
                creative_id: "<?php echo $template->getCurrentEntity()["id"]; ?>",
                random_number: function () {
                    return Math.random();
                }
            });
            that.loadAd();
        };
    };

    NonLinearAd.prototype.prepareManualData = function () {
    <?php
        $titleStr = isset($text_title)?$text_title->getValue():'';
        $contentStr = isset($text_content)?$text_content->getValue():'';
        $ctaTextValueStr = isset($ctaTextValue)?$ctaTextValue->getValue():'';
        $contentClickUrlStr = isset($contentClickUrl)?$contentClickUrl->getValue():'';
        $cardImageUrlStr = isset($cardImageUrl)?$cardImageUrl->getValue():'';
        $drawerImageUrlStr = isset($drawerImageUrl)?$drawerImageUrl->getValue():'';
        $sponsorClickUrlStr = isset($sponsorClickUrl)?$sponsorClickUrl->getValue():'';
        $text_sponsorStr = isset($text_sponsor)?$text_sponsor->getValue():'';
        $privacyClickUrlStr = isset($privacyClickUrl)?$privacyClickUrl->getValue():'';
    ?>
        if(typeof this.nativeObjectDescription === "undefined" || this.nativeObjectDescription === null){
            this.nativeObjectDescription = {
                "products": [{
                        "title": "<?php echo $titleStr; ?>",
                        "description": "<?php echo $contentStr; ?>",
                        "price": "",
                        "call_to_action": "<?php echo $ctaTextValueStr; ?>",
                        "click_url": "<?php echo $contentClickUrlStr; ?>",
                        "image": {
                            "url": "<?php echo $cardImageUrlStr; ?>",
                            "width": 400,
                            "height": 400
                        }
                    }],
                "advertiser": {
                    "logo": {
                        "url": "<?php echo $drawerImageUrlStr; ?>",
                        "width": 200,
                        "height": 200
                    },
                    "logo_click_url": "<?php echo $sponsorClickUrlStr; ?>",
                    "description": "<?php echo $text_sponsorStr; ?>",
                    "domain": "",
                    "legal_text": ""
                },
                "privacy": {
                    "optout_click_url": "<?php echo $privacyClickUrlStr; ?>",
                    "optout_image_url": "https://d1tvn48knwz507.cloudfront.net/icons/nai_small.png"
                }
            };
        } 
    };
<?php if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue()
            && $adCallSelection->getValue()['key'] === "cascade") { ?>
        NonLinearAd.prototype.cascadeAdCallInit = function () {
//            console.log("cascadeAdCallInit");
            if(this.cascadeConfig !== null && this.cascadeConfig.length>0) {
                var sspUnitConfig = this.cascadeConfig.shift();
//                console.log(sspUnitConfig);
                this.currentSSP = sspUnitConfig.key;
                if(sspUnitConfig.key === "smart-agence-v2" ) {
                    this.smartScriptURL = sspUnitConfig.scriptURL;
                    this.smartAdCallInit();
                } else if(sspUnitConfig.key === "criteo" ) {
                    this.criteoBannerid = sspUnitConfig.criteoBannerid;
                    this.criteoZoneid = sspUnitConfig.zoneid;
                    this.criteoAdCallInit();
                } else if(sspUnitConfig.key === "antvoice" ) {
                    this.antvoiceUsePublisherScript = sspUnitConfig.usePublisherScript;
                    this.antvoiceAdCallInit();
                } else if(sspUnitConfig.key === "quantum" ) {
                    this.quantumAdCallUrl = sspUnitConfig.sspEndpoint;
                    this.quantumAdCallInit();
                } else if(sspUnitConfig.key === "headerbidding" ) {
                    this.quantumAdCallUrl = sspUnitConfig.sspEndpoint;
                    this.criteoZoneid = sspUnitConfig.zoneid;
                    this.headerBiddingAdCallInit();
                } else if(sspUnitConfig.key === "manual" ) {
                    this.prepareManualData();
                    this.init();
                }
            }
        };
<?php } 
    if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() 
            && ($adCallSelection->getValue()['key'] === "quantum" || $adCallSelection->getValue()['key'] === "cascade")) { ?>
            NonLinearAd.prototype.quantumAdCallInit = function () {
            var adCallUrl = this.quantumAdCallUrl;
            var jsonRequest = new window.adways.ajax.Request();
            jsonRequest.setURL(adCallUrl);
            jsonRequest.setMethod("GET");
            jsonRequest.getXHR().withCredentials = true;
            jsonRequest.setContentType("text/plain");
            var that = this;
            var requestDoneListener = function (evt) {
                if (jsonRequest !== null && jsonRequest.getState() === window.adways.ajax.states.DONE) {
                    that.tracker.sendData({event_type: "addcallback", event_name: "quantum"});   
                    jsonRequest.removeEventListener(window.adways.ajax.events.STATE_CHANGED, requestDoneListener);
                    var rawResponseText = jsonRequest.getResponseText();
                    jsonRequest = null;
                    var responseObject = JSON.parse(rawResponseText);
//                    console.log(responseObject);
                    if (responseObject !== null && typeof (responseObject.cobj) !== "undefined" && responseObject.cobj !== null) {                    
                        that.nativeObjectDescription = {};
                        that.nativeObjectDescription.impression = [];
                        that.nativeObjectDescription.clickTrakers = [];
                        if (responseObject !== null && typeof (responseObject.nurl) !== "undefined" && responseObject.nurl !== null) {
                            that.nativeObjectDescription.impression.push(responseObject.nurl);
                        }
                        if (responseObject !== null && typeof (responseObject.sync) !== "undefined" && responseObject.sync !== null) {
                            that.nativeObjectDescription.impression.push(responseObject.sync);
                        }
                        that.tracker.sendData({event_type: "addcallbackOK", event_name: "quantum_criteo"});
                        var cobj = responseObject.cobj;
                        that.nativeObjectDescription.products = [{}];
                        that.nativeObjectDescription.products[0].image = {};
                        that.nativeObjectDescription.advertiser = {};
                        that.nativeObjectDescription.advertiser.logo = {};
                        if (typeof (cobj.title) !== "undefined") {//product titre
                            that.nativeObjectDescription.products[0].title = cobj.title;
                        }                        
                        if (typeof (cobj.description) !== "undefined") { //product desc
                            that.nativeObjectDescription.products[0].description = cobj.description;
                        }
                        if (typeof (cobj.image_url) !== "undefined") { //produit image
                            that.nativeObjectDescription.products[0].image.url = cobj.image_url;
                        }
                        if (typeof (cobj.adomain) !== "undefined") { //sponsor name
                            that.nativeObjectDescription.advertiser.description = cobj.adomain;
                        }
                        if (typeof (cobj.click_url) !== "undefined") { //product clic url
                            that.nativeObjectDescription.products[0].click_url = cobj.click_url;
                        }      
                        if (typeof (cobj.privacy) !== "undefined") { //privacy
                            that.nativeObjectDescription.privacy = cobj.privacy;
                        }    
                        if (typeof (cobj.impression_pixels) !== "undefined") { //impression pixels
                            that.nativeObjectDescription.impression = cobj.impression_pixels;
                        }
                        if (typeof (cobj.link) !== "undefined" && typeof (cobj.link.clicktrackers) !== "undefined") { //click tracker
                            that.nativeObjectDescription.clickTrakers = cobj.link.clicktrackers;
                        }
                        that.init();            
                    } else if (responseObject !== null && typeof (responseObject.native) !== "undefined" && responseObject.native !== null) {                    
                        that.nativeObjectDescription = {};
                        that.nativeObjectDescription.impression = [];
                        that.nativeObjectDescription.clickTrakers = [];
                        if (responseObject !== null && typeof (responseObject.nurl) !== "undefined" && responseObject.nurl !== null) {
                            that.nativeObjectDescription.impression.push(responseObject.nurl);
                        }
                        if (responseObject !== null && typeof (responseObject.sync) !== "undefined" && responseObject.sync !== null) {
                            that.nativeObjectDescription.impression.push(responseObject.sync);
                        }
                        that.tracker.sendData({event_type: "addcallbackOK", event_name: "quantum"});
                        var natives = responseObject.native;
                        that.nativeObjectDescription.products = [{}];
                        that.nativeObjectDescription.products[0].image = {};
                        that.nativeObjectDescription.advertiser = {};
                        that.nativeObjectDescription.advertiser.logo = {};
                        if (natives.assets !== null && natives.assets.length > 0) {
                            for (var i = 0; i < natives.assets.length; i++) {
                                var native = natives.assets[i];
                                switch (native.id) {
                                    case 1 : //product titre
                                        that.nativeObjectDescription.products[0].title = native.title.text;
                                        break;
                                    case 2 : //sponsor image url
                                        that.nativeObjectDescription.advertiser.logo.url = native.img.url;
                                        that.nativeObjectDescription.advertiser.logo.width = native.img.w;
                                        that.nativeObjectDescription.advertiser.logo.height = native.img.h;
                                        //                                        that.nativeObjectDescription.advertiser.logo.width = 400;
                                        //                                        that.nativeObjectDescription.advertiser.logo.height = 400;
                                        break;
                                    case 3 : //product desc
                                        that.nativeObjectDescription.products[0].description = native.data.value;
                                        break;
                                    case 4 : //produit image
                                        that.nativeObjectDescription.products[0].image.url = native.img.url;
                                        that.nativeObjectDescription.products[0].image.width = native.img.w;
                                        that.nativeObjectDescription.products[0].image.height = native.img.h;
                                        break;
                                    case 10 : //sponsor name
                                        that.nativeObjectDescription.advertiser.description = native.data.value;
                                        break;
                                    case 2003 : //product clic url
                                        that.nativeObjectDescription.products[0].click_url = native.data.value;
                                        break;
                                }
                            }
                        }
                        if (natives.imptrackers && natives.imptrackers.length > 0) {
                            for (var j = 0; j < natives.imptrackers.length; j++) {
                                that.nativeObjectDescription.impression.push(natives.imptrackers[j]);
                            }
                        }
                        if (natives.link && natives.link.url) {
                            //that.nativeObjectDescription.advertiser.logo_click_url = natives.link.url;
                            that.nativeObjectDescription.products[0].click_url = natives.link.url;
                            if (natives.link.clicktrackers) {
                                that.nativeObjectDescription.clickTrakers = natives.link.clicktrackers;
                            }
                        }
                        that.init();
                    } else {
                        if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                            that.cascadeAdCallInit();
                        } else {
                            var that2 = that;
                            var errorCb = function () {
                                that2.dispatchEvent("AdError", 911);
                            };
                            that.tracker.sendData({event_type: "error", event_name: "911", cbFunction: errorCb});
                        }
                    }
                }
            };
            this.tracker.sendData({event_type: "addcall", event_name: "quantum"});
            jsonRequest.addEventListener(window.adways.ajax.events.STATE_CHANGED, requestDoneListener);
            jsonRequest.load();
        };
<?php }
    if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() 
            && ($adCallSelection->getValue()['key'] === "criteo" || $adCallSelection->getValue()['key'] === "cascade")) { ?>
        NonLinearAd.prototype.criteoAdCallInit = function () {
            var bannerid = this.criteoBannerid;
            var that = this;
            window.Criteo = window.Criteo || {};
            window.Criteo.events = window.Criteo.events || [];
            var addCallbackTimeout = true;
            var requestBidCB = function(res) {
                addCallbackTimeout = false;
                that.tracker.sendData({event_type: "addcallback", event_name: "criteo"});
//                console.log('requestBidCB', res);
                if(res && res.length>0 && res[0].nativePayload) {
//                    console.log('requestBidCB OK');
                    var response = res[0].nativePayload;
                    that.tracker.sendData({event_type: "addcallbackOK", event_name: "criteo"});
                    that.nativeObjectDescription = {};
                    if (typeof (response.advertiser) !== "undefined") {
                        that.nativeObjectDescription.advertiser = response.advertiser;
                    }
                    if (typeof (response.privacy) !== "undefined") {
                        that.nativeObjectDescription.privacy = response.privacy;
                    }
                    if (typeof (response.impression_pixels) !== "undefined") {
                        that.nativeObjectDescription.impression = response.impression_pixels;
                    }
                    if (typeof (response.products) !== "undefined" && response.products.length > 0) {
                        that.nativeObjectDescription.products = response.products;
                        that.init();
                    }
                } else {             
                    if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                        that.cascadeAdCallInit();
                    } else {
                        var errorCode = "920";
                        var that2 = that;
                        var errorCb = function () {
                            that2.dispatchEvent("AdError", errorCode);
                        };
                        that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                    }
                }
            }
            var adUnits = {
                "placements": [
                {
                    "slotid": "ad-unit-0",
                    "zoneid": that.criteoZoneid,
                    "nativeCallback": function(assets) { 
                        that.tracker.sendData({event_type: "addcallbackOKAlternative", event_name: "criteo"});
                        // Custom function to render the native ad.
//                        console.log('nativeCallback', assets);
                    }
                }
                ]
            };
            
            if(bannerid !== '') {
                adUnits.placements.bannerid = bannerid;
            }
            
            Criteo.events.push(function() {
//                console.log("Criteo.events.push");
                // Define the price band range
//                Criteo.SetLineItemRanges("0..10:0.01;10..25:0.05;25..50:0.10;50..100:0.25");
                Criteo.SetLineItemRanges("0..1:1;1..15:0.25");
                // Call Criteo and execute the callback function for a given timeout
                Criteo.RequestBids(adUnits, requestBidCB, 700);
                setTimeout(
                    function(){
//                        console.log("setTimeout criteo");
                        if(addCallbackTimeout) {
                            that.tracker.sendData({event_type: "addCallbackTimeout", event_name: "criteo"});
                            if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                                that.cascadeAdCallInit();
                            } else {
                                var errorCode = "920";
                                var that2 = that;
                                var errorCb = function () {
                                    that2.dispatchEvent("AdError", errorCode);
                                };
                                that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                            }
                        }
                    }, 1000);
            });

            this.tracker.sendData({event_type: "addcall", event_name: "criteo"});
            this.criteoTag = window.document.createElement("script");
            this.criteoTag.src = "https://static.criteo.net/js/ld/publishertag.js";;
            this.criteoTag.type = "application/javascript";
            this.criteoTag.async = true;
            function requestErrorListener(e) {
                console.log(e);                
                if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                    that.cascadeAdCallInit();
                } else {
                    var errorCode = "920";
                    var that2 = that;
                    var errorCb = function () {
                        that2.dispatchEvent("AdError", errorCode);
                    };
                    that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                }
            }
            this.criteoTag.addEventListener("error", requestErrorListener);
            window.document.getElementsByTagName("head")[0].appendChild(this.criteoTag);
        };
<?php }
    if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() 
            && ($adCallSelection->getValue()['key'] === "headerbidding" || $adCallSelection->getValue()['key'] === "cascade")) { ?>
        NonLinearAd.prototype.headerBiddingAdCallInit = function () {  
//            console.log('headerBiddingAdCallInit');          
            var that = this;
            window.pbjs = window.pbjs || {};
            window.pbjs.que = window.pbjs.que || [];   
            var bidCallback = function(bidResponses) {
//                console.log('bidCallback', bidResponses);
                that.tracker.sendData({event_type: "addcallback", event_name: "headerbidding"});

                if(typeof bidResponses['ad-unit-0'] != 'undefined'){
                    var winner = pbjs.getAdserverTargetingForAdUnitCode('ad-unit-0');
                    var sspWinner = winner['hb_bidder'];
                    var adId = winner['hb_adid'];
                    var assets = null;

                    // console.log('winner : ', sspWinner, adId);

                    switch(sspWinner) {
                        case 'quantum' : 
                            // assets : 
                            for (var i = 0; i < bidResponses['ad-unit-0']['bids'].length; i ++){
                                var curr = bidResponses['ad-unit-0']['bids'][i];
                                if(curr['adId'] === adId){
                                    that.currentSSP += "-quantum";
                                    assets = curr['native'];
                                    that.nativeObjectDescription = {};
                                    that.nativeObjectDescription.impression = [];
                                    that.nativeObjectDescription.clickTrakers = [];
                                    if (curr !== null && typeof (curr.nurl) !== "undefined" && curr.nurl !== null) {
                                        that.nativeObjectDescription.impression.push(curr.nurl);
                                    }
                                    if (curr !== null && typeof (curr.sync) !== "undefined" && curr.sync !== null) {
                                        that.nativeObjectDescription.impression.push(curr.sync);
                                    }
                                    that.tracker.sendData({event_type: "addcallbackOK", event_name: "headerbidding", event_data: "quantum"});
                                    var natives = assets
                                    that.nativeObjectDescription.products = [{}];
                                    that.nativeObjectDescription.products[0].image = {};
                                    that.nativeObjectDescription.advertiser = {};
                                    that.nativeObjectDescription.advertiser.logo = {};
                                    if (natives.assets !== null && natives.assets.length > 0) {
                                        for (var i = 0; i < natives.assets.length; i++) {
                                            var native = natives.assets[i];
                                            switch (native.id) {
                                                case 1 : //product titre
                                                    that.nativeObjectDescription.products[0].title = native.title.text;
                                                    break;
                                                case 2 : //sponsor image url
                                                    that.nativeObjectDescription.advertiser.logo.url = native.img.url;
                                                    that.nativeObjectDescription.advertiser.logo.width = native.img.w;
                                                    that.nativeObjectDescription.advertiser.logo.height = native.img.h;
                                                    //                                        that.nativeObjectDescription.advertiser.logo.width = 400;
                                                    //                                        that.nativeObjectDescription.advertiser.logo.height = 400;
                                                    break;
                                                case 3 : //product desc
                                                    that.nativeObjectDescription.products[0].description = native.data.value;
                                                    break;
                                                case 4 : //produit image
                                                    that.nativeObjectDescription.products[0].image.url = native.img.url;
                                                    that.nativeObjectDescription.products[0].image.width = native.img.w;
                                                    that.nativeObjectDescription.products[0].image.height = native.img.h;
                                                    break;
                                                case 10 : //sponsor name
                                                    that.nativeObjectDescription.advertiser.description = native.data.value;
                                                    break;
                                                case 2003 : //product clic url
                                                    that.nativeObjectDescription.products[0].click_url = native.data.value;
                                                    break;
                                            }
                                        }
                                    }
                                    if (natives.imptrackers && natives.imptrackers.length > 0) {
                                        for (var j = 0; j < natives.imptrackers.length; j++) {
                                            that.nativeObjectDescription.impression.push(natives.imptrackers[j]);
                                        }
                                    }
                                    if (natives.link && natives.link.url) {
                                        //that.nativeObjectDescription.advertiser.logo_click_url = natives.link.url;
                                        that.nativeObjectDescription.products[0].click_url = natives.link.url;
                                        if (natives.link.clicktrackers) {
                                            that.nativeObjectDescription.clickTrakers = natives.link.clicktrackers;
                                        }
                                    }
                                    that.init();
                                    break;
                                }
                            }
                            break;
                        case 'criteo' : 
                            var win = window;            
                            for (var i = 0; i < 10; ++i) {                    
                                if (win.criteo_prebid_native_slots) {
                                    that.currentSSP += "-criteo";                    
                                    var responseSlot = win.criteo_prebid_native_slots[adId];
                                    assets = responseSlot.payload;
                                    that.tracker.sendData({event_type: "addcallbackOK", event_name: "headerbidding", event_data: "criteo"});
                                    that.nativeObjectDescription = {};
                                    if (typeof (assets.advertiser) !== "undefined") {
                                        that.nativeObjectDescription.advertiser = assets.advertiser;
                                    }
                                    if (typeof (assets.privacy) !== "undefined") {
                                        that.nativeObjectDescription.privacy = assets.privacy;
                                    }
                                    if (typeof (assets.impression_pixels) !== "undefined") {
                                        that.nativeObjectDescription.impression = assets.impression_pixels;
                                    }
                                    if (typeof (assets.products) !== "undefined" && assets.products.length > 0) {
                                        that.nativeObjectDescription.products = assets.products;
                                        that.init();
                                    }
                                    break;
                                } else {      
                                    win = win.parent;      
                                }
                            }
                            break;
                    }
//                    console.log('assets : ', assets);                    
                } else {           
                    if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                        that.cascadeAdCallInit();
                    } else {
                        var errorCode = "920";
                        var that2 = that;
                        var errorCb = function () {
                            that2.dispatchEvent("AdError", errorCode);
                        };
                        that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                    }
                }
            }
            pbjs.que.push(function() {
//                console.log('push');

//                pbjs.setConfig({
//                    debug: false
//                });

                var adUnits = {
                    code: "ad-unit-0",
                    sizes: [
                        [360, 360]
                    ],
                    bids: [
                        {
                            bidder: "criteo",
                            params: {
                                zoneId: that.criteoZoneid, 
                                nativeCallback: function(assets) { // just to specify that is a native ad
                                }
                            }
                        },{
                            bidder: "quantum",
                            params: {
                                placementId : that.quantumAdCallUrl ,
                                nativeCallback: function(assets) { // just to specify that is a native ad
                                }
                            }
                        }
                    ]
                };

                pbjs.addAdUnits(adUnits);
                pbjs.requestBids({
                    bidsBackHandler: bidCallback
                });
            });

            this.tracker.sendData({event_type: "addcall", event_name: "headerbidding"});
            this.prebidTag = window.document.createElement("script");
            this.prebidTag.src = "<?php echo Sphere::adwaysContentHttpRootPath; ?>v3/tools/Vpaid/prebid.js";
            // TODO TODO
            this.prebidTag.type = "application/javascript";
            this.prebidTag.async = true;
            function requestErrorListener(e) {
                console.log(e);                
                 if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                     that.cascadeAdCallInit();
                 } else {
                    var errorCode = "920";
                    var that2 = that;
                    var errorCb = function () {
                        that2.dispatchEvent("AdError", errorCode);
                    };
                    that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                 }
            }
            this.prebidTag.addEventListener("error", requestErrorListener);
//            this.prebidTag.addEventListener("load", function() {console.log('script prebid loaded');});
            window.document.getElementsByTagName("head")[0].appendChild(this.prebidTag);
        };

<?php } if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() 
            && ($adCallSelection->getValue()['key'] === "antvoice" || $adCallSelection->getValue()['key'] === "cascade")) { ?>
            NonLinearAd.prototype.antvoiceAdCallInit = function () {
                //Permet de tracker les comportement utilisateurs
                var that = this;
                if(!this.antvoiceUsePublisherScript) {
                    if(!window.av3w)
                        {window.av3w = {};}
                    window.av3w.productUrl = location.href;
                    if(window.self!=window.top)
                    {
                        window.av3w.productUrl= document.referrer;
                    }			
                    window.av3w.project = "adways";                
                    var _i = document.createElement("img");   
                    var _iURL = "https://ads.avads.net/v1/tracking?type=behavior&owner="+ window.av3w.project+"&url="+encodeURIComponent(window.av3w.productUrl)+"&act=view&market=FR&lang=fr-FR&cat=www";
                    _i.src =_iURL;                
                    function requestErrorListener(e) {
                        console.log(e);                
                        if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                            that.cascadeAdCallInit();
                        } else {
                            var errorCode = "920";
                            var that2 = that;
                            var errorCb = function () {
                                that2.dispatchEvent("AdError", errorCode);
                            };
                            that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                        }
                    }
                    _i.addEventListener("error", requestErrorListener);
                    window.document.getElementsByTagName("head")[0].appendChild(_i);
                    if(!window.antvoice_variable)
                        {window.antvoice_variable = {};}
                    window.antvoice_variable.project = "adways";
                } else {
                    if (typeof window.av3w == "undefined") {
                        try {
                            var parentWindow = window;
                            while (typeof parentWindow.av3w == "undefined" && parentWindow != parentWindow.parent)
                                parentWindow = parentWindow.parent;
                            if (typeof parentWindow.av3w != "undefined")
                                window.av3w = parentWindow.av3w;
                        } catch (err) {
                            if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                                that.cascadeAdCallInit();
                            } else {
                                var errorCode = "940";
                                var that2 = that;
                                var errorCb = function () {
                                    that2.dispatchEvent("AdError", errorCode);
                                };
                                that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                            }
                            return -1;
                        }
                        if (typeof window.av3w === "undefined") {
                            if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                                that.cascadeAdCallInit();
                            } else {
                                var errorCode = "930";
                                var that2 = that;
                                var errorCb = function () {
                                    that2.dispatchEvent("AdError", errorCode);
                                };
                                that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                            }
                            return -1;
                        }
                    }
                    if(!window.antvoice_variable)
                        {window.antvoice_variable = {};}
                    window.antvoice_variable.project = window.av3w.publisher

                }                     
                if(!srEnsureReady){
                    function srEnsureReady(callback) {
                        if (!window.srReady) {
                            window.setTimeout(function () {srEnsureReady(callback);}, 50);
                        }
                        else {
                            callback();
                        }
                    };
                }

                //Chargement de la librairie JS AntVoice            
                this.tracker.sendData({event_type: "addcall", event_name: "antvoice"});
                this.antvoiceTag = window.document.createElement("script");
                this.antvoiceTag.src = "https://js.avads.net/sr-"+window.antvoice_variable.project+".js";;
                this.antvoiceTag.type = "application/javascript";
                function requestErrorListener(e) {
                    console.log(e);                
                    if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                        that.cascadeAdCallInit();
                    } else {
                        var errorCode = "920";
                        var that2 = that;
                        var errorCb = function () {
                            that2.dispatchEvent("AdError", errorCode);
                        };
                        that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                    }
                }
                this.antvoiceTag.addEventListener("error", requestErrorListener);
                window.document.getElementsByTagName("head")[0].appendChild(this.antvoiceTag);
                
                var addCallbackTimeout = true;
                setTimeout(
                    function(){
                        if(addCallbackTimeout) {
                            that.tracker.sendData({event_type: "addCallbackTimeout", event_name: "antvoice"});
                            if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                                that.cascadeAdCallInit();
                            } else {
                                var errorCode = "920";
                                var that2 = that;
                                var errorCb = function () {
                                    that2.dispatchEvent("AdError", errorCode);
                                };
                                that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                            }
                        }
                    }, 1000);

                //AntVoice recommendation Call V2
                // Async Call to AntVoice Ad Recommendation
                srEnsureReady(
                    function(){
                        addCallbackTimeout = false;
                        that.tracker.sendData({event_type: "addcallback", event_name: "antvoice"});
                        _sr.getReco([{
                            areaId: "ADWAYS_NATIVE_AD",
                            location : "Unspecified",
                            rendering : {
                                onSuccess : function(data){
                                    // Templating actions here (or use defined function instead)
//                                    console.log("Something to recommend");
//                                    console.log(JSON.stringify(data));  

                                var responseObject = data;
//                                console.log(responseObject);
                                if (responseObject !== null && responseObject.assets !== null) {
                                        that.tracker.sendData({event_type: "addcallbackOK", event_name: "antvoice"});
                                        that.nativeObjectDescription = {};
                                        that.nativeObjectDescription.products = [{}];
                                        if (responseObject.assets.title !== null)
                                            that.nativeObjectDescription.products[0].title = responseObject.assets.title;
                                        if (responseObject.assets.summary !== null)
                                            that.nativeObjectDescription.products[0].description = responseObject.assets.summary;
                                        if (responseObject.assets.click_url !== null)
                                            that.nativeObjectDescription.products[0].click_url = responseObject.assets.click_url;
                                        if (responseObject.assets.image !== null) {
                                            that.nativeObjectDescription.products[0].image = {};
                                            that.nativeObjectDescription.products[0].image.url = responseObject.assets.image;
                                            that.nativeObjectDescription.products[0].image.width = 400;
                                            that.nativeObjectDescription.products[0].image.height = 400;
                                        }
                                        that.nativeObjectDescription.advertiser = {};
                                        that.nativeObjectDescription.advertiser.logo = {};
                                        if (responseObject.assets.sponsor_logo !== null) {
                                            that.nativeObjectDescription.advertiser.logo.url = responseObject.assets.sponsor_logo;
                                            that.nativeObjectDescription.advertiser.logo.width = 400;
                                            that.nativeObjectDescription.advertiser.logo.height = 400;
                                        }
                                        if (responseObject.assets.sponsor_name !== null) {
                                            that.nativeObjectDescription.advertiser.description = responseObject.assets.sponsor_name;
                                        }
                                        if (responseObject.assets.sponsor_url !== null) {
                                            that.nativeObjectDescription.advertiser.logo_click_url = responseObject.assets.sponsor_url;
                                        }                                        
                                        if (responseObject.assets.recoId !== null) {
                                            that.nativeObjectDescription.recoId = responseObject.assets.recoId;
                                        }
                                        if (responseObject.assets.catalogId !== null) {
                                            that.nativeObjectDescription.catalogId = responseObject.assets.catalogId;
                                        }
                                        if (responseObject.assets.productId !== null) {
                                            that.nativeObjectDescription.productId = responseObject.assets.productId;
                                        }
                                        if (responseObject.imp_trackers !== null) {
                                            that.nativeObjectDescription.impression = responseObject.imp_trackers;
                                        }
                                        that.init();
                                    } else {
                                        var that2 = that;
                                        var errorCb = function () {
                                            that2.dispatchEvent("AdError", 911);
                                        };
                                        that.tracker.sendData({event_type: "error", event_name: "911", cbFunction: errorCb});
                                    }
                                },
                                onError : function(data){
                                    if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                                        that.cascadeAdCallInit();
                                    } else {
                                        // Fallback actions here (or use defined function instead)
//                                        console.log("Nothing to recommend");
//                                        console.log(JSON.stringify(data));                                    
                                        var errorCode = "911";
                                        var that2 = that;
                                        var errorCb = function () {
                                            that2.dispatchEvent("AdError", errorCode);
                                        };
                                        that.tracker.sendData({event_type: "error", event_name: errorCode, cbFunction: errorCb});
                                    }
                                    return -1;
                                }
                            }
                            ,tracking: {
                                subTracker : "<?php echo $template->getCurrentEntity()["id"] ?>"
                            }
                        }]);
                    }
                );                 

            };
<?php } if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() 
            && ($adCallSelection->getValue()['key'] === "smart-agence-v2" || $adCallSelection->getValue()['key'] === "cascade")) { ?>
            NonLinearAd.prototype.smartAdCallInit = function () {
            var that = this;
            var requestDoneListener = function (evt) {
                if (fiframe.contentDocument.URL == "about:blank")
                    return -1;
                var nativeDataDiv = fiframe.contentDocument.querySelector("#adw_sas_nativeDataDiv");
                if (nativeDataDiv == null) {
                    var that2 = that;
                    if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                        that.cascadeAdCallInit();
                    } else {
                        var errorCb = function () {
                            that2.dispatchEvent("AdError", 910);
                        };
                        that.tracker.sendData({event_type: "error", event_name: "910", cbFunction: errorCb});
                    }
                } else {
                    fiframe.removeEventListener("load", requestDoneListener);
//                                        console.log("innerHTML",nativeDataDiv.innerHTML);
                    var responseObject = JSON.parse(nativeDataDiv.innerHTML);
//                                        console.log(responseObject);
                    that.tracker.sendData({event_type: "addcallback", event_name: "smart-agence-v2"});
                    if (responseObject !== null && responseObject.assets !== null) {
                        that.tracker.sendData({event_type: "addcallbackOK", event_name: "smart-agence-v2"});
                        that.nativeObjectDescription = {};
                        that.nativeObjectDescription.products = [{}];
                        if (responseObject.assets.title !== null)
                            that.nativeObjectDescription.products[0].title = responseObject.assets.title;
                        if (responseObject.assets.description !== null)
                            that.nativeObjectDescription.products[0].description = responseObject.assets.description;
                        if (responseObject.assets.click_url !== null)
                            that.nativeObjectDescription.products[0].click_url = responseObject.assets.click_url;
                        if (responseObject.assets.image !== null) {
                            that.nativeObjectDescription.products[0].image = {};
                            that.nativeObjectDescription.products[0].image.url = responseObject.assets.image;
                            that.nativeObjectDescription.products[0].image.width = 400;
                            that.nativeObjectDescription.products[0].image.height = 400;
                        }
                        that.nativeObjectDescription.advertiser = {};
                        that.nativeObjectDescription.advertiser.logo = {};
                        if (responseObject.assets.sponsor_logo !== null) {
                            that.nativeObjectDescription.advertiser.logo.url = responseObject.assets.sponsor_logo;
                            that.nativeObjectDescription.advertiser.logo.width = 400;
                            that.nativeObjectDescription.advertiser.logo.height = 400;
                        }
                        if (responseObject.assets.sponsor_name !== null) {
                            that.nativeObjectDescription.advertiser.description = responseObject.assets.sponsor_name;
                        }
                        if (responseObject.assets.sponsor_url !== null) {
                            that.nativeObjectDescription.advertiser.logo_click_url = responseObject.assets.sponsor_url;
                        }
                        //                        if (responseObject.assets.click_url !== null)
                        //                            that.nativeObjectDescription.logo_click_url = responseObject.assets.click_url;

                        if (responseObject.imp_trackers !== null) {
                            that.nativeObjectDescription.impression = responseObject.imp_trackers;
                        }

                        that.init();
                    } else {
                        var that2 = that;
                        if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                            that.cascadeAdCallInit();
                        } else {
                            var errorCb = function () {
                                that2.dispatchEvent("AdError", 911);
                            };
                            that.tracker.sendData({event_type: "error", event_name: "911", cbFunction: errorCb});
                        }
                    }
                }
            };
            try {
                var fiframe = this._slot.ownerDocument.createElement("iframe");
                fiframe.style.border = "0px",
                    fiframe.style.overflow = "hidden",
                    //                fiframe.style.display = "none",
                    fiframe.scrolling = "no";
                fiframe.addEventListener("load", requestDoneListener);
                this._slot.ownerDocument.body.appendChild(fiframe);
                var a = '<html><head><scr' + 'ipt type="application/javascript" src="'+this.smartScriptURL+'"></scr' + 'ipt></head><body></body></html>';
                this.fiframeDoc = fiframe.contentDocument ? fiframe.contentDocument : (fiframe.contentWindow ? fiframe.contentWindow.document : fiframe.document);
                this.fiframeDoc.open("text/html");
                this.fiframeDoc.write(a);
                this.fiframeDoc.close();
    
//                this.fiframeDoc.body.style.margin = 0;
//                this.fiframeDoc.body.style.border = 0;
//                this.fiframeDoc.body.style.padding = 0;
            } catch (e) {
//                console.log("error :", e);
                var that = this;
                    if(that.cascadeConfig !== null && that.cascadeConfig.length>0) {
                        that.cascadeAdCallInit();
                    } else {
                    var errorCb = function () {
                        that.dispatchEvent("AdError", 912);
                    };
                    this.tracker.sendData({event_type: "error", event_name: "912", cbFunction: errorCb});
                }
            }
            this.tracker.sendData({event_type: "addcall", event_name: "smart-agence-v2"});
        };
<?php } ?>
    NonLinearAd.prototype.buildFiFrame = function () {
        this.fiframe = this._slot.ownerDocument.createElement("iframe");
//        this.fiframe.style.border = "0px",
//        this.fiframe.style.overflow = "hidden",
//        this.fiframe.scrolling = "no";
//        this.fiframe.style.position = "absolute";
//        this.fiframe.style.top = "0px";
//        this.fiframe.style.left = "0px";
//        this.fiframe.style.width = "0%";
//        this.fiframe.style.height = "0%";
        
		this.fiframe.style.setProperty("border", "0px", "important");
		this.fiframe.style.setProperty("overflow", "hidden", "important");
		this.fiframe.style.setProperty("scrolling", "no", "important");
		this.fiframe.style.setProperty("position", "absolute", "important");
		this.fiframe.style.setProperty("top", "0px", "important");
		this.fiframe.style.setProperty("left", "0px", "important");
		this.fiframe.style.setProperty("width", "0%", "important");
		this.fiframe.style.setProperty("height", "0%", "important");
		this.fiframe.style.setProperty("max-width", "none", "important");
		this.fiframe.style.setProperty("max-height", "none", "important");
        
        this._slot.appendChild(this.fiframe);
        var a = "<html><head></head><body></body></html>";
        this.fiframeDoc = this.fiframe.contentDocument ? this.fiframe.contentDocument : (this.fiframe.contentWindow ? this.fiframe.contentWindow.document : this.fiframe.document);
        this.fiframeDoc.open("text/html");
        this.fiframeDoc.write(a);
        this.fiframeDoc.close();
    
        this.fiframeDoc.body.style.margin = 0;
        this.fiframeDoc.body.style.border = 0;
        this.fiframeDoc.body.style.padding = 0;
    };
    
    NonLinearAd.prototype.initAd = function(width, height, viewMode, desiredBitrate, creativeData, environmentVars) {
       this.width = width;
       this.height = height;
       this.viewMode = viewMode;
       this.prepareCrea(environmentVars);
       this.loadLib();    
	};
    
    NonLinearAd.prototype.prepareCrea = function(environmentVars) {    
        if (window.document.body !== null) {
            window.document.body.style.margin = 0;
            window.document.body.style.border = 0;
            window.document.body.style.padding = 0;
            window.document.body.style.background = "transparent";
        }
        this._videoSlot = environmentVars.videoSlot;
        if (typeof environmentVars.slot !== "undefined" && environmentVars.slot !== null) {
            this._slot = environmentVars.slot;
        } else {
            if (typeof(this._videoSlot.getContainer)=="function" && this._videoSlot.getContainer()!==null) {
                this._slot = this._videoSlot.getContainer();
            } else {
                this._slot = this._videoSlot;
            }
        }  
    
	};
    
    NonLinearAd.prototype.loadLib = function() {
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
    
    NonLinearAd.prototype.loadAd = function () {
//        console.log("this.adwaysLibLoaded", this.adwaysLibLoaded, "this.analyticsLibLoaded", this.analyticsLibLoaded)
        if (adwaysLibLoaded && analyticsLibLoaded) {
            
            var iab = this.iab;
            if(iab !== '') this.tracker.sendData({event_type: "iab", event_name: "loadAd", event_data: iab});
            
//            console.log("loadAd libs charges");
            this.s2p = new adways.interactive.SceneControllerWrapper();
            this.p2s = new adways.interactive.SceneControllerWrapper();
            this.resizeAd(this.width, this.height, this.viewMode);
            var playerDetector = new adways.playerHelpers.PlayerDetector();
            var playerDetectorRes = playerDetector.playerClassFromPlayerAPI(this._videoSlot);
            if (playerDetectorRes === "noplayer") {
//                playerDetectorRes = "noplayer";
                this._videoSlot = new Object();
                this._videoSlot.overlay = this._slot;
                this.delegateUrl = "<?php echo Sphere::CDNAdPathsLibs; ?>libs/delegates/noplayer.js";
                this.delegateClassname = "NoPlayerDelegate";
                this.buildDelegate();
            } else {
                this.requestPlayerClassFromJSConstant(playerDetectorRes);
            }
        }
    };
//----------------------------------------------------------------------------------------------------------------------------------------------------
    NonLinearAd.prototype.requestPlayerClassFromJSConstant = function (playerDetectorRes) {

        if (playerDetectorRes === "")
            return -1;
        var playerClassGetURL = "<?php echo $templateConfig['adwaysServicesPath']; ?>player-class?filter-js_constant=" + playerDetectorRes.toUpperCase();
        if (typeof (adways.tweaks.forceProtocol) !== "undefined") {
            if (playerClassGetURL.search(/^http[s]?\:\/\//) === -1) {
                playerClassGetURL = adways.tweaks.forceProtocol + ":" + playerClassGetURL;
            }
        }

        var playerClassRequest = new adways.ajax.Request();
        playerClassRequest.setURL(playerClassGetURL);
        playerClassRequest.setMethod("GET");
        playerClassRequest.addHeader("Accept", "application/json");
        playerClassRequest.setContentType("application/json");
        var that = this;
        var requestDoneListener = function (evt) {
            if (playerClassRequest !== null && playerClassRequest.getState() === adways.ajax.states.DONE) {
                playerClassRequest.removeEventListener(adways.ajax.events.STATE_CHANGED, requestDoneListener);
                var responseText = playerClassRequest.getResponseText();
                playerClassRequest = null;
                var responseParsed = null;
                responseParsed = JSON.parse(responseText);
                if (responseParsed["_embedded"] && responseParsed["_embedded"]["collection"]
                    && responseParsed["_embedded"]["collection"][0]) {
                    that.delegateUrl = responseParsed["_embedded"]["collection"][0]["delegate_url"];
                    if (!that.delegateUrl.match("^\/[\/\/]+")) {
                        if (that.delegateUrl[0] === "/") {
                            that.delegateUrl = that.delegateUrl.substr(1, that.delegateUrl.length);
                        }
                        that.delegateUrl = "<?php echo Sphere::CDNAdPathsLibs; ?>" + that.delegateUrl;
                    }

                    that.delegateClassname = responseParsed["_embedded"]["collection"][0]["delegate_classname"];
                    that.buildDelegate();
                }
            }
        };
        playerClassRequest.addEventListener(adways.ajax.events.STATE_CHANGED, requestDoneListener);
        playerClassRequest.load();
        return 1;
    };
    
//----------------------------------------------------------------------------------------------------------------------------------------------------
    NonLinearAd.prototype.buildDelegate = function () {

        delegateScriptTag = document.createElement("script");
        if (typeof (adways.tweaks.isIE) === "number" && adways.tweaks.isIE <= 8)
            delegateScriptTag.type = "text/javascript";
        else
            delegateScriptTag.type = "application/javascript";
        var delegateScriptTagSrc = this.delegateUrl;
        if (typeof (adways.tweaks.forceProtocol) !== "undefined") {
            if (delegateScriptTagSrc.search(/^http[s]?\:\/\//) === -1) {
                delegateScriptTagSrc = adways.tweaks.forceProtocol + ":" + delegateScriptTagSrc;
            }
        }
        delegateScriptTag.src = delegateScriptTagSrc;
        adways.misc.html.addEventListener(delegateScriptTag, "load", this.delegateScriptTagLoadCb);
        document.getElementsByTagName("head")[0].appendChild(delegateScriptTag);
        return 1;
    };
    
    NonLinearAd.prototype.init = function() {    
        this.initBegin();
        this.initEnd();
    };
    
    NonLinearAd.prototype.initBegin = function () {
        var that = this;
        this.layer = new adways.interactive.Layer(adways.hv.layerIds.HOTSPOT);
        if (this._slot == this._videoSlot) {
//            this.s2p.pause(true);
            this.s2p.layerAdded(this.layer);
            var adContainer = this.layer.getDomElement();
            this._slot = adContainer;
//            adContainer.style.position = "";
        }
        this.buildFiFrame();
        this.updatePosition();
    };
    NonLinearAd.prototype.waitForInitialisation = function () {
        // console.log('waitForInitialisation');
    <?php if ($timing_cta_select->getValue()["key"] === 'always') { ?>
            this.minTime = 0;
            if (this.delegateClassname === "NoPlayerDelegate") {
                this.maxTime = '<?php echo (isset($estimatedDuration) ? $estimatedDuration->getValue() : 0); ?>';
            }
            else {
                this.maxTime = this.p2s.getDuration();
                this.duration = this.maxTime;
                if(!isNaN(this.duration))
                    this.dispatchEvent("AdDurationChange", this.duration);
                this.p2s.addEventListener(window.adways.resource.events.DURATION_CHANGED, this.durationChangedCb, this);
            }
            this.duration = this.maxTime;
    <?php } else if ($timing_cta_select->getValue()["key"] === 'second') { ?>
            this.minTime = Math.max('<?php echo $time_start->getValue(); ?>', 0);
            this.maxTime = '<?php echo $time_end->getValue(); ?>';
            this.duration = this.maxTime - this.minTime;
    <?php } else if ($timing_cta_select->getValue()["key"] === '%') { ?>
            var estimatedDuration = this.p2s.getDuration();
            if (this.delegateClassname === "NoPlayerDelegate") {
                estimatedDuration ='<?php echo (isset($estimatedDuration) ? $estimatedDuration->getValue() : 0); ?>';
            }
            this.minTime = Math.max('<?php echo $time_start->getValue(); ?>', 0);
            this.maxTime = '<?php echo $time_end->getValue(); ?>';
            this.minTime *= estimatedDuration;
            this.maxTime *= estimatedDuration;
            this.duration = this.maxTime - this.minTime;
   <?php } ?>         
        if (this.delegateClassname === "NoPlayerDelegate") {
            this.p2s.setCurrentTime(0, true);
			var that = this;
			if(this.minTime>0) {
				setTimeout(function() {
						that.p2s.setCurrentTime(that.minTime+0.1, true);
					}, that.minTime*1000
				);
			}
        }
        this.waitForInitCurrentTimeChangedCb();
        this.p2s.addEventListener(window.adways.resource.events.CURRENT_TIME_CHANGED, this.waitForInitCurrentTimeChangedCb, this);
    };
    NonLinearAd.prototype.initEnd = function () {
    <?php if ($timing_cta_select->getValue()["key"] === 'always') { ?>
            this.minTime = 0;
            if (this.delegateClassname === "NoPlayerDelegate") {
                this.maxTime = '<?php echo (isset($estimatedDuration) ? $estimatedDuration->getValue() : 0); ?>';
            }
            else {
                this.maxTime = this.p2s.getDuration();
            }
//            this.duration = this.maxTime;
//            this.dispatchEvent("AdDurationChange", this.duration);
            //this.p2s.addEventListener(window.adways.resource.events.DURATION_CHANGED, this.durationChangedCb, this);
   <?php } else if ($timing_cta_select->getValue()["key"] === 'second') { ?>
            this.minTime = Math.max('<?php echo $time_start->getValue(); ?>', 0);
            this.maxTime = '<?php echo $time_end->getValue(); ?>';
            this.duration = this.maxTime - this.minTime;
            this.dispatchEvent("AdDurationChange", this.duration);
    <?php } else if ($timing_cta_select->getValue()["key"] === '%') { ?>
            var estimatedDuration = this.p2s.getDuration();
            if (this.delegateClassname === "NoPlayerDelegate") {
                estimatedDuration ='<?php echo (isset($estimatedDuration) ? $estimatedDuration->getValue() : 0); ?>';
            }
            this.minTime = Math.max('<?php echo $time_start->getValue(); ?>', 0);
            this.maxTime = '<?php echo $time_end->getValue(); ?>';
            this.minTime *= estimatedDuration;
            this.maxTime *= estimatedDuration;
            this.duration = this.maxTime - this.minTime;
            this.dispatchEvent("AdDurationChange", this.duration);';
    <?php } ?>
        var that = this;
        this.p2s.addEventListener(window.adways.resource.events.STREAM_SIZE_CHANGED, this.updatePosition, this);
        this.p2s.addEventListener(window.adways.resource.events.RENDER_SIZE_CHANGED, this.updatePosition, this);
        this.p2s.addEventListener(window.adways.resource.events.PLAYER_SIZE_CHANGED, this.updatePosition, this);
        this.p2s.addEventListener(window.adways.resource.events.RENDER_TRANSFORM_CHANGED, this.updatePosition, this);
        this.p2s.addEventListener(window.adways.resource.events.STREAM_TRANSFORM_CHANGED, this.updatePosition, this);
        this.p2s.addEventListener(window.adways.resource.events.PLAY_STATE_CHANGED, this.playStateChangedCb, this);
        this.p2s.addEventListener(window.adways.resource.events.VOLUME_CHANGED, this.volumeChangedCb, this);
        this.p2s.addEventListener(window.adways.resource.events.MUTED_CHANGED, this.muteChangedCb, this);
        this.p2s.addEventListener(window.adways.resource.events.FULLSCREEN_CHANGED, this.fullscreenChangedCb, this);
        this.tracker.sendData({event_type: "state", event_name: "loaded"});
        this.dispatchEvent("AdLoaded");
        this.currentTimeChangedCb();
        this.p2s.addEventListener(window.adways.resource.events.CURRENT_TIME_CHANGED, this.currentTimeChangedCb, this);
    };
    
    NonLinearAd.prototype.setPlayState = function () {
        if (arguments[0] === window.adways.resource.playStates.PLAYING) {
//            if (!this.videoStarted) {
//                this.videoStarted = true;
            this.dispatchAdStarted();
//            }
            this.dispatchEvent("AdPlaying");
            this.tracker.sendData({event_type: "state", event_name: "play"});
        } else if (arguments[0] === window.adways.resource.playStates.PAUSED) {
            this.tracker.sendData({event_type: "state", event_name: "pause"});
            this.dispatchEvent("AdPaused");
            var currentTime = this.p2s.getCurrentTime() - this.minTime;
            if (this.duration !== 0 && (currentTime + 0.75) >= this.duration) {
                this.finalStopCb();
            }
        }
    };
    
    NonLinearAd.prototype.finalStopCb = function () {
        if (this.finalStop)
            return;
        this.finalStop = true;
        var that = this;
        var stopCb = function () {
            var that2 = that;
            var completionAndStopCb = function () {
                that2.dispatchEvent("AdVideoComplete");
                that2.destroy();
                that2.dispatchEvent("AdStopped");
            };
            that.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: 100, event_unit: "%", cbFunction: completionAndStopCb});
        };
        this.tracker.sendData({event_type: "state", event_name: "stop", cbFunction: stopCb});
    };
    NonLinearAd.prototype.durationChangedCb = function () {
        var newDuration = this.p2s.getDuration();
        if (newDuration !== 0 && this.duration !== newDuration) {
            this.duration = this.p2s.getDuration();
            this.dispatchEvent("AdDurationChange", this.duration);
        }
    };
    NonLinearAd.prototype.fullscreenChangedCb = function (e) {
        if (this.p2s.getFullscreen().valueOf()) {
            this.tracker.sendData({event_type: "state", event_name: "enterFullscreen"});
            this.dispatchEvent("AdEnterFullscreen", this.duration);
        } else {
            this.tracker.sendData({event_type: "state", event_name: "exitFullscreen"});
            this.dispatchEvent("AdExitFullscreen", this.duration);
        }
    };

    NonLinearAd.prototype.updatePosition = function () {
        
    };        
        
    NonLinearAd.prototype.currentTimeChangedCb = function () {
        // var duration = this.p2s.getDuration().valueOf();
//         console.log("duration", this.p2s.getDuration().valueOf());
        var currentTime = this.p2s.getCurrentTime().valueOf();
        var relativeCurrentTime = currentTime;
        if (isNaN(this.minTime) || this.minTime > currentTime) {
            // console.log("isNaN(this.minTime) || this.minTime > currentTime");
            this.fiframe.style.display = "none";
            return;
        }
        else {
            relativeCurrentTime = currentTime - this.minTime;
        }

        var newRemainingTime = parseFloat((this.duration - relativeCurrentTime).toFixed(2));
        if (this.duration !== -2 && !isNaN(newRemainingTime) && newRemainingTime !== this.remainingTime) {

            this.remainingTime = newRemainingTime;
            this.dispatchEvent("AdRemainingTimeChange");
            if ("<?php echo $timing_cta_select->getValue()["key"]; ?>" !== "always" && "<?php echo $timing_cta_select->getValue()["key"]; ?>" !== "never") {
                var typeTime = "<?php echo $timing_cta_select->getValue()['key']; ?>";
                var time_start = '<?php echo $time_start->getValue(); ?>';
                var time_end = '<?php echo $time_end->getValue(); ?>';
                if (typeTime === "%") {
                    var estimatedDuration = this.p2s.getDuration();
                    if (this.delegateClassname === "NoPlayerDelegate") {
                        estimatedDuration = 60;
                    }
                    time_start *= estimatedDuration;
                    time_end *= estimatedDuration;
                }
                if (currentTime > time_start && currentTime < time_end) {
                    this.fiframe.style.display = "block";
                    if (!this.adImpressionDispatched) {
                        this.updatePosition();
                        this.adImpressionDispatched = true;
                        this.dispatchEvent("AdImpression");
                        
                        if(this.sizeWatcherTimer === null && this.delegateClassname === "NoPlayerDelegate")
                            this.sizeWatcherTimer = setInterval(this.sizeWatcherListener, 250);  
                            
                        this.tracker.sendData({event_type: "state", event_name: "impression"});            
                        var iab = this.iab;
                        if(iab !== '') this.tracker.sendData({event_type: "iab", event_name: "impression", event_data: iab});
                        /*if(this.nativeObjectDescription.advertiser.description && this.nativeObjectDescription.advertiser.description!=="") {
                            this.tracker.sendData({event_type: "state", event_name: "advertiser_"+this.nativeObjectDescription.advertiser.description});                    
                        }*/
                        if (typeof (this.nativeObjectDescription) !== "undefined" && this.nativeObjectDescription != null && typeof (this.nativeObjectDescription.impression) !== "undefined") {
                            var impressionPixels = this.nativeObjectDescription.impression;
                            for (var i = 0; i < impressionPixels.length; i++) {
                                var impressionPixel = impressionPixels[i];
                                if (impressionPixel.url && typeof impressionPixel.url == "string") {
                                    (new Image(0, 0)).src = impressionPixel.url;
                                } else if (typeof impressionPixel == "string") {
                                    (new Image(0, 0)).src = impressionPixel;
                                }
                            }
                        }
                    }
                } else {
                    // console.log("else");
                    this.fiframe.style.display = "none";
                }
            } else if ("<?php echo $timing_cta_select->getValue()["key"]; ?>" == "always") {
                if (!this.adImpressionDispatched) {
                    this.fiframe.style.display = "block";
                    this.updatePosition();
                    this.adImpressionDispatched = true;
                    this.dispatchEvent("AdImpression");
                    
                    if(this.sizeWatcherTimer === null && this.delegateClassname === "NoPlayerDelegate")
                        this.sizeWatcherTimer = setInterval(this.sizeWatcherListener, 250);  
                        
                    this.tracker.sendData({event_type: "state", event_name: "impression"});    
                    var iab = this.iab;
                    if(iab !== '') this.tracker.sendData({event_type: "iab", event_name: "impression", event_data: iab});                    
                    /*if(this.nativeObjectDescription.advertiser.description && this.nativeObjectDescription.advertiser.description!=="") {
                        this.tracker.sendData({event_type: "state", event_name: "advertiser_"+this.nativeObjectDescription.advertiser.description});                    
                    }*/
                    if (typeof (this.nativeObjectDescription) !== "undefined" && this.nativeObjectDescription != null && typeof (this.nativeObjectDescription.impression) !== "undefined") {
                        var impressionPixels = this.nativeObjectDescription.impression;
                        for (var i = 0; i < impressionPixels.length; i++) {
                            var impressionPixel = impressionPixels[i];
                            if (impressionPixel.url && typeof impressionPixel.url == "string") {
                                (new Image(0, 0)).src = impressionPixel.url;
                            } else if (typeof impressionPixel == "string") {
                                (new Image(0, 0)).src = impressionPixel;
                            }
                        }
                    }
                }
            }

            if (typeof this.tracker != "undefined" && !isNaN(this.duration)) { // envoi completion et trueview
                if (relativeCurrentTime >= 0.1 && !this.quartiles.zero) {
//                     console.log("started");
                    this.completionValue = 0;
                    this.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: this.completionValue, event_unit: "%"});
                    this.quartiles.zero = true;
                    this.dispatchEvent("AdVideoStart");
                }
                if (relativeCurrentTime >= (this.duration * 0.25) && !this.quartiles.first) {
                    this.completionValue = 25;
                    this.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: this.completionValue, event_unit: "%"});
                    this.quartiles.first = true;
                    this.dispatchEvent("AdVideoFirstQuartile");
                }
                if (relativeCurrentTime >= (this.duration * 0.50) && !this.quartiles.mid) {
                    this.completionValue = 50;
                    this.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: this.completionValue, event_unit: "%"});
                    this.quartiles.mid = true;
                    this.dispatchEvent("AdVideoMidpoint");
                }
                if (relativeCurrentTime >= (this.duration * 0.75) && !this.quartiles.third) {
                    this.completionValue = 75;
                    this.tracker.sendData({event_type: "completion", event_name: "<?php echo $template->getCurrentEntity()["id"]; ?>", event_data: this.completionValue, event_unit: "%"});
                    this.quartiles.third = true;
                    this.dispatchEvent("AdVideoThirdQuartile");
                }
                if ((relativeCurrentTime + 0.75) >= this.duration && !this.quartiles.last) {
                    this.finalStopCb();
                }
                var trueviewTime = '<?php echo $trueview->getValue(); ?>';
                if ("<?php echo $type_trueview_select->getValue()['key']; ?>" === "percentage_tv")
                    trueviewTime *= this.duration;
                if (relativeCurrentTime >= trueviewTime && !this.trueViewed) {
                    this.trueViewed = true;
                    trueviewTime = Math.floor(trueviewTime);
                    this.tracker.sendData({event_type: "state", event_name: "trueview", event_data: trueviewTime, event_unit: "s"});
                }
            }
        } else {
            // console.log("autre else", this.duration, newRemainingTime, this.remainingTime);
//            this.fiframe.style.display = "none";
        }
    };
    
    NonLinearAd.prototype.waitForInitCurrentTimeChangedCb = function () { 
    // console.log("waitForInitCurrentTimeChangedCb");   
        if(this.initReady)
            return;
        var currentTime = this.p2s.getCurrentTime().valueOf();
        var relativeCurrentTime = currentTime;
        if (isNaN(this.minTime) || this.minTime > currentTime) {
            return;
        }
        else {
            relativeCurrentTime = currentTime - this.minTime;
        }
        var newRemainingTime = parseFloat((this.duration - relativeCurrentTime).toFixed(2));
        if (this.duration !== -2 && !isNaN(newRemainingTime)) {
            if ("<?php echo $timing_cta_select->getValue()["key"]; ?>" !== "always" && "<?php echo $timing_cta_select->getValue()["key"]; ?>" !== "never") {
                var typeTime = "<?php echo $timing_cta_select->getValue()['key']; ?>";
                var time_start = '<?php echo $time_start->getValue(); ?>';
                var time_end = '<?php echo $time_end->getValue(); ?>';
                if (typeTime === "%") {
                    var estimatedDuration = this.p2s.getDuration();
                    if (this.delegateClassname === "NoPlayerDelegate") {
                        estimatedDuration = 60;
                    }
                    time_start *= estimatedDuration;
                    time_end *= estimatedDuration;
                }
                if (currentTime > time_start && currentTime < time_end) {
                    this.customInit();
                }
            } else if ("<?php echo $timing_cta_select->getValue()["key"]; ?>" == "always") {
                this.customInit();
            }
        } 
    };
    
    NonLinearAd.prototype.customInit = function () {         
        var that = this;       
//        console.log("customInit");    
        this.initReady = true;
        this.p2s.removeEventListener(window.adways.resource.events.CURRENT_TIME_CHANGED, this.waitForInitCurrentTimeChangedCb, this);    
        try {            
            function tryObserve() {
//                console.log("tryObserve");    
                var observer = null;
                var numSteps = 20.0; 
                var boxElement = that._slot;                   
                if (that.delegateClassname === "VideoJSDelegate") {
                    boxElement = that._slot.el();
                }
                function createObserver() {  
                    var options = {
                        root: null,
                        rootMargin: "0px",
                        threshold: buildThresholdList()
                      };
                    observer = new IntersectionObserver(handleIntersect, options);
                    observer.observe(boxElement);
                };        
                function buildThresholdList() {
                    var thresholds = [];
                    for (var i=1.0; i<=numSteps; i++) {
                      var ratio = i/numSteps;
                      thresholds.push(ratio);
                    }
                    thresholds.push(0);
                    return thresholds;
                };        
                function handleIntersect(entries, observer) {
                  entries.forEach(function(entry) {
//                      console.log("handleIntersect" , entry.intersectionRatio);
                        if(entry.intersectionRatio >= 0.5) {
//                            console.log("visible");
                            observer.unobserve(boxElement);    
                            that.customInitOK();
                        }
                  });
                };
//                console.log(that._slot, that._videoSlot);          
//                var magicCode = (boxElement === that._videoSlot);
//                console.log("magicCode", magicCode, adways.misc.html.userAgent.UA.browser[0].identifier);
//                if(magicCode) {
                    if(adways.misc.html.userAgent.UA.browser[0].identifier === adways.misc.html.userAgent.FIREFOX) {
                        that.customInitOK();                        
                    } else {
                        createObserver();
                    }
//                } else {
//                    createObserver();
//                }
            }
            if (document.visibilityState == "visible") {
//                console.log("visibilityState visible");  
                tryObserve();   
            } else {
                function handleVisibilityChange() {
//                    console.log("handleVisibilityChange");
                    if (document.visibilityState == "visible") {
                        htmlRemoveEventListener(document, "visibilitychange", handleVisibilityChange);
                        tryObserve();
                    } 
                }
                htmlAddEventListener(document, "visibilitychange", handleVisibilityChange);
            }
        } catch (e) {
//            console.log("customInit catch", e);   
            that.customInitOK();            
        }
    };
    
    NonLinearAd.prototype.customInitOK = function () {
//                console.log("customInitOK");
    <?php
    if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "smart-agence-v2") {
        echo '           that.smartAdCallInit();';
    } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "quantum") {
        echo '           that.quantumAdCallInit();';
    } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "criteo") {
        echo '            that.criteoAdCallInit();';
    } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "antvoice") {
        echo '            that.antvoiceAdCallInit();';
    } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "cascade") {
        echo '            that.cascadeAdCallInit();';
	} else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "headerbidding") {
        echo '            that.headerBiddingAdCallInit();';
    } else if (isset($inContent) && isset($sspMode) && isset($adCallSelection) && $inContent->getValue() && $sspMode->getValue() && $adCallSelection->getValue()['key'] === "manual") {
        echo '            that.init();';
    } else if (!isset($inContent) || !isset($sspMode)) {
        echo '            that.init();';
    }
    ?>
//        this.initReady = true;
//        this.p2s.removeEventListener(window.adways.resource.events.CURRENT_TIME_CHANGED, this.waitForInitCurrentTimeChangedCb, this);
    };
    
    NonLinearAd.prototype.muteChangedCb = function (e) {
        if (this.p2s.getMuted().valueOf()) {
            this.dispatchEvent("AdMuted");
        } else {
            this.dispatchEvent("AdUnmuted");
        }
    };
    NonLinearAd.prototype.volumeChangedCb = function (e) {
        this.dispatchEvent("AdVolumeChange");
    };
    NonLinearAd.prototype.playStateChangedCb = function (e) {
        if (this.videoStarted) {
            playstate = this.p2s.getPlayState().valueOf();
            this.setPlayState(playstate);
        }
    };
    NonLinearAd.prototype.dispatchAdStarted = function () {
        if (!this.videoStarted) {
            this.videoStarted = true;
            //        this.dispatchEvent("AdVideoStart");
            this.dispatchEvent("AdStarted");
            this.tracker.sendData({event_type: "state", event_name: "start"});
        }
    };
    NonLinearAd.prototype.startAd = function () {

        if (this.delegateClassname === "NoPlayerDelegate") { //hack pour mettre en play le nodelegate
            this.s2p.play(true);
//            if (!this.videoStarted) {
//                this.videoStarted = true;
            this.dispatchAdStarted();
//            }
            this.dispatchEvent("AdPlaying");
            this.tracker.sendData({event_type: "state", event_name: "play"});
        }
        else {
            if (this.p2s.getPlayState().valueOf() === window.adways.resource.playStates.PLAYING) {
                this.dispatchAdStarted();
//                if (!this.videoStarted) {
//                    this.videoStarted = true;
//                    this.dispatchEvent("AdVideoStart");
//                }
            }
            else
                this.p2s.addEventListener(window.adways.resource.events.PLAY_STATE_CHANGED, this.p2sPlayStatesChangedCb, this);
        }
    };
    NonLinearAd.prototype.p2sPlayStatesChangedCb = function (e) {
        if (e.getDispatcher().getPlayState().valueOf() === window.adways.resource.playStates.PLAYING) {
            this.p2s.removeEventListener(window.adways.resource.events.PLAY_STATE_CHANGED, this.p2sPlayStatesChangedCb, this);
            this.dispatchAdStarted();
        }
    };
    NonLinearAd.prototype.getAdLinear = function () {
        return false;
    };
    NonLinearAd.prototype.stopAd = function (e, p) {
//        console.log("stopAd");
        this.destroy();
        this.dispatchEvent("AdStopped");
        this.tracker.sendData({event_type: "state", event_name: "stop"});
    };
    NonLinearAd.prototype.getAdDuration = function () {
        return this.duration;
    };
    NonLinearAd.prototype.getAdRemainingTime = function () {
        return this.remainingTime;
    };
    NonLinearAd.prototype.setAdVolume = function (val) {
        if (val < 0)
            val = 0;
        if (val > 1)
            val = 1;
        if (this.s2p != null) {
            this.s2p.setVolume(val);
            if (val > 0) {
                this.s2p.unmute(true);
            }
        }
    };
    NonLinearAd.prototype.getAdVolume = function () {
        this.p2s.getVolume().valueOf();
    };
    NonLinearAd.prototype.resizeAd = function (width, height, viewMode) {
        if (viewMode === "fullscreen" && !this.p2s.getFullscreen().valueOf()) {
            this.s2p.enterFullscreen(true);
        } else if (this.p2s.getFullscreen().valueOf()) {
            this.s2p.exitFullscreen(true);
        }

        if (this.delegateClassname === "NoPlayerDelegate"
            && this.delegate !== null) {
            this.delegate.setSizes(width, height);
        }
        this.updatePosition();
    };
    NonLinearAd.prototype.pauseAd = function () {
        this.s2p.pause(true);
    };
    NonLinearAd.prototype.resumeAd = function () {
        this.s2p.play(true);
    };
    NonLinearAd.prototype.expandAd = function () {
    };
    NonLinearAd.prototype.getAdExpanded = function (val) {
    };
    NonLinearAd.prototype.getAdSkippableState = function (val) {
    };
    NonLinearAd.prototype.collapseAd = function () {
    };
    NonLinearAd.prototype.skipAd = function () {
        this.dispatchEvent("AdSkipped");
        var that = this;
        var skipCb = function () {
            that.destroy();
            that.dispatchEvent("AdStopped");
        };
        this.tracker.sendData({event_type: "state", event_name: "skip",
            completion_value: this.completionValue,
            completion_ref: "<?php echo $template->getCurrentEntity()["id"]; ?>", cbFunction: skipCb});
    };
    NonLinearAd.prototype.handshakeVersion = function (version) {
        return this.VPAIDVersion;
    };
    NonLinearAd.prototype.getAdIcons = function () {
    };
    NonLinearAd.prototype.getAdWidth = function () {
        return (typeof this.fiframe !== "undefined") ? this.fiframe.offsetWidth : 0;
    };
    NonLinearAd.prototype.getAdHeight = function () {
        return (typeof this.fiframe !== "undefined") ? this.fiframe.offsetHeight : 0;
    };
    NonLinearAd.prototype.subscribe = function (fn, evt, inst) {
        if (typeof (this.listeners[evt]) === "undefined")
            this.listeners[evt] = new Array();
        var tmpObj = new Object();
        tmpObj.fcn = fn;
        tmpObj.inst = (arguments.length > 2 ? inst : null);
        this.listeners[evt][this.listeners[evt].length] = tmpObj;
    };
    NonLinearAd.prototype.unsubscribe = function (evt) {
        try {
            if (typeof (this.listeners[evt]) !== "undefined")
                delete this.listeners[evt];
        }
        catch (e) {
            console.warn(e);
        }
    };
    NonLinearAd.prototype.dispatchEvent = function (evt) {
        var args = new Array();
        for (var i = 1; i < arguments.length; i++)
            args.push(arguments[i]);
        if (typeof (this.listeners[evt]) !== "undefined") {
            for (var i = 0; i < this.listeners[evt].length; i++) {
                this.listeners[evt][i].fcn.apply(this.listeners[evt][i].inst, args);
            }
        }
    };
    
////----------------------------------------------------------------------------------------------------------------------------------------------------
    NonLinearAd.prototype.destroy = function () {
        if (this.drawerObject)
            this.drawerObject.destroy();
//        if (this.s2p !== null)
//            this.s2p.pause(true);

        if (this.sizeWatcherTimer) {
            clearInterval(this.sizeWatcherTimer);
            this.sizeWatcherTimer = null;
        }

        if (this.delegate !== null)
            window.adways.destruct(this.delegate);
        if (this.p2s !== null) {
            this.p2s.removeEventListener(window.adways.resource.events.PLAY_STATE_CHANGED, this.playStateChangedCb, this);
            this.p2s.removeEventListener(window.adways.resource.events.VOLUME_CHANGED, this.volumeChangedCb, this);
            this.p2s.removeEventListener(window.adways.resource.events.MUTED_CHANGED, this.muteChangedCb, this);
            this.p2s.removeEventListener(window.adways.resource.events.CURRENT_TIME_CHANGED, this.currentTimeChangedCb, this);
            this.p2s.removeEventListener(window.adways.resource.events.FULLSCREEN_CHANGED, this.fullscreenChangedCb, this);
            if ("<?php echo $timing_cta_select->getValue()["key"]; ?>" === "always") {
                this.p2s.removeEventListener(window.adways.resource.events.DURATION_CHANGED, this.durationChangedCb, this);
            }
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
        if (this.fiframe !== null && this.fiframe.parentNode !== null)
            this.fiframe.parentNode.removeChild(this.fiframe);
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
        analyticsScriptTag = document.createElement("script");
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