<h1>Overview</h1>
<p>
This SDK provides everything to make a content configurable inside the Adways studio. 
</p>

<img src="../../assets/img/cdk-php-studio.png"></img>
<br><br>
<p>
A content can be set up with variables like number, string, time, color, select list…
</p>
</li>
<img src="../../assets/img/cdk-php-overview.png"></img>

<h1>Step by step example</h1>

<h4>CDK call:</h4>

<p>Using composer, require in your composer.json</p>

<pre class="prettyprint">
"repositories": [{
	"type":"git",
	"url":"https://github.com/AdwaysDev/CDK.git"
}],
"require": {
	"adways-cdk": "dev-master"
}
</pre>

<p>Direct download zip file: <a href='https://github.com/AdwaysDev/CDK/archive/master.zip'>https://github.com/AdwaysDev/CDK/archive/master.zip</a></p> 



<h4>Initialising CDK in your content:</h4>

<p>
Pre-requisite: Before using CDK you must call composer's autoload.<br>
If you are using directly zip file you must call each PHP class files you use.
</p>

<pre class="prettyprint">
// Composer autoload call
require_once( __DIR__ .'/../vendor/autoload.php');

use Adways\Content\Template;

// Must declare the new Template with your api_key, api_secret.
$template = new Template(array(
	'key' => 'adways_key',
	'secret' => 'adways_secret'
));
</pre>

<p>
With this code the Content Developpment Kit is initialized.<br>
<br>
Be carefull, if you give bad key and secret you will be not able to use the entire CDK.
</p>

<h4>You need to get clicks and roll-over within your content:</h4>

<p>
Enabling this option require to use the AdwaysLib.js library to instanciate communication between your content and Adways Interactive Video library.<br>
You can find the documentation about this library <a href='https://developers.adways.com/content/'>HERE</a>. eg: to fire the action relative to your content if it's a hotspot or deactivate your content for a popup.
</p>
<pre class="prettyprint">
// Content will get clicks and roll-over.
$template->setRequireUserInput(true);
</pre>

<p>
Default: This parameter is false. There an overlay over your enrichment which will catch users actions and click. <br>
This overlay allow Adways library to nativelly works with hotspots and fire linked actions (such as: open an enrichment, play/pause/seek on video, open links...) 
</p>

<h4>Use properties to create variables within Adways Studio.</h4>

<p>
This exemple will create a dynamic "String" property allowing user studio to configure his content.<br>
<br>
You must declare the following property in you class use calls.
</p>

<pre class="prettyprint">
use Adways\Property\String;
use Adways\Property\Representations;
</pre>

<p>
In you content, after the "new Template(...)" call.<br>
Following code create the property.
</p>
<pre class="prettyprint">
$content_text = new String('content_text', 'Content text', '', Representations::_DEFAULT, 'Your default text');
</pre>

<p>
This code declare the property but this property must be "linked" to the "template". If not, this property is not shown within Adways Studio.<br>
To add this property within the studio, you must retrieve the "tab" where you want to display it.<br>
<br>
You must declare Categories in you class use calls.
</p>
<pre class="prettyprint">
use Adways\Property\Categories;    
</pre>

<p>Then you can link your property to any Category tab. Following exemple will display it in "Content" tab.</p>
<pre class="prettyprint">
// Retrieve the Content tab pannel.
$contentTab = $template->getNodeSet(Categories::CONTENT);
// Adding a property to this tab
$contentTab->addProperty($content_text);
</pre>

<p>
Now this property will appear within the Content tab in Adways Studio when the user will configure his content.<br>
<br>
<br>
To use this property later in your content page you must call:
</p>
<pre class="prettyprint">
// Retrieve the value given by Adways studio user
// If no value has been set, getValue will return the given defaultValue
$content_text->getValue();
</pre>


<h4>Full exemple of use.</h4>

<p>
Following code will create an enrichment, which simply create a String property, allow user to define it in Adways Studio and display this string in the content.<br>
Be carefull: This exemple is not responsive and will appear differently on runtime, regarding the rendered video size.
</p>

<pre class="prettyprint">
&lt;?php
	// Composer autoload call
	require_once( __DIR__ .'/../vendor/autoload.php');

	use Adways\Content\Template;
	use Adways\Property\String;
	use Adways\Property\Representations;
	use Adways\Property\Categories;
		
	// Must declare the new Template with your api_key, api_secret.
	$template = new Template(array(
		'key' => 'adways_key',
		'secret' => 'adways_secret'
	));

	$content_text = new String('content_text', 'Content text', '', Representations::_DEFAULT, 'Your default text');

	// Retrieve the Content tab pannel.
	$contentTab = $template->getNodeSet(Categories::CONTENT);
	// Adding a property to this tab
	$contentTab->addProperty($content_text);
?>
</pre>
<pre class="prettyprint">
&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;fr&quot; dir=&quot;ltr&quot;&gt;
	&lt;head&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;h3&gt;&lt;?php echo $content_text-&gt;getValue(); ?&gt;&lt;/h3&gt;
	&lt;/body&gt;
&lt;/html&gt;
</pre>