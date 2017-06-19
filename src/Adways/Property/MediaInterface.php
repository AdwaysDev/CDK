<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface MediaInterface extends PropertyInterface
{
	// public function setDefaultValue( $string );
     
    public function getMime();
    public function getXKey();
    public function getPath();
    public function getThumbnails();
    public function getAssets();
    public function getName();
    public function getId();
}
