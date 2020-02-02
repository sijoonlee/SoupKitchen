<?php 
class AccountController{    
    
    function index(){
        $passMe = "This was passed";        
        require dirname(__DIR__).'/views/home.php';
    }

    function logout(){
        echo "You are logging out";
    }
}





