<?php include('hao.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HyperAjaxObject Example</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="SHORTCUT ICON" href="http://hao.hyperspatial.com/favicon.ico"/>

<style type="text/css">
body{font-size:13px; color:#222; font-family:Verdana, Geneva, sans-serif; background-image:url(header-bg.gif); background-repeat:repeat-x; background-color:#D7D8CF; background-position:0 -24px; width:1318px; line-height:16px;}
h1{font-size:22px; color:#D7D8CF;}
h2{font-size:19px; padding-bottom:5px; color:#000; margin-top:20px;border-bottom:1px solid #000;}
h3{font-size:16px;}
a{color:#005EBB;}
a:hover{color:#007EFD;}
#header{padding-left:16px;}
ul{padding:0;margin:10px 0 10px 26px;}
#content-left ul li{font-family:"Courier New", Courier, monospace;padding-bottom:3px; color:#333; word-wrap:normal;}
#content-left ul li strong{ color:#000;}
#content-left h4{margin-top:10px; margin-bottom:0px;}
pre{font-size:12px;margin-top:2px; margin-bottom:6px; line-height:18px;}
pre.code-snippet{border:1px solid #ccc; text-wrap:normal; overflow-x:auto; padding:8px; margin:16px 0; background-color:#333; color:#FFFF91;}
#content-left .code-snippet{margin-top:4px;}
#content-left{float:left; width:550px; padding:0 16px 40px;}
#content-right{float:left; width:550px; padding:0 0 40px 16px;}
.hyp-ajax-object{border:1px solid #444; background-color:#fff; padding:16px; margin:3px 0 20px;}
hr{margin-top:10px;}
.text-right{text-align:right;}
.notes{	font-size:12px;	color:#2C2C2C;}
p#main-link{position:absolute; top:748px; left:764px; width:530px;}
.content-list{padding:16px 0; font-size:12px;}
.content-list a{text-decoration:none; padding-right:2px;}
#contents-top{position:absolute;top:16px;}
#examples{position:relative;}
</style>
</head>
<body>

<div id="header">
	<h1>The HyperAjaxObject</h1>
    <h3 style="cursor:pointer; color:#FFFF80; margin:4px 0 20px;" onClick="javascript: expandCollapse('div_to_expand');">Open ~ Close HAO Diagram -></h3>
    <p style="width:540px; position:absolute;top:2px; left:330px; font-size:11px; color:#D7D8CF;">Take a moment to review the <span style="cursor:pointer; color:#FFF; text-decoration:underline;" onClick="javascript: expandCollapse('div_to_expand');">HAO diagram</span>. The mind-bending world of ajax is a little less complicated when you put the entire system in perspective.  The HyperAjaxObject allows you to control your dynamic content using PHP and server side scripting. <a style="color:#fff;" href="http://hyperspatial.com" target="_blank">Hyperspatial Design Ltd</a></p>
	<div id="div_to_expand" style="display:none;"><img style="margin-left:-10px;" src="ajax-chart.png" width="1152" height="800" alt="HyperAjaxObject Diagram" /></div>
</div><!-- /#header -->

<div id="content">
    <div id="content-left">
    	<h2>HAO Notes:</h2>
        <p>The <a href="http://hyperspatial.repositoryhosting.com/trac/hyperspatial_hao/browser/tags/1.0" title="Get Class Now" target="_blank">HyperAjaxObject Class</a> is written in PHP and designed to make loading dynamic ajax content a snap. Don't worry if you are not familiar with Javascript, the class takes care of all of that client side code for you. Just copy and paste a few simple PHP method calls and you will have taken your first step into the world of the dynamic web. 2.0 I think they call it. ~ System created by <a href="http://hyperspatial.com/portfolio" target="_blank">Adam J Nowak</a></p>
        
        <p><strong>Getting Started:</strong><br />
        Take a look at the <a href="#code-ref">Code Reference</a> so you can load the class and familiarize youself with the constructor. Then try out example 3 on the right, it is the most basic example. This implementation allows you the most options. You can create this HAO object and point many different triggers there, allowing you to load many different pages into the same div.</p>
    <p><strong>Url Passthru:</strong><br />
        If you pass the 'div_id' and  'ajax_path' arguments to the constructor, you will create a link between the target div and said file.  This binding allows you all sorts of extras. First off you can pass a query string to the browser that will trigger the page to load the ajax content of your choice, immediately, in the div you assign. For example, if we create an HAO object with a div id of 'my-div', and assign a file path, when the class detects the string 'my-div' in the address bar it will send the rest of the query to the ajax file specified in the 'ajax_path'. </p>
    <p>This is called Url Passthru, and I know that thru is spelled through. Passthru can be turned off by adding url_passthru=false to the constructor method. This feature allows you to load ajax content in the same manner with javascript dynamically and on page load via the url in the address bar.</p>
    <p>
        So if your HAO call loads <em>http://mysite.com/ajax-file.php?page=1&amp;var2=no</em>, to show your content page, then you can use this syntax to display that page via the browser address bar like this:  <em>http://mysite.com/ajax-file.php?my-div=1&amp;page=1&amp;var2=no</em> - The my-div part is the key, this is the div id name you passed with the constructor and the target div id.  The value is irrelevant, HAO just checks to see if the div id name you are using is in the query.</p>
    <p><strong>Page Memory:</strong><br />
     This extra can be turned off by passing false for 'page_memory' in the constructor. Page memory allows you return users to the same ajax content they were looking at when they click back or navigate to  another page. This is set for the whole browsing session. This is great for paginated ajax content, as a place saver. Make sure to call the set_hyp_query() method from the dynamically loaded ajax file to activate this feature. Just pass the $_GET value as the query. </p>
    <p><strong>Ghosts:</strong><br />
    Working in the world of ajax communication is scarry, it is easy to get lost and forget yourself. To use this class to its full potential you should create a &quot;Ghost&quot; HAO class on the dynamically loaded PHP file. Typically you only need to pass it the div id because the main options have already been set on the static page. </p>
    <p>The advantage to this is that after the original static page load all of the dynamic content is served from the file that you load dynamically. Phew! So if you want to include links that control your ajax content within one of these ajax files, you need to have that ghost copy of the HAO object handy to create the links. Pagination systems are a perfect example of this.    </p>
    <p><strong>The Query:</strong><br />
        Part of the ajax magic is the ability to send data in the form of a query string with the request, just add you query string to the end of the url you provide in the HAO trigger functions.</p>
    <p>HAO has a hyp_query system in place that allows you to store this query in a session. By calling the set_hyp_query($query) method you effectively store the query for future use. Typicall you will pass the $_GET superglobal as the $query.</p>
    <p>One catch is that you need to make sure to call the set_hyp_query method from a dynamically loaded file or the page memory will only work for one reload. This is because of the life span of the $_GET superglobal. </p>
    <p>You must set a query in order to utilize the page memory feature.  Page memory simply remembers which ajax file/page was being viewed when you click back or go to another page.  When you return to the parent page you will see the ajax content that was there when you left.</p>
    <p><strong>Events and Data:</strong><br />
        HAO has its own event system to prevent any cross browser difficulties. When an ajax file is loaded the event is fired and contains all of the data related to the load.  Just create an event listener and an event handler function. When the data is sucessfully loaded you can manipulate it however you want from the event handler function. Data is accessed using dot syntax <a href="#events">see below</a>.</p>
        <p><strong>Polyton Design Pattern:</strong><br />
        The HAO class itself was created using <a href="http://code.hyperspatial.com/all-code/php-code/polyton-design-pattern/" target="_blank">The Polyton Design Pattern</a>. I created this design pattern out of necessity. I needed a way for php classes to keep track of how many times they have been instantiated, or if they have been instantiated. This was so the first instance of a class could run different methods than all the rest of the new objects.</p>
        <p>The Polyton is similar to the famous <a href="http://en.wikipedia.org/wiki/Singleton_pattern" target="_blank">Singleton Design Pattern</a>, a singleton allows only one instance of itself to be created, period! It accomplishes this by privatizing the constructor method and forcing instantiation with a static method. From this static method the class constructs itself and then stores a static class property that prevents any subsequent instantiations.</p>
        <p>The Polyton/HAO classes act  much the same as a singleton, except instead of preventing another version, it allows for multiple versions and keeps track of them.  Hence the name Polyton. Each new instance of a polyton will get an incremental version number. The class cannot be instantiated via the private constructor like $object = new object(), it can only be created like the sigleton, through the static constructor: <span class="code-snippet">$ajax_object = hypAjaxObject::create($args)</span></p>
        <!-- /#examples -->
        <a name="code-ref"></a>
        <h2>Code Reference</h2>
        <p><strong>Get the HAO class from our repository:</strong> <a href="http://hyperspatial.repositoryhosting.com/trac/hyperspatial_hao/browser/tags/1.0" target="_blank">HAO Files + Examples</a></p>
        <h4>HAO Constructor:</h4>
        <pre class="code-snippet">&lt;?php
include('hao.php'); //HAO starts a session - load before headers
$args = array( //No arguments are required, this example lists class defaults for reference
    'div_id' =&gt; false,
    'ajax_path' =&gt; false,
    'drop' =&gt; false,
    'url_passthru' =&gt; true,
    'page_memory' =&gt; true,
    'auto_clear' =&gt; true, //Global, only works for first instance
    'is_dynamic' =&gt; false //Set this for ghost load, prevents second js print to browser
);
$ajax_object = hypAjaxObject::create($args);
?&gt;
&lt;?php $ajax_object2 = hypAjaxObject::create('div_id=my-div&amp;drop=true') ?&gt;</pre>
        <h4>Example method call:</h4>
        <pre class="code-snippet">&lt;?php $ajax_object->drop_target() ?&gt;</pre>
        <h4>Example Html trigger:</h4>
        <pre class="code-snippet">&lt;a href="&lt;?php $ajax_object-&gt;link_load('ajax-file.php') ?&gt;"&gt;Load&lt;/a&gt;</pre>
        <h2>PHP Public Methods</h2>
        <ul>
            <li><strong>drop_target()</strong> ~ Add target div to DOM</li>
            <li><strong>event_load($url)</strong> ~ Load file - Insert within onclick=""</li>
            <li><strong>event_clear()</strong> ~ Clear target div -  Insert within onclick=""</li>
            <li><strong>instant_load($url)</strong> ~ Load file immediately - prints script tags</li>
            <li><strong>link_clear()</strong> ~ Clear target div - Insert within a href=""</li>
            <li><strong>link_load($url)</strong> ~ Load file - Insert within a href=""</li>
            <li><strong>timed_clear($clear_time)</strong> ~ Clear the contents of a div using a timer</li>
            <li><strong>timed_refresh($refresh_file,$refresh_time)</strong> ~ Load file continually using a timer</li>
        </ul>
        <strong>Accessors:</strong>
        <ul>
            <li><strong>set_hyp_query($query)</strong> ~ Store query object and store session, this is required to use 'Page Memory'</li>
            <li><strong>get_ajax_path()</strong> ~ Returns current ajax path
            <li><strong>get_form_data()</strong> ~ Returns submitted ajax form data</li>
            <li><strong>get_hyp_query()</strong> ~ Returns current query object</li>
            <li><strong>get_hyp_query_string()</strong> ~ Returns current query string</li>
            <li><strong>get_target_div_array()</strong> ~ Returns list of all instantiated object div id's</li>
            <li><strong>get_version()</strong> ~ Returns instance version</li>
        </ul>
        <h2>Javascript</h2>
        <strong>Functionality:</strong>
        <ul>
            <li><strong>hypAjaxLoad(target,url)</strong> ~ Load content - target is the content div id name and url can contain query string</li>
            <li><strong>hypClearDiv(clearTarget)</strong> ~ Clear the contents of a div manually</li>
            <li><strong>hypDisableAutoClear()</strong> ~ Default is on, this turns it off</li>
            <li><strong>hypEnableAutoClear()</strong> ~ Restore auto clear if turned off</li>
            <li><strong>hypTimedClear(timerTarget,clearTime)</strong> ~ Clear the contents of a div using a timer</li>
            <li><strong>print_r($object)</strong> ~ A testing routine to imitate the PHP print_r</li>
        </ul>
        <strong>Global Variables:</strong>
        <ul>
            <li><strong>hypResponseJSON</strong> ~ Response object containing JSON data</li>
            <li><strong>hypCurrentTarget</strong> ~ The id name of the most recent div loaded with content</li>
            <li><strong>hypResponseText</strong> ~ Response object text</li>
            <li><strong>hypCurrentUrl</strong> ~ The last url loaded via ajax</li>
            <li><strong>hypResponseXML</strong> ~ Response object containing XML data</li>
        </ul>
        <strong id="events">Events:</strong>
        <ul>
        	<li><strong>Listener:</strong><br />hypEvent.addListener(hypAjaxLoader,'ajax_loaded',handlerFcn);</li>
            <li><strong>Handler:</strong><br />function handlerFcn(evt){ alert(evt.target); }</li>
        </ul>
        <strong>Event Object:</strong><br />
        Load event data is send to the event handler, access data using dot syntax
        <ul>
        	<li><strong>evt.json</strong> - Same as hypResponseJSON</li>
            <li><strong>evt.target</strong> - Same as hypCurrentTarget</li>
            <li><strong>evt.text</strong> - Same as hypResponseText</li>
            <li><strong>evt.type</strong> - Type, if refresh or onload</li>
            <li><strong>evt.url</strong> - Same as hypCurrentUrl</li>
            <li><strong>evt.xml</strong> - Same as hypResponseXML</li>
        </ul>
       
    </div><!-- /#content-left -->
    <div id="content-right">
    	<div id="examples">
            <h2 style="margin-bottom:60px;">Examples</h2>
            
            <a name="a-page-mem1"></a>
            <h3>Url Passthru & Page Memory Examples</h3>
            Target: page-mem1
            <?php $args = array('div_id' => 'page-mem1','ajax_path' => 'ajax/pm1.php','drop' => true) ?>
            <?php $ajax_object_pm1 = hypAjaxObject::create($args) ?>
            <p>Trigger Link: <a href="<?php $ajax_object_pm1->link_load('ajax/pm1.php') ?>">Load to page-mem1</a></p>
            <p class="text-right">HAO Version: <?php echo $ajax_object_pm1->get_version() ?></p>
            
            <a name="a-page-mem2"></a>
            Target: page-mem2
            <?php $args = array('div_id' => 'page-mem2','ajax_path' => 'ajax/pm2.php','drop' => true) ?>
            <?php $ajax_object_pm2 = hypAjaxObject::create($args) ?>
            <p>Trigger Link: <a href="<?php $ajax_object_pm2->link_load('ajax/pm2.php') ?>">Load to page-mem2</a></p>
                        
            <pre class="code-snippet">&lt;?php $args = array('div_id' =&gt; 'page-mem1','ajax_path' =&gt; 'ajax/pm1.php','drop' =&gt; true) ?&gt;
&lt;?php $ajax_object_pm1 = hypAjaxObject::create($args) ?&gt;
&lt;p&gt;Trigger Link: &lt;a href="&lt;?php $ajax_object_pm1-&gt;link_load('ajax/pm1.php') ?&gt;"&gt;Load to page-mem1&lt;/a&gt;&lt;/p&gt;

&lt;?php $args = array('div_id' =&gt; 'page-mem2','ajax_path' =&gt; 'ajax/pm2.php','drop' =&gt; true) ?&gt;
&lt;?php $ajax_object_pm2 = hypAjaxObject::create($args) ?&gt;
&lt;p&gt;Trigger Link: &lt;a href="&lt;?php $ajax_object_pm2-&gt;link_load('ajax/pm2.php') ?&gt;"&gt;Load to page-mem2&lt;/a&gt;&lt;/p&gt;</pre>
            <p class="notes"><strong>Notes:</strong> Sorry about starting with the most complicated examples, but it was necessary. They were placed above the fold, so you can experiment and easily see  what is happening with these two examples.</p>
            <p>To see how they work, load the page-mem1 div  and copy the url you are presented with into the browser address bar. Try taking out query variables or adding more to the url. The purpose of this exercise is to demonstrate how the query string in the browser bar can control your dynamicly loaded content, pagination wise or otherwise.</p>
            <p>Now try the back, forward and refresh buttons. Or even go to the root at <a href="http://hao.hyperspatial.com">http://hao.hyperspatial.com</a> - You will see that that the page opens the dynamic content that was there when you left it, automatically!</p>
            <p>Now load the page-mem2 div and do the same experiment. You will see that both of these divs are capable of loading content based on the browser query string. Since 'page_memory' is on, both of the divs load the last file automatiacally when the page loads.            </p>
            <p><strong>IMPORTANT:</strong> To activate page memory you need to include/load the HAO class into the dynamically loaded ajax file. If you look at the file loaded by this example you will see the &quot;Ghost&quot; HAO object and the call to the set_hyp_query() method.</p>
            <p class="text-right">HAO Version: <?php echo $ajax_object_pm2->get_version() ?></p>
            <hr />
            
            
            <a name="a-hao-3"></a>
            <h3>Basic Link Load</h3>
            
            Target: hao-3
            <?php $args = array('drop' => true) ?>
            <?php $ajax_object = hypAjaxObject::create($args) ?>
            <p>Trigger Links: <a href="<?php $ajax_object->link_load('ajax/text.php') ?>">Load File1</a> | <a href="<?php $ajax_object->link_load('ajax/time.php') ?>">Load File2</a> | <a href="<?php $ajax_object->link_clear() ?>">Clear Div</a></p>
            <pre class="code-snippet">&lt;?php $args = array('drop' =&gt; true) ?&gt;
&lt;?php $ajax_object = hypAjaxObject::create($args) ?&gt;
&lt;p&gt;Trigger Links: &lt;a href="&lt;?php $ajax_object-&gt;link_load('ajax/text.php') ?&gt;"&gt;Load File1&lt;/a&gt; | &lt;a href="&lt;?php $ajax_object-&gt;link_load('ajax/time.php') ?&gt;"&gt;Load File2&lt;/a&gt; | &lt;a href="&lt;?php $ajax_object-&gt;link_clear() ?&gt;"&gt;Clear Div&lt;/a&gt;&lt;/p&gt;</pre>
            <p class="notes"><strong>Notes:</strong> This ajax object was passed only one argument, 'drop'. The target div is created immediately and assigned a default id based on the verison number (hao-3). Click on the trigger link again to clear the loaded content, or just click the clear div link.</p>
            <p class="notes">This implementation allows you create additional triggers, each to load its own file.</p>
            <p class="text-right">HAO Version: <?php echo $ajax_object->get_version() ?></p>
            <hr />
            
            
            <a name="a-trigger-above"></a>
            <h3>Basic Action Load - Trigger above target</h3>
            <?php $ajax_object_act = hypAjaxObject::create('div_id=trigger-above') ?>
            <p>Action Trigger: <span onClick="<?php $ajax_object_act->event_load('ajax/text.php') ?>" style="cursor:pointer; text-decoration:underline;">Load onclick</span></p>
            Target: trigger-above
            <?php $ajax_object_act->drop_target() ?>
            <pre class="code-snippet">&lt;?php $ajax_object_act = hypAjaxObject::create('div_id=trigger-above') ?&gt;
&lt;p&gt;Action Trigger: &lt;span onClick="&lt;?php $ajax_object_act-&gt;event_load('ajax/text.php') ?&gt;" style="cursor:pointer; text-decoration:underline;"&gt;Load onclick&lt;/span&gt;&lt;/p&gt;
Target: trigger-above
&lt;?php $ajax_object_act-&gt;drop_target() ?&gt;</pre>
            <p class="notes"><strong>Notes:</strong> To put trigger links above the target div, do not set drop to true, instead call 'drop_target' on the object. Make sure to drop the target after the trigger link in the html flow. Notice that this example uses the query string technique to pass arguments to the constructor, and that you can assign a div id when creating the object.</p>
            <p class="text-right">HAO Version: <?php echo $ajax_object_act->get_version() ?></p>
            <hr />
            
            
            <a name="a-json-load"></a>
            <h3>Hidden JSON Load - With Event Listener</h3>
            <?php $ajax_object_json = hypAjaxObject::create('div_id=json-load') ?>
            <p>Trigger Link: <a href="<?php $ajax_object_json->link_load('ajax/json.php') ?>">Load JSON Data</a></p>
            <script type="text/javascript">
            hypEvent.addListener(hypAjaxLoader,'ajax_loaded',jsonLoadedHandler);
            function jsonLoadedHandler(evt){
                if(evt.target == 'json-load') alert('JSON Loaded - Use this event to prompt your \"post load\" routines\n\n' + evt.text);
			}
            </script>
            <pre class="code-snippet">&lt;?php $ajax_object_json = hypAjaxObject::create('div_id=json-load') ?&gt;
&lt;p&gt;Trigger Link: &lt;a href="&lt;?php $ajax_object_json-&gt;link_load('ajax/json.php') ?&gt;"&gt;Load JSON Data&lt;/a&gt;&lt;/p&gt;
&lt;script type="text/javascript"&gt;
hypEvent.addListener(hypAjaxLoader,'ajax_loaded',jsonLoadedHandler);
function jsonLoadedHandler(evt){
if(evt.target == 'json-load') alert('JSON Loaded - Use this event to prompt your \"post load\" routines\n\n' + evt.text);
}
&lt;/script&gt;</pre>
     <p class="notes"><strong>Notes:</strong> This example loads JSON behind the scenes, data can be accessed using dot syntax and the hypResponseJSON object.</p>
            <p class="text-right">HAO Version: <?php echo $ajax_object_json->get_version() ?></p>
            <hr />
            
            
            <a name="a-xml-load"></a>
            <h3>XML Load</h3>
            Target: xml-load
            <?php $ajax_object_xml = hypAjaxObject::create('div_id=xml-load&drop=true') ?>
            <p>Trigger Link: <a href="<?php $ajax_object_xml->link_load('ajax/xml.php') ?>">Load XML</a></p>
            <pre class="code-snippet">&lt;?php $ajax_object_xml = hypAjaxObject::create('div_id=xml-load&amp;drop=true') ?&gt;
&lt;p&gt;Trigger Link: &lt;a href="&lt;?php $ajax_object_xml-&gt;link_load('ajax/xml.php') ?&gt;"&gt;Load XML&lt;/a&gt;&lt;/p&gt;</pre>
    <p class="notes"><strong>Notes:</strong> This example loads XML, data can be accessed using getElementsByTagName and the hypResponseXML object.</p>
            <p class="text-right">HAO Version: <?php echo $ajax_object_xml->get_version() ?></p>
            <hr />
            
            
            <a name="a-timed-clear"></a>
            <h3>Timed Clear</h3>
            Target: timed-clear
            <?php $ajax_object_clear = hypAjaxObject::create('div_id=timed-clear&drop=true') ?>
            <p>Trigger Link: <a href="<?php $ajax_object_clear->link_load('ajax/text.php') ?>">Load to Target Div</a></p>
            <?php $ajax_object_clear->timed_clear(5000) ?>
            <pre class="code-snippet">&lt;?php $ajax_object_clear = hypAjaxObject::create('div_id=timed-clear&amp;drop=true') ?&gt;
&lt;p&gt;Trigger Link: &lt;a href="&lt;?php $ajax_object_clear-&gt;link_load('ajax/text.php') ?&gt;"&gt;Load to Target Div&lt;/a&gt;&lt;/p&gt;
&lt;?php $ajax_object_clear-&gt;timed_clear(5000) ?&gt;</pre>
            <p class="notes"><strong>Notes:</strong> Call the timed_clear(5000) method to clear your div after a certain time in milliseconds.</p>
            <p class="text-right">HAO Version: <?php echo $ajax_object_clear->get_version() ?></p>
            <hr />
            
            
            <a name="a-auto-refresh"></a>
            <h3>Auto Refresh Div</h3>
            Target: auto-refresh
            <?php $ajax_object_clock = hypAjaxObject::create('div_id=auto-refresh&drop=true') ?>
            <?php $ajax_object_clock->instant_load('ajax/time.php') ?>
            <?php $ajax_object_clock->timed_refresh('ajax/time.php',5000) ?>
            <pre class="code-snippet">&lt;?php $ajax_object_clock = hypAjaxObject::create('div_id=auto-refresh&amp;drop=true') ?&gt;
&lt;?php $ajax_object_clock-&gt;instant_load('ajax/time.php') ?&gt;
&lt;?php $ajax_object_clock-&gt;timed_refresh('ajax/time.php',5000) ?&gt;</pre>
            <p class="notes"><strong>Notes:</strong> Call the timed_refresh(5000) method to refresh your div after a certain time in milliseconds. I don't recomend using this for one second loads, this clock is set to refresh every ten seconds. Notice the 'instant_load' method that loads the content immediately.</p>
            <p class="text-right">HAO Version: <?php echo $ajax_object_clock->get_version() ?></p>
            <hr />
            
            
            
            
            <div id="contents-top" class="content-list">
                <?php
                foreach(hypAjaxObject::get_target_div_array() as $div){?>
                <a href="#a-<?php echo $div ?>"><?php echo $div ?></a>|
                    <?php
                }
                ?>
            </div>
            <div id="contents-bottom" class="content-list">
                <?php
                foreach(hypAjaxObject::get_target_div_array() as $div){?>
                <a href="#a-<?php echo $div ?>"><?php echo $div ?></a>|
                    <?php
                }
                ?>
            </div>
    	</div>
    </div><!-- /#content-right -->
    <p style="margin:24px 0 16px 16px; clear:left;"><strong>Get the HAO class from our repository:</strong> <a href="http://hyperspatial.repositoryhosting.com/trac/hyperspatial_hao/browser/tags/1.0" target="_blank">HAO Files + Examples</a><span style="margin-left:322px;">&copy;<?php echo date('Y') ?> Hyperspatial Design Ltd</span></p>
</div><!-- /#content -->

<script language="javascript">
function expandCollapse() {
    for (var i=0; i<expandCollapse.arguments.length; i++) {
        var element = document.getElementById(expandCollapse.arguments[i]);
        element.style.display = (element.style.display == "none") ? "block" : "none";
    }
}
</script>

</body>
</html>