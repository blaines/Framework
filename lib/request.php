<?php
class Request {
	
	public $headers;
	public $method;
	public $path;
	public $params;
	
	function __construct() {
		$this->headers = getallheaders();
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->path = $_SERVER['REQUEST_URI'];
		$this->params = $_REQUEST;
		$this->params['auth']['user'] = $_SERVER["PHP_AUTH_USER"];
		$this->params['auth']['pass'] = $_SERVER["PHP_AUTH_PW"];
		$this->path = str_ireplace(Framework::$framework_path,"",$this->path);
	}
	
	function authenticate_using_http_basic($func) {
		if($func($this->params["auth"]["user"],$this->params["auth"]["pass"])) {
			return true;
		} else {
			header('WWW-Authenticate: Basic realm="Login"');
		    header('HTTP/1.0 401 Unauthorized');
			return false;
		}
	}
	
}
?>