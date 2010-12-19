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
		$this->path = str_ireplace(Framework::$framework_path,"",$this->path);
	}
}
?>