<?php

namespace Adways\Constant\IO;


abstract class ContentTemplateRPC {
    const CONTENT_SRC = 'content_src';   
    const CONTENT_TEMPLATE_URL = 'content_url';   
    
    const DATA = 'data'; 
    const PROJECT_MEDIA_ID = 'project_media_id'; 
    const PROPERTY_ID = 'propertyId';
    const ID = 'id';
    const AUTOMATIC_REQUEST = 'automaticRequest';    
    
    const CONTENT_REQUEST_PROPERTIES = 'request_properties';   
    const CONTENT_RELOAD_PAGE_DELAY = 'reloadPageDelay';  
    
    const CONTENT = 'content';   
    const CONTENT_PROPERTIES = 'properties';    
    const REF_WIDTH = 'ref_width';    
    const REF_HEIGHT = 'ref_height';    
    const CONTENT_CLICK_THROUGH = 'requireUserInput';    
    const ENRICHMENT_DEACTIVATION_DELAY = 'deactivationDelay';    
    const CONTENT_STATIC_DATA = 'staticData';    
    const CONTENT_CONTEXT = 'adw_context';  
    const CONTENT_CONTEXT_UNDEFINED = 'undefined';    
    const CONTENT_CONTEXT_KIWI = 'kiwi';    
    const CONTENT_CONTEXT_INTERACTIVE = 'interactive';    
    const CONTENT_CONTEXT_THUMBNAIL = 'thumbnail';    
    const CONTENT_CONTEXT_KIWI_PLAYER = 'kiwiPlayer';     
    const CONTENT_CONTEXT_STUDIO = 'studio';     
    const CONTENT_CONTEXT_HTML = 'html';
    const CONTENT_CONTEXT_PUBLISH = 'publish'; 
    const CONTENT_CONTEXT_PACKAGE = 'package';   
    const CONTENT_CONTEXT_VPAID_LINEAR = 'vpaid_linear';   
    const CONTENT_CONTEXT_VPAID_NON_LINEAR = 'vpaid_non_linear';   
    
    const PROPERTY_KEY = 'key'; 
    const PROPERTY_CATEGORY = 'category';  
    const PROPERTY_VALUE = 'value';  
    const PROPERTY_MIN_VALUE = 'minValue';  
    const PROPERTY_MAX_VALUE = 'maxValue';  
    const PROPERTY_STEP_VALUE = 'stepValue';  
    const PROPERTY_SHOW_LABEL = 'showLabel';  
    const PROPERTY_OPTIONS = 'options';  
    const PROPERTY_NUMBER_OPTIONS_PERCENT_DISPLAY = 'percentDisplay';  
    const PROPERTY_NUMBER_OPTIONS_FORCE_INTEGER = 'forceInteger';  
    const PROPERTY_NUMBER_OPTIONS_FORCE_INTEGER_NONE = 'none';  
    const PROPERTY_NUMBER_OPTIONS_FORCE_INTEGER_FLOOR = 'floor';  
    const PROPERTY_NUMBER_OPTIONS_FORCE_INTEGER_CEIL = 'ceil';  
    const PROPERTY_NUMBER_OPTIONS_FORCE_INTEGER_ROUND = 'round';  
    const PROPERTY_NUMBER_OPTIONS_DECIMAL_NUMBER = 'decimalNumber';  
    const PROPERTY_TYPE = 'type';   
    const PROPERTY_RELOAD_PAGE_ON_CHANGE = 'reloadPageOnChange';   
    const PROPERTY_RELOAD_PROPERTIES_ON_CHANGE = 'reloadPropertiesOnChange';   
    const PROPERTY_TYPE_NODE_SET = 'node_set';   
    const PROPERTY_TYPE_DEFAULT_NODE_SET = 'default_node_set';   
    const PROPERTY_NODE_SET_COLLAPSED = 'collapsed';   
    const PROPERTY_TYPE_STRING = 'string';   
    const PROPERTY_TYPE_ENRICHMENT_SELECTION = 'enrichment-selection';   
    const PROPERTY_TYPE_BOOLEAN = 'boolean';   
    const PROPERTY_TYPE_NUMBER = 'number';    
    const PROPERTY_TYPE_TIME= 'time';    
    const PROPERTY_TYPE_RANGE = 'range';    
    const PROPERTY_TYPE_CONTENT_SIMPLE_SELECTION = 'content_simple_selection';    
    const PROPERTY_CONTENT_SIMPLE_SELECTION_SELECTABLES = 'selectables';    
    const PROPERTY_DEFAULT_VALUE = 'defaultValue';   
    const PROPERTY_LABEL = 'label';   
    const PROPERTY_TOOLTIP = 'tooltip';   
    const PROPERTY_PARENT = 'parentProperty';   
    const PROPERTY_REPRESENTATION = 'representation';   
    const PROPERTY_REPRESENTATION_SIMPLELINE = 'simpleLine';   
    const PROPERTY_REPRESENTATION_MULTILINE = 'multiLine';   
    const PROPERTY_REPRESENTATION_CHECKBOX = 'checkbox';   
    const PROPERTY_REPRESENTATION_BUTTON_2_STATES = 'button2States';   
    const PROPERTY_REPRESENTATION_DEFAULT = 'default';   
    const PROPERTY_REPRESENTATION_COLOR = 'color';   
    const PROPERTY_REPRESENTATION_RICH_TEXT = 'rich_text';   
    const PROPERTY_REPRESENTATION_SLIDER_H = 'slider_h';   
    const PROPERTY_REPRESENTATION_SLIDER_V = 'slider_v';   
    const PROPERTY_REPRESENTATION_URL= 'url';   
    const PROPERTY_REPRESENTATION_HIDDEN= 'hidden';   
    
    const CONTENT_LOCK_WIDTH = 'lockWidth';    
    const CONTENT_LOCK_HEIGHT = 'lockHeight';    
    const CONTENT_DESIRED_WIDTH = 'desiredWidth'; 
    const CONTENT_DESIRED_HEIGHT = 'desiredHeight';    
    const ENRICHMENT = 'enrichment';    
    const LOCK_BASE_POSITION = 'lockBasePosition';    
    const LOCK_HORIZONTAL_POSITION = 'lockHorizontalPosition';    
    const LOCK_VERTICAL_POSITION = 'lockVerticalPosition';    
    const DESIRED_BASE_POSITION = 'desiredBasePosition';    
    const DESIRED_HORIZONTAL_POSITION = 'desiredHorizontalPosition';    
    const DESIRED_VERTICAL_POSITION = 'desiredVerticalPosition';    
    const BASE_RENDERER = 'renderer';    
    const BASE_PLAYER = 'player';    
    const BASE_STREAM = 'stream';    
    
    const DESIRED_PIVOT = 'desiredPivot';   
    const LOCK_PIVOT = 'lockPivot';    
    const PIVOT_PRESET_TOP_LEFT = 'topLeft';    
    const PIVOT_PRESET_TOP_CENTER = 'topCenter';    
    const PIVOT_PRESET_TOP_RIGHT = 'topRight';    
    const PIVOT_PRESET_MIDDLE_LEFT = 'middleLeft';    
    const PIVOT_PRESET_MIDDLE_CENTER = 'middleCenter';    
    const PIVOT_PRESET_MIDDLE_RIGHT = 'middleRight';    
    const PIVOT_PRESET_BOTTOM_LEFT = 'bottomLeft';    
    const PIVOT_PRESET_BOTTOM_CENTER = 'bottomCenter';    
    const PIVOT_PRESET_BOTTOM_RIGHT = 'bottomRight';    
    
    const DISTANCE_RELATIVE = 'relative';    
    const DISTANCE_BASE = 'base'; 
    
    const POSITION_COEF = 'coef'; 
    const POSITION_RELATIVE = 'relative'; 
    const POSITION_REVERT = 'revert'; 
    
    const PROJECT = 'project'; 
    const CURRENT = 'current'; 
    const MEDIA = 'media'; 
    const SECRET = 'secret'; 
    const ADWAYS_CONTENT_JS_LIB = 'adwaysContentJSLib'; 
    const ADWAYS_SERVICES_PATH = 'adwaysServicesPath'; 
    const META_DATA = 'metadata'; 
    const USER = 'user'; 
    const LANGUAGE = 'language'; 
    
    const REQUEST_TYPE = 'adw_request_type';     
    const REQUEST_TYPE_UNDEFINED = 'undefined'; 
    const REQUEST_TYPE_PROPERTIES = 'prop'; 
    const REQUEST_TYPE_CLIENT = 'client'; 
    const REQUEST_TYPE_PAGE = 'page'; 
    
    const REFRESH_INTERVAL = 'refreshInterval'; 
    const CALLBACK_STRING = 'callbackString'; 
    const EXECUTE_CALLBACK = 'executeCallback'; 
}