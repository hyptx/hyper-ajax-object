#Hyper Ajax Object

<div id="content-left">
        <p>The HyperAjaxObject Class is written in PHP and designed to make loading dynamic ajax content a snap. Don't worry if you are not familiar with Javascript, the class takes care of all of that client side code for you. Just copy and paste a few simple PHP method calls and you will have taken your first step into the world of the dynamic web. 2.0 I think they call it. ~ System created by <a href="http://adamjnowak.com" target="_blank">Adam J Nowak</a></p>
        
        <p><strong>Getting Started:</strong><br>
        Take a look at the <a href="#code-ref">Code Reference</a> so you can load the class and familiarize youself with the constructor. Then try out example 3 on the right, it is the most basic example. This implementation allows you the most options. You can create this HAO object and point many different triggers there, allowing you to load many different pages into the same div.</p>
    <p><strong>Url Passthru:</strong><br>
        If you pass the 'div_id' and  'ajax_path' arguments to the constructor, you will create a link between the target div and said file.  This binding allows you all sorts of extras. First off you can pass a query string to the browser that will trigger the page to load the ajax content of your choice, immediately, in the div you assign. For example, if we create an HAO object with a div id of 'my-div', and assign a file path, when the class detects the string 'my-div' in the address bar it will send the rest of the query to the ajax file specified in the 'ajax_path'. </p>
    <p>This is called Url Passthru, and I know that thru is spelled through. Passthru can be turned off by adding url_passthru=false to the constructor method. This feature allows you to load ajax content in the same manner with javascript dynamically and on page load via the url in the address bar.</p>
    <p>
        So if your HAO call loads <em>http://mysite.com/ajax-file.php?page=1&amp;var2=no</em>, to show your content page, then you can use this syntax to display that page via the browser address bar like this:  <em>http://mysite.com/ajax-file.php?my-div=1&amp;page=1&amp;var2=no</em> - The my-div part is the key, this is the div id name you passed with the constructor and the target div id.  The value is irrelevant, HAO just checks to see if the div id name you are using is in the query.</p>
    <p><strong>Page Memory:</strong><br>
     This extra can be turned off by passing false for 'page_memory' in the constructor. Page memory allows you return users to the same ajax content they were looking at when they click back or navigate to  another page. This is set for the whole browsing session. This is great for paginated ajax content, as a place saver. Make sure to call the set_hyp_query() method from the dynamically loaded ajax file to activate this feature. Just pass the $_GET value as the query. </p>
    <p><strong>Ghosts:</strong><br>
    Working in the world of ajax communication is scarry, it is easy to get lost and forget yourself. To use this class to its full potential you should create a "Ghost" HAO class on the dynamically loaded PHP file. Typically you only need to pass it the div id because the main options have already been set on the static page. </p>
    <p>The advantage to this is that after the original static page load all of the dynamic content is served from the file that you load dynamically. Phew! So if you want to include links that control your ajax content within one of these ajax files, you need to have that ghost copy of the HAO object handy to create the links. Pagination systems are a perfect example of this.    </p>
    <p><strong>The Query:</strong><br>
        Part of the ajax magic is the ability to send data in the form of a query string with the request, just add you query string to the end of the url you provide in the HAO trigger functions.</p>
    <p>HAO has a hyp_query system in place that allows you to store this query in a session. By calling the set_hyp_query($query) method you effectively store the query for future use. Typicall you will pass the $_GET superglobal as the $query.</p>
    <p>One catch is that you need to make sure to call the set_hyp_query method from a dynamically loaded file or the page memory will only work for one reload. This is because of the life span of the $_GET superglobal. </p>
    <p>You must set a query in order to utilize the page memory feature.  Page memory simply remembers which ajax file/page was being viewed when you click back or go to another page.  When you return to the parent page you will see the ajax content that was there when you left.</p>
    <p><strong>Events and Data:</strong><br>
        HAO has its own event system to prevent any cross browser difficulties. When an ajax file is loaded the event is fired and contains all of the data related to the load.  Just create an event listener and an event handler function. When the data is sucessfully loaded you can manipulate it however you want from the event handler function. Data is accessed using dot syntax <a href="#events">see below</a>.</p>
        <p><strong>Polyton Design Pattern:</strong><br>
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
        <pre class="code-snippet">&lt;?php $ajax_object-&gt;drop_target() ?&gt;</pre>
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
            </li><li><strong>get_form_data()</strong> ~ Returns submitted ajax form data</li>
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
        	<li><strong>Listener:</strong><br>hypEvent.addListener(hypAjaxLoader,'ajax_loaded',handlerFcn);</li>
            <li><strong>Handler:</strong><br>function handlerFcn(evt){ alert(evt.target); }</li>
        </ul>
        <strong>Event Object:</strong><br>
        Load event data is send to the event handler, access data using dot syntax
        <ul>
        	<li><strong>evt.json</strong> - Same as hypResponseJSON</li>
            <li><strong>evt.target</strong> - Same as hypCurrentTarget</li>
            <li><strong>evt.text</strong> - Same as hypResponseText</li>
            <li><strong>evt.type</strong> - Type, if refresh or onload</li>
            <li><strong>evt.url</strong> - Same as hypCurrentUrl</li>
            <li><strong>evt.xml</strong> - Same as hypResponseXML</li>
        </ul>
       
    </div>
