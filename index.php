<?php
include_once 'Controllers/ProductController.php';
include_once 'Routes/Request.php';
include_once 'Routes/Router.php';
$router = new Router(new Request);


// $router->get('/', function() {
//   return <<<HTML
//   <h1>Hello world</h1>
//   <form action="SoupKitchen/account" method="post">
//     <input type="text" name="name" id="">
//     <button type="submit">Submit</button>
//   </form>
// HTML;
// });

$router->get('/', function() {
  require __DIR__ . '/Views/inventory.php';
});

$router->get('/products',function(){       
    return ProductController::read();
}); 
$router->get('/products/create',function(){       
    return ProductController::create();
}); 
$router->get('/products/edit',function(){       
    return ProductController::edit();
}); 
$router->get('/products/delete',function(){       
    return ProductController::destroy();
}); 



$router->post('/products/create', function($request) {
  //return $request->getBody();
  return json_encode($request->getBody());
});

