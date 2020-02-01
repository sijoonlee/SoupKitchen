<?php

    require 'vendor/autoload.php';

    function processInput($uri){        
        $uri = implode('/', 
            array_slice(
                explode('/', $_SERVER['REQUEST_URI']), 3));         

            return $uri;    
    }

    function processOutput($response){
        echo json_encode($response);    
    }

    function getPDOInstance(){
        return new PDO('mysql:host=localhost;dbname=booksapi;charset=utf8', 'root', '');
    }

    $router = new Phroute\RouteCollector(new Phroute\RouteParser);

    $router->get('hello', function(){ 
        return 'Hello, PHRoute!';   
    });

    $dispatcher = new Phroute\Dispatcher($router);

    try {

        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], processInput($_SERVER['REQUEST_URI']));

    } catch (Phroute\Exception\HttpRouteNotFoundException $e) {

        var_dump($e);      
        die();

    } catch (Phroute\Exception\HttpMethodNotAllowedException $e) {

        var_dump($e);       
        die();

    }

    processOutput($response);


    $router->get('test', function(){      
        echo "HELLO FROM TEST";
    });