<?php

$redirect = $_SERVER['REQUEST_URI']; // You can also use $_SERVER['REDIRECT_URL'];


switch ($redirect) {

    case '/'  :

    case ''   :

        require __DIR__ . '/pages/home.php';

        break;


    case '/contact' :

        require __DIR__ . '/pages/contact.php';

        break;

    default:

        require __DIR__ . '/pages/404.php';

        break;

}

