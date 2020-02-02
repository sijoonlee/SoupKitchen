<?php 
class ProductController{    
    
    function index(){
        $passMe = "This was passed";        
        require dirname(__DIR__).'/views/home.php';
    }

    function create(){
        echo "You are creating a product";
    }

    function read(){
        echo "You are reading a product";
    }

    function edit(){
        echo "You are editing a product";
    }

    function destroy(){
        echo "You are destroying a product";
    }


}
