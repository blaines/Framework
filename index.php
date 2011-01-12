<?php
include 'lib/framework.php';
$app = new Framework();

function authorize($user,$pass) {
	if($user == "blaine" && $pass == "pass"){
		return true;
	}
}

$app->get('/',function($req,$res){
	if($req->authenticate_using_http_basic(authorize)) {
		$res->send("<h1>Index</h1><p>This would show all contacts if you're authenticated properly.</p>");
	} else {
		$res->send("Not Authenticated");
	}
});
$app->get('/contact/:id',function($req,$res){
	$res->send("<h1>Get</h1><p>Contact ID: ".$req->params["id"]."</p><pre>".print_r($req->params, true)."</pre>");
});
$app->put('/contact/:id',function($req,$res){
	$res->send("<h1>Update</h1><p>Contact ID: ".$req->params["id"]."</p><pre>".print_r($req->params, true)."</pre>");
});
$app->post('/contact',function($req,$res){
	$res->send("<h1>New</h1><p>Contact ID: ".$req->params["name"]."</p><pre>".print_r($req->params, true)."</pre>");
});
$app->delete('/contact/:id',function($req,$res){
	$res->send("<h1>Destroy</h1><p>Contact ID: ".$req->params["id"]."</p><pre>".print_r($req->params, true)."</pre>");
});

$app->run();
?>