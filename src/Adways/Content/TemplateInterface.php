<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */

namespace Adways\Content;

interface TemplateInterface
{
    public function getVersion();
    public function getJSLibPath();
    public function getEnvironment();
	public function getReloadDelay();
	public function setReloadDelay( $int );
	public function getNodeSet( $category );
	public function getRefWidth();
	public function getRefHeight();
	public function setRefWidth( $int );
	public function setRefHeight( $int );
	public function getRequireUserInput();
	public function setRequireUserInput( $boolean );
}
