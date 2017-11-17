<?php
namespace Adways\Property;
require_once( __DIR__ . '/../../../vendor/autoload.php');
use Adways\Constant\IO\ContentTemplateRPC;
use Adways\Property\Number;
use Adways\Property\Characters;
use Adways\Property\Boolean;
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

class MultiInstance extends NodeSet implements MultiInstanceInterface
{		
	protected $kind = '';
	protected $numberOfEntry = 0;
	 
	public function __construct($key, $label = '', $tooltip = '', $kind = '', $defaultValues = array()) {
        parent::__construct($key, $label, $tooltip, Representations::_DEFAULT, '', true, false, false);	
        $this->type = ContentTemplateRPC::PROPERTY_TYPE_MULTI_INSTANCE;
		$this->kind = $kind;        
        $this->numberOfEntry = new Number('number_of_value_' . $key, 'NumberOfEntry', '', Representations::_DEFAULT, count($defaultValues));
        $this->addProperty($this->numberOfEntry);
        for ($i = 0; $i < $this->numberOfEntry->getValue(); $i++) {
            switch ($this->kind) {
                case ContentTemplateRPC::PROPERTY_TYPE_STRING:
                    $entry = new Characters('value_' . $key . '_' .$i, 'Entry ' . $i, '', Representations::_DEFAULT);
                    break;
                case ContentTemplateRPC::PROPERTY_TYPE_NUMBER:
                    $entry = new Number('value_' . $key . '_' .$i, 'Entry ' . $i, '', Representations::_DEFAULT);
                    break;
//                case ContentTemplateRPC::PROPERTY_TYPE_MEDIA:
//                    break;
                case ContentTemplateRPC::PROPERTY_TYPE_BOOLEAN:
                    $entry = new Boolean('value_' . $key . '_' .$i, 'Entry ' . $i, '', Representations::_DEFAULT);
                    break;
//                case ContentTemplateRPC::PROPERTY_TYPE_TIME:
//                    break;
//                case ContentTemplateRPC::PROPERTY_TYPE_RANGE:
//                    break;
//                case ContentTemplateRPC::PROPERTY_TYPE_CONTENT_SIMPLE_SELECTION:
//                    break;
                default:
                    break;
            }
            $this->addProperty($entry);
        }
	}

    public function getValue() {
        return $this->propertiesToArray();
    }
	
	public function getInstanceKind() {	
		return $this->kind; 
	}   
	
	public function getNumberOfEntry() {	
		return $this->numberOfEntry; 
	}     
}  