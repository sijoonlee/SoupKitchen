<?php
include __DIR__.'/Controllers/AccountController.php';
include __DIR__.'/Controllers/ProductController.php';

$request = $_SERVER['REQUEST_URI'];

//edit this to replace your full path.
$req = str_replace("/SoupKitchen", "", $request);
$urlReq = explode('/',$request);
/* REQUIRES THE .htaccess file */
/* MAKE SURE YOUR VIEW IS IN THE VIEW FOLDER */
/* To enclude a route add the route you would like to the case statements */
/*  Example. to unclude a contact us route. 
     case '/contact-us':
        require __DIR__ . '/views/contact_us.php';
        break;
*/
switch ("/".$urlReq[2]) {
    case '/' :             
        echo "HOME PAGE";
        break;    
    
    //used for all account requests
    case '/account' :             
        $accountController = new AccountController();
        if($urlReq[3] == "")
            $accountController->index();
        elseif($urlReq[3] == "log-out")
            $accountController->logout();
        break;    
   
    //used for all product requests
    case '/products' :
        $productController = new ProductController();
        if($urlReq[3] == "")
            $productController->index();
        elseif($urlReq[3] == "create")
            $productController->create();
        elseif($urlReq[3] == "read")
            $productController->read();
        elseif($urlReq[3] == "edit")
            $productController->edit();
        elseif($urlReq[3] == "destroy")
            $productController->destroy();
        break;    
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}