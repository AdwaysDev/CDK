<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Content;

interface EnvironmentInterface
{
	public function getContext();
	public function getMetaData($which = null);
	public function setMetaData($metadata);
	public function getLanguage();
	public function setLanguage($language);
}
