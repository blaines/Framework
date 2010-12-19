<?php
include 'lib/framework.php';
$app = new Framework();

$app->get('/contact',function($req,$res){
	$res->send("<h1>Index</h1><p>This would show all contacts</p>");
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