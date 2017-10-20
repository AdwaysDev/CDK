<?php
/**
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Property;

interface MediaElementInterface
{
    public function getLocation();
    public function getMime();
    public function getWidth();
    public function getHeight();
    public function getRatio();
    public function getSize();
    public function getDuration();
    public function getFramerate();
    public function getBitrate();
    public function getId();    
    public function getMinBitrate();    
    public function getMaxBitrate();
}
