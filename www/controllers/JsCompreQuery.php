<?php
define("IS_AJAX", true);
chdir(dirname(__FILE__));
chdir("../");
require_once (PROP_PATH. "env_common.php");
require_once (MODEL_PATH. "LogBase.php");

class JSCompreQuery {
	var $scriptStr = "";
	var $method = array("get" => "load");
	// var $status = true;
	var $errors = array();
	var $result = false;
	// var $pregPattern = array("/\/\/(.*?)\n/s", "/\/\*(.*?)\*\//s");
	// var $pregPattern = array("/\t/", "/\/\/(.*)/", "/\/\*(.*?)\*\//s", "/(\r\n)|(\n)|(\r)/");
	var $pregPattern = array("/\t/", "/\/\/(.*)/", "/\/\*(.*?)\*\//s", "/(\r\n)|(\n)|(\r)/");
	var $postParams = "";

	public function __construct() {
		$this -> log = new logBase(get_class($this));
	}

	function receive() {
		if (!(isset($_REQUEST['user']) && isset($_REQUEST['method']))) {
			$this -> setError("query missing");
			return;
		}
		// var_dump($_REQUEST);
		$method = $_REQUEST['method'];
		if (!array_key_exists($method, $this -> method)) {
			$this -> setError("method not exists");
			return;
		}
		$func = $this -> method[$method];
		// var_dump(get_class($this));
		if (!method_exists(get_class($this), $func)) {
			$this -> setError("class does not has method");
			return;
		}
		$this -> $func();
		//メソッド実行
	}



	function response() {
		header('Content-type: application/x-javascript');
		echo $this -> scriptStr;
		echo $this -> postParams;
		// $log -> append($_POST);
		$this -> log -> write();
	}

	function setError($message) {
		$this -> errors[] = $message;
		$this -> log -> append($message);
	}

	function isParam($paramName) {
		if (isset($_REQUEST[$paramName]) && $_REQUEST[$paramName]) {
			return true;
		}
		return false;
	}

	function load() {
		$this -> loadCommon();
		if (isset($_REQUEST['scene'])) {
			$this -> loadScene($_REQUEST['scene']);
		}
		$this -> loadCurrent();
	}

	function loadCurrent() {
		$dir = JS_BASE_DIR . "current/";
		$files = glob($dir . "*.js");
		// var_dump($files);
		foreach ($files as $filename) {
			$this -> appendScript($this -> trimSourceComment($filename));
		}

		return $this -> scriptStr;
	}

	function loadScene($name) {
		$filePath = JS_BASE_DIR . "scene/" . $name . ".js";
		if (file_exists($filePath)) {
			$this -> appendScript($this -> trimSourceComment($filePath));
		}

		return $this -> scriptStr;
	}

	function loadCommon() {
		$modules = $this -> modules();
		$modsdir = array();
		foreach ($modules as $name) {
			$modsdir[$name] = JS_BASE_DIR . $name . "/";
		}

		foreach ($modsdir as $key => $dir) {
			$files = glob($dir . "*.js");
			// var_dump($files);
			foreach ($files as $index => $filename) {
				$this -> appendScript($this -> trimSourceComment($filename));
				// if($index == 3){break;}
			}
		}
		return $this -> scriptStr;
	}

	function trimSourceComment($sources) {
		// echo trim(preg_replace($this->pregPattern, "", file_get_contents($sources)));
		return trim(preg_replace($this -> pregPattern, "", file_get_contents($sources)));
	}

	function appendScript($str) {
		$this -> scriptStr .= $str . "\n";
	}

	function modules() {
		// $module = array("core", "http", "menuclass", "utility", );
		$module = array("defines", "core", "http", "menuclass", "utility", "background");

		return $module;
	}

}

$obj = new JsCompreQuery();
$obj->receive();
$obj->response();

exit ;
?>