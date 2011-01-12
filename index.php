<?php
include 'lib/framework.php';
$app = new Framework();

function authorize($user,$pass) {
	if($user == "blaine" && $pass == "pass"){
		return true;
	}
}

$app->get('/',function($req,$res){
	$res->send("<h1>Index</h1><p>This would show all contacts if you're authenticated properly.<br><a href='/framework/auth/login'>Log in (blaine/pass)</a><br><a href='/framework/contacts'>Contacts</a></p>");
});
$app->get('/auth/login',function($req,$res){
	if($req->authenticate_using_http_basic(authorize)) {
		$res->send("<h1>Auth</h1><p>You were authenticated! User: ".$req->params["auth"]["user"]."<br><a href='/framework/'>Index</a></p>");
	} else {
		$res->send("<h1>Auth</h1><p>You're not authenticated!</p>");
	}
});
$app->get('/contacts',function($req,$res){
	$res->send("<h1>Index</h1><p>This would show all contacts if you're authenticated properly. <a href='/framework/contacts/100'>Get (/contacts/100)</a></p>");
});
$app->get('/contacts/:id',function($req,$res){
	$res->send("<h1>Get</h1><p>Contact ID: ".$req->params["id"]."</p><pre>".print_r($req->params, true)."</pre>");
});
$app->put('/contacts/:id',function($req,$res){
	$res->send("<h1>Update</h1><p>Contact ID: ".$req->params["id"]."</p><pre>".print_r($req->params, true)."</pre>");
});
$app->post('/contacts',function($req,$res){
	$res->send("<h1>New</h1><p>Contact ID: ".$req->params["name"]."</p><pre>".print_r($req->params, true)."</pre>");
});
$app->delete('/contacts/:id',function($req,$res){
	$res->send("<h1>Destroy</h1><p>Contact ID: ".$req->params["id"]."</p><pre>".print_r($req->params, true)."</pre>");
});

$app->run();
?>