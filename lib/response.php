<?php
class Response {
	public $body;
	public $headers;
	public $status;
	public $content_type;

	function send($body, $headers=null, $status=null) {
		
		$this->body = $body;
		$this->headers = $headers;
		$this->status = $status;
		
		if(gettype($this->headers) === integer){
			$this->status = $this->headers;
			$this->headers = null;
		}
		
		$this->status = isset($this->status) ? $this->status : 200;
		
		switch (gettype($this->body)) {
			case string:
				$this->headers['Content-Type'] = content_type("html");
			break;
			case object:
				$this->headers['Content-Type'] = content_type("json");
			break;
		}
		
		$this->set_headers();
		echo $this->body;
	}
	function redirect($location="/") {
		header("Cache-Control: no-cache");
		header("Location: ".$location, TRUE, 401);
	}
	function set_headers() {
		if($this->headers){
			foreach($this->headers as $key => $val) {
				header("$key: $val");
			}	
		}
	}
}
?>