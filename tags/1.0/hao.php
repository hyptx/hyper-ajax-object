<?php
/*
HypAjaxObject
Built using a Polyton Design Pattern
By Adam J Nowak ~ http://hyperspatial.com
 
An Ajax loader for PHP programmers.  This class allows you to harness the power of Javascript's XMLHttpRequest capability, without having to write a single line of Javascript code.
*/

session_start(); //Session: Be sure to load this class before headers sent to browser

class HypAjaxObject{
	private static $instance,$version,$div_id,$ajax_path,$drop,$url_passthru,$page_memory,$auto_clear,$dynamic,$hao_url,$target_array = array();
	private $_version,$_div_id,$_ajax_path,$_hyp_query,$_hyp_query_string;
	
	//Private Constructor
	private function __construct(){
		$this->_version = self::$version;
		$this->_div_id = self::$div_id;
		$this->_ajax_path = self::$ajax_path;
		$this->check_post_data();
		if(self::$drop) $this->drop_target();
	}
	//Public Static Constructor
    public static function create($args = ''){
		$defaults = array(
			'div_id' => false,
			'ajax_path' => false,
			'drop' => false,
			'url_passthru' => true,
			'page_memory' => true,
			'auto_clear' => true,
			'dynamic' => false
		);
		$r = self::hyp_parse_args($args,$defaults);
		extract($r);
		foreach($r as $key => $value){ self::${$key} = $value; } //Save Vars
		
		//Store Hao file url - Js loaded from this path so keep hao.js and hao.php in the same directory
		self::$hao_url = 'http://' . $_SERVER['SERVER_NAME'] . str_replace($_SERVER['DOCUMENT_ROOT'],'',dirname(__FILE__)) . '/';
		
		//Instance Version
		if(!isset(self::$instance)){
			self::$version = 1;
			if(!self::$div_id) self::$div_id = 'hao-' . self::$version;
			self::print_static_javascript();
		}
		else{
			self::$version += 1;
			if(!self::$div_id) self::$div_id = 'hao-' . self::$version;
			self::print_instance_javascript();
		}
		array_push(self::$target_array,self::$div_id);
		self::$instance = new HypAjaxObject();
        return self::$instance;
    }	
	
	/* ~~~~~~~~~~ Static Class Methods ~~~~~~~~~~~ */
	
	//Print Static Javascript - 1st instance only
	private static function print_static_javascript(){
		if(self::$dynamic){
			self::print_instance_javascript();
			return;
		}
		?>
		<script type="text/javascript" src="<?php echo self::$hao_url ?>js/json.min.js"></script>
		<script type="text/javascript" src="<?php echo self::$hao_url ?>js/events.min.js"></script>
		<script type="text/javascript" src="<?php echo self::$hao_url ?>js/hao.js"></script>
		<?php
        //Auto Clear
		if(!self::$auto_clear) self::hyp_wrap_in_script("hypDisableAutoClear();");
		self::print_instance_javascript();
	}
	
	//Print Instance Javascript
	private static function print_instance_javascript(){
		$div_id = self::$div_id;
		if(self::$ajax_path){
			$query_ready_path = self::$ajax_path . '?';
			$url = $query_ready_path . $_SERVER['QUERY_STRING'];
			if(isset($_SESSION['hyp_query_session'][$div_id])) $query_string = http_build_query($_SESSION['hyp_query_session'][$div_id]);
			//Display page from Url Passthru
			if(isset($_GET[$div_id]) && self::$url_passthru) self::hyp_wrap_in_script("hypAjaxLoad('$div_id','$url','onload');");
			//Display page from session stored hyp_query
			elseif(isset($query_string) && self::$page_memory) self::hyp_wrap_in_script("hypAjaxLoad('$div_id','" . $query_ready_path . $query_string . "','onload');");
		}
	}
	
	/* ~~~~~~~~~~ Private Class Methods ~~~~~~~~~~ */

	private function check_form_reset(){
		$div_id = $this->_div_id;
		$form_name = $_POST['hyp_ajax_data'];
		if(isset($_POST['reset'])){
			unset($_SESSION['hyp_ajax'][$form_name]);
		}
	}	
	private function check_post_data(){
		if(isset($_POST['hyp_ajax_data'])){
			$form_name = $_POST['hyp_ajax_data'];
			if($_POST == $_SESSION['hyp_ajax'][$form_name]['post']) return;
			$_SESSION['hyp_ajax'][$form_name]['post'] = $_POST;
			$_SESSION['hyp_ajax'][$form_name]['get'] = $_GET;
		}
		if(isset($_POST['hyp_ajax_url'])) echo '<script type="text/javascript">' . "hypAjaxLoad('$this->_div_id','" . $_POST['hyp_ajax_url'] . "');</script>";
		$this->check_form_reset();
	}	
	private function hyp_parse_args($args,$defaults = ''){
    	if(is_object($args)) $r = get_object_vars($args);
    	elseif(is_array($args)) $r =& $args;
       	else self::hyp_parse_str($args,$r);
        if(is_array($defaults)) return array_merge($defaults,$r);
        return $r;
    }	
	private function hyp_parse_str($string, &$array) {
    	parse_str($string,$array);
		if(get_magic_quotes_gpc()) $array = stripslashes_deep($array);
     	return $array;
  	}
	private function hyp_wrap_in_script($string){
    	echo '<script type="text/javascript">';
		echo $string;
		echo '</script>';
  	}	
	
	/* ~~~~~~~~~~ Public Methods ~~~~~~~~~~ */
	
	public function drop_target(){ echo '<div id="' . $this->_div_id . '" class="hyp-ajax-object"></div>'; }
	public function event_load($url){ echo "hypAjaxLoad('$this->_div_id','$url');"; }
	public function instant_load($url){ echo '<script type="text/javascript">' . "hypAjaxLoad('$this->_div_id','$url')</script>"; }
	public function link_clear(){ echo "javascript:hypClearDiv('$this->_div_id');"; }
	public function event_clear(){ echo "hypClearDiv('$this->_div_id');"; }
	public function link_load($url){ echo "javascript:hypAjaxLoad('$this->_div_id','$url');"; }
	public function timed_clear($clear_time){ $this->hyp_wrap_in_script("hypTimedClear('$this->_div_id','$clear_time');"); }
	public function timed_refresh($refresh_file,$refresh_time){ $this->hyp_wrap_in_script("setInterval(\"hypAjaxLoad('$this->_div_id','$refresh_file','refresh')\",$refresh_time);");	}
	
	/* ~~~~~~~~~~ Public Methods - Accessors ~~~~~~~~~~ */
	
	public function set_hyp_query($query){
		if(!$query) return;
		$div_id = $this->_div_id;
		$hyp_query = new HypDataClass();
		foreach($query as $key => $value){ $hyp_query->$key = $value; }
		$_SESSION['hyp_query_session'][$div_id] = $query;
		$this->_hyp_query = $hyp_query;
		$this->_hyp_query_string = http_build_query($hyp_query);
		return $hyp_query;
	}
	public function get_ajax_path(){ return $this->_ajax_path; }
	public function get_form_data(){ return $_SESSION['hyp_ajax'][$_POST['hyp_ajax_data']]; }	
	public function get_hyp_query(){ return $this->_hyp_query; }
	public function get_hyp_query_string(){	return $this->_hyp_query_string; }
	public static function get_target_div_array(){ return self::$target_array; }
	public function get_version(){ return $this->_version; }
}
/*  END HypAjaxObject Class*/

//Generic storage object
class HypDataClass
{
    public function get_hyp_data(){
        return $this;
    }
}
?>