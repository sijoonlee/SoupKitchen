<?php

$request = $_SERVER['REQUEST_URI'];
$req = str_replace("/soupkitchen", "", $request);

/* REQUIRES THE .htaccess file */
/* MAKE SURE YOUR VIEW IS IN THE VIEW FOLDER */
/* To enclude a route add the route you would like to the case statements */
/*  Example. to unclude a contact us route. 
     case '/contact-us':
        require __DIR__ . '/views/contact_us.php';
        break;
*/
switch ($req) {
    case '/' :
        require __DIR__ . '/views/home.php';
        break;    
    case '/about' :
        require __DIR__ . '/views/about.php';        
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}