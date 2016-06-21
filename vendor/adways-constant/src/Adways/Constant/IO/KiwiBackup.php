<?php
namespace Adways\Constant\IO;

// save/load json fields
abstract class KiwiBackup {
    
    const PROJECT_BACKUP_VERSION = 'project_backup_version';
    
    const KIWI_BACKUP_SYMBOLS_VERSION_KEY = 'kiwi_backup_symbols_version';
    const KIWI_BACKUP_SYMBOLS_VERSION_VALUE = 1.4;
    
    const VALUE = 'value';
    const VALUE_X = 'x';
    const VALUE_Y = 'y';

    /*
     * Analytics Consts
     */
    const ANALYTICS = 'analytics';    
    const ANALYTICS_TRACKERS = 'trackers';  
    const TRACKERS_KIND = 'kind';  
    const TRACKERS_CONF = 'conf';  
    const TRACKERS_UA = 'ua';  
    const TRACKERS_URL = 'url';  
    
    /*
     * 
     */
    const VERSION = 'version';            
    const DATA = 'data';            
    const PLAYER_PLUGIN_MANAGER = 'video';
    const MEDIA_MANAGER = 'media_rpc_authorization';
    const PROJECT = 'project';    
    const PUBLICATION = 'publication';    
    const SAVE = 'save';

    const VIDEO_NAME = 'name';        
    const VIDEO_MIME = 'mime';        
    const VIDEO_XKEY = 'xkey';
    const VIDEO_ASSETS = 'assets';    

    const MEDIA_URL = 'path';
    const MEDIA_ID = 'id';    

    const PROJECT_SCENE = 'scene';        

    const ADW_CLASS = 'adw_class';
    
    const ID = 'id';
    
    const CLASS_NATIVE_NUMBER                   = 1;  
    const CLASS_NATIVE_STRING                   = 2;
    const CLASS_NATIVE_BOOLEAN                  = 3;  
    const CLASS_ARRAY_NATIVE_NUMBER             = 4;  
    const CLASS_ARRAY_NATIVE_STRING             = 5;  
    const CLASS_ARRAY_NATIVE_BOOLEAN            = 6;  
    const CLASS_ARRAY                           = 7;  
    
    const CLASS_MATH_VECTOR2                    = 8;
    const CLASS_MATH_VECTOR4                    = 9; 
    const CLASS_MATH_MATRIX22                   = 10;
    const CLASS_MATH_EVT_VECTOR2                = 11;
    const CLASS_MATH_EVT_VECTOR4                = 12;  
    const CLASS_MATH_EVT_MATRIX22               = 13; 
    const CLASS_MATH_EVT_COMPOUNDV2             = 14;  
    const CLASS_MATH_EVT_COMPOUNDV2R            = 15;  
    const CLASS_MATH_EVT_OP_NUMBER              = 16;  
    
    const CLASS_TYPE_BOOLEAN                    = 17;
    const CLASS_TYPE_ENUM                       = 18;
    const CLASS_TYPE_NUMBER                     = 19;
    const CLASS_TYPE_RANGE                      = 20;
    const CLASS_TYPE_STRING                     = 21;
    const CLASS_TYPE_EVT_BOOLEAN                = 22;
    const CLASS_TYPE_EVT_ENUM                   = 23;
    const CLASS_TYPE_EVT_NUMBER                 = 24;
    const CLASS_TYPE_EVT_RANGE                  = 25;
    const CLASS_TYPE_EVT_STRING                 = 26;
    
    const CLASS_TIME_TIME                       = 54;
    const CLASS_TIME_TIMER                      = 55;  

    const CLASS_GEOM_TRANSFORM2                 = 27;
    const CLASS_GEOM_EVT_TRANSFORM2             = 28;
    const CLASS_GEOM_TRANSFORM2_NODE_SET        = 29;  
    const CLASS_GEOM_SIMPLET2                   = 30; 

    const CLASS_LAYOUT_PANE                     = 31;   
    
    const CLASS_HV_DELAYOUT                     = 32;
    const CLASS_HV_ENRICHMENT                   = 33;
    const CLASS_HV_ACTIVATION_ACTION_MODEL      = 34;
    const CLASS_HV_PLAY_PAUSE_ACTION_MODEL      = 35;
    const CLASS_HV_SEEK_TO_ACTION_MODEL         = 36;
    const CLASS_HV_URL_ACTION_MODEL             = 37;
    const CLASS_HV_ANCHOR2                      = 38; 
    const CLASS_HV_SCENE                        = 50; 
    const CLASS_HV_LAYER                        = 51; 
    
    const CLASS_KIWI_MODEL_TAM                      = 39;    
    const CLASS_KIWI_MODEL_CONTENT                  = 40;
    const CLASS_KIWI_MODEL_DISPLAYABLE_ENRICHMENT   = 41;    
    const CLASS_KIWI_MODEL_ACTION_SET               = 42;    
    const CLASS_KIWI_MODEL_ANCHOR2                  = 43;    
    
    const CLASS_KIWI_CONTROLLER_BOOLEAN_TRACK         = 44;
    const CLASS_KIWI_CONTROLLER_TIMELINE_INTERVAL     = 45;
    const CLASS_KIWI_CONTROLLER_VIDEO_MANAGER     = 52;
    const CLASS_KIWI_MODEL_VIDEO_PLAYER            = 53;
    const CLASS_KIWI_CONTROLLER_MEDIA_MANAGER            = 56;
    
    const CLASS_ANIM_INTERVAL                   = 46;
    const CLASS_ANIM_BOOLEAN              = 57;  
//    const CLASS_ANIM_KEY_FRAME              = 58;  
    const CLASS_ANIM_NUMBERKFM_KEYFRAME     = 58;  
    
    const CLASS_RESOURCE_RESOURCE               = 47;  
    
    const CLASS_KIWI_MODEL_DISTANCE              = 48;  
    
    const CLASS_PROPERTY              = 49;  
    
    const CLASS_HV_CUE_POINT              = 59;  
    const CLASS_HV_CUE_POINT_DATA_ELEMENT      = 60;  
    const CLASS_HV_ENRICHMENT_CPDE      = 61;  
    const CLASS_HV_TAM      = 66;  
    
    const VIDEO_PLAYER_ID = 'id';
    const CURRENT_VIDEO_PLAYER = 'videoPlayer';
    const CURRENT_MEDIA_RPC_AUTHORIZATION = 'mediaRPCAuthorization';
    const OPTIONS_AUTOPLAY = 'autoplay';
    const OPTIONS_CONTROLS = 'controls';
    
    const SET_ELEMENTS = 'elements';    
    const ACTION_SET_MAX_TO_PRESERVE = 'maxToPreserve';    
    const ACTION_TRIGGER_HUMAN_CLICK = 'humanClick';    
    const ACTION_TRIGGER_BOT_OPEN = 'botOpen';    
    const ACTION_TRIGGER_BOT_CLOSE = 'botClose';    
    const ACTION_TRIGGER_BOT_TIME = 'botTime';  
    
    const KIWI_MODEL_DISTANCE_RELATIVE = 'relative';    
    const KIWI_MODEL_DISTANCE_BASE = 'base';    
    const KIWI_MODEL_DISTANCE_COORD_REF_SYS = 'coordRefSys';
    const KIWI_MODEL_DISTANCE_HORIZONTAL = 'horizontal';    
      
    const KIWI_MODEL_POSITION_BASE = 'base';    
    const KIWI_MODEL_POSITION_COEF = 'coef';   
    const KIWI_MODEL_POSITION_REVERT = 'revert';   
    const KIWI_MODEL_POSITION_RELATIVE = 'relative';   
    const KIWI_MODEL_POSITION_ANIMATED = 'animated';   
    const KIWI_MODEL_POSITION_KEY_FRAMES = 'keyFrames';   
    
    const TAM_ENABLED = 'enabled';    
    const TAM_TRIGGER = 'trigger';    
    const TAM_ACTION_MODEL = 'actionModel';    
    const ACTIVATION_ACTION_MODEL_ENRICHMENT = 'enrichment';    
    const ACTIVATION_ACTION_MODEL_STATE = 'state';    
    const PLAY_PAUSE_ACTION_MODEL_STATE = 'state';    
    const SEEK_TO_ACTION_MODEL_TIME = 'time';    
    const URL_ACTION_MODEL_URL = 'url';    
    const URL_ACTION_MODEL_TARGET = 'target';    
    
    const GEOM_TRANSFORM2_NODE_SET_GEOM_TRANSFORM = 'nodeSetGeomTransform';
    const GEOM_SIMPLET2_PIVOT = 'pivot';
    const GEOM_SIMPLET2_ROTATION = 'rotation';
    const GEOM_SIMPLET2_SCALE = 'scale';
    const GEOM_SIMPLET2_TRANS = 'trans';    
    const GEOM_TRANSFORM_2_NODE_SET_GEOM_CHILDREN = 'geomChildren';    

    const OPERAND_1 = 'operand1';       
    const OPERAND_2 = 'operand2';       
    const OPERATOR = 'operator';    

    const ANCHOR2_X_TRANSLATION = 'xTranslation';       
    const ANCHOR2_Y_TRANSLATION = 'yTranslation';     
    const ANCHOR2_BASE = 'base';     

    const SCENE_LAYERS = 'layers';
    const SCENE_ANIMS = 'anims';
    const SCENE_CUE_POINTS = 'cuePoints';

    const LAYER_ENRICHMENTS = 'enrichments';
    
    const PLAYER_WIDTH = 'playerWidth';
    const PLAYER_HEIGHT = 'playerHeight';
    const STREAM_WIDTH = 'streamWidth';
    const STREAM_HEIGHT = 'streamHeight';
    const MEDIA = 'media';
    const MEDIA_ASSETS = 'assets';
    const MEDIA_WIDTH = 'width';
    const MEDIA_HEIGHT = 'height';
    const MEDIA_RATIO = 'ratio';

    const ENRICHMENT_NAME = 'name';
    const ENRICHMENT_ENABLED = 'enabled';
    const ENRICHMENT_ID = 'enrichmentId';
    const ENRICHMENT_USER_ACTIVATION = 'userActivation';
    const ENRICHMENT_BOT_ACTIVATION = 'botActivation';
    const ENRICHMENT_ANCHOR = 'anchor';
    const ENRICHMENT_OFFSET = 'offset';
    const ENRICHMENT_LAYOUT = 'layout';  
    const ENRICHMENT_SIZE = 'size';  
    const ENRICHMENT_ACTIONS = 'actions';
    const ENRICHMENT_ACTIVATION = 'activation';
    const ENRICHMENT_ENRICHMENT_SET_ID = 'enrichmentSet';    
    const ENRICHMENT_CUE_POINT_DATA_ELEMENT_THUMBNAIL_URL = 'enrichmentCuePointDataElementThumbnailURL';    
    const ENRICHMENT_CUE_POINT_DATA_CREATOR = 'enrichmentCuePointDataCreator';    
    
    const CUE_POINT_DATA_ELEMENT_ACTIONS = 'actions';
    const CUE_POINT_DATA_ELEMENT_LABEL = 'label';
    const CUE_POINT_DATA_ELEMENT_THUMBNAIL = 'thumbnail';
    const ENRICHMENT_CPDE_ENRICHMENT = 'enrichment';
    
//    const ENRICHMENT_SET_ID = 'id';
//    const ENRICHMENT_SET_NAME = 'name';
//    const VIDEO_CONTROLLER_ENABLED = 'enabled';

    const TYPE_RANGE_MIN_VALUE = 'minValue';
    const TYPE_RANGE_MAX_VALUE = 'maxValue';
    const TYPE_RANGE_PERIODIC = 'periodic';

    const TYPE_ENUM_ENUM_ID = 'enumId';
    const ENUM_ID_LAYOUT_FIT_MODES = 1;    
    const ENUM_ID_MATH_OPERATIONS = 2;     
    const ENUM_ID_LAYOUT_ALIGN_MODES = 3;         
    const ENUM_ID_TIME_UNIT = 4;        

    const MATH_OPERATIONS = 'operations';
    const MATH_OPERATIONS_ADD = 1;
    const MATH_OPERATIONS_SUB = 2;
    const MATH_OPERATIONS_MUL = 3;
    const MATH_OPERATIONS_DIV = 4;
    const MATH_OPERATIONS_MOD = 5;
    const MATH_OPERATIONS_POW = 6;
    const MATH_OPERATIONS_MIN = 7;
    const MATH_OPERATIONS_MAX = 8;
    
    const TIME_UNIT = 'unit';
    const TIME_UNIT_DEFAUT = 0;
    const TIME_UNIT_MILLISECOND = 1;
    const TIME_UNIT_SECOND = 2;
    const TIME_UNIT_MINUTE = 3;
    const TIME_UNIT_HOUR = 4;
    const TIME_UNIT_DAY = 5;
    const TIME_UNIT_MONTH = 6;
    const TIME_UNIT_YEAR = 7;

    const LAYOUT_ZONE_ID = 'id';
    const LAYOUT_MAIN_CONTENT_ID = 1;
    const LAYOUT_BACKGROUND_ID = 2;
    const LAYOUT_FOREGROUND_ID = 3;
    const LAYOUT_CLIP_AREA = 'desiredClipAreaInLayer';
    const LAYOUT_SIZE = 'desiredSize';
    const LAYOUT_MIN_SIZE = 'desiredMinSize';
    const LAYOUT_MAX_SIZE = 'desiredMaxSize';
    const LAYOUT_POSITION = 'desiredPosition';
    const LAYOUT_RSS = 'desiredRSS';
    const LAYOUT_CLAMP_AREA = 'desiredClampArea';
    const LAYOUT_FRAMER_CONTENT = 'content';
    const LAYOUT_FRAMER_BACKGROUND = 'background';
    const LAYOUT_FRAMER_FOREGROUND = 'foreground';
    const LAYOUT_RATIO = 'desiredRatio';
    const LAYOUT_FIT_MODE = 'fitMode';
    const LAYOUT_FIT_MODE_FIT = 1;
    const LAYOUT_FIT_MODE_FILL = 2;
    const LAYOUT_FIT_MODE_STRETCH = 3;
    const LAYOUT_X_ALIGN_MODE = 'xAlignMode';
    const LAYOUT_Y_ALIGN_MODE = 'yAlignMode';
    const LAYOUT_ALIGN_MODE_LEFT = 1;
    const LAYOUT_ALIGN_MODE_RIGHT = 2;
    const LAYOUT_ALIGN_MODE_MIDDLE = 3;
    const LAYOUT_ALIGN_MODE_TOP = 4;
    const LAYOUT_ALIGN_MODE_BOTTOM = 5;   

    const LAYER_ID = 'layerId';
    const LAYER_ID_HOTSPOT = 1;
    const LAYER_ID_CONTROLLER = 2;
    const LAYER_ID_GADGET = 3;
    const LAYER_ID_POPUP = 4;

    const CORE_DELAYOUT_CLIP_AREA_IN_LAYER = 'desiredClipAreaInLayer';   

    const CONTENT = 'content';   
    const CONTENT_REQUEST_PROPERTIES = 'request_properties';   
    const CONTENT_RELOAD_PAGE_DELAY = 'reloadPageDelay';   
//    const CONTENT_URL = 'content_url';   
    const CONTENT_PROPERTIES = 'properties';    
    const CONTENT_TEMPLATE_URL = 'template_url';       
    const CONTENT_RESOURCE = 'resource';  
    const CONTENT_REF_WIDTH = 'ref_width';  
    const CONTENT_REF_HEIGHT = 'ref_height';  
    const CONTENT_CLICK_THROUGH = 'click_through';      
    const CONTENT_STATIC_DATA = 'staticData';    
    const ENRICHMENT_DEACTIVATION_DELAY = 'deactivationDelay';    
    const CONTENT_RPC_LAST_REQUEST_DATA = 'rpc_last_request_data';  
    
    const RESOURCE_URL = 'resource_url';        
    const RESOURCE_MIME = 'resource_mime';        
    const RESOURCE_ESTIMATED_DATA_SIZE = 'resource_estimated_data_size';         
    
    const INTERVAL_BEGIN = 'begin';    
    const INTERVAL_END = 'end';    
    const INTERVAL_BEGIN_VALUE = 'beginValue';    
    const INTERVAL_END_VALUE = 'endValue';    
    const INTERVAL_BEGIN_UNIT = 'beginUnit';    
    const INTERVAL_END_UNIT = 'endUnit';    
    const MAP_ELEMENTS = 'elements';    
    const CUE_POINT_TIME = 'time';    
    const CUE_POINT_DATA = 'data';    
    const CUE_POINT_TIME_UNIT = 'keyFrameTimeUnit';    
    const NUMBERKFM_KF_VALUE = 'data';    
//
//
    const PROPERTY_SHOW_LABEL = 'showLabel';  
    
    const PROPERTY_LABEL = 'label';   
    const PROPERTY_TOOLTIP = 'tooltip';   
    
}
