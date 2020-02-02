<?php

include_once 'Routes/Request.php';
include_once 'Routes/Router.php';
$router = new Router(new Request);

$router->get('/', function() {
  return <<<HTML
  <h1>Hello world</h1>
HTML;
});

$router->get('/products', function($request) {
  return <<<HTML
  <h1>Products</h1>
HTML;
});

$router->post('/account', function($request) {

  return json_encode($request->getBody());
});