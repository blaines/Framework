<?php
include "request.php";
include "response.php";
include "mime_types.php";

class Framework {
	
	public $routes = array();
	public static $framework_path = "/framework";
	
	// protected $_req;
	
	public function __construct()
    {
    }
	
	function get($path,$func) {
		$this->route("GET",$path,$func);
	}
	function put($path,$func) {
		$this->route("PUT",$path,$func);
	}
	function post($path,$func) {
		$this->route("POST",$path,$func);
	}
	function delete($path,$func) {
		$this->route("DELETE",$path,$func);
	}
	function head($path,$func) {
		// a better way? For now I'm skipping it
		// We need to render the GET without a body (just the SAME headers as get)
		// $this->route("HEAD",$path,$func);
	}
	
	function route($method,$path,$func) {
		$this->routes[$method][$path] = $func;
	}
		
	function run() {
		
		$req = new Request();
		$res = new Response();
		
		if(array_key_exists($req->method,$this->routes)) {
			foreach($this->routes[$req->method] as $route => $func) {
				preg_match_all('/:([a-zA-Z0-9]+)/',$route,$param_names);
				$param_names = $param_names[1];
				$regex_route = preg_replace('/(:[a-zA-Z0-9]+)/',"([a-zA-Z0-9]+)",$route);
				if(preg_match("~^$regex_route$~",$req->path,$param_values)){
					array_shift($param_values);
					if($param_values) {
						foreach($param_values as $key => $value) {
							$params[$param_names[$key]] = $value;
						}
					}
					if($params){
						$req->params = array_merge($req->params,$params);
					}
					$func($req,$res);
				}
			}
		}
		
	}
}
?>