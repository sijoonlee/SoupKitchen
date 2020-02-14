<?php 
require dirname(__DIR__)."/Database/Database.php";
class ProductController{  
    static function index(){
        return <<<HTML
        <h1>Products</h1>
        <form action="/account" method="post">
          <input type="text" name="name" id="">
          <button type="submit">Submit</button>
        </form>
HTML;
    }

    static function create(){
        return <<<HTML
        <h1>Create Product</h1>        
HTML;
    }

    static function read(){
        $db = new Database("localhost:3306","root", "");      
        $dataArray = $db->selectAllFromTable("Products");          
        $db->disconnect();
        return $dataArray;
        //return include_once(dirname(__DIR__)."/Views/inventory.php");       
    }

    static function edit(){       
        return <<<HTML
        <h1>Edit Product</h1>       
HTML;
    }

    static function updateQty($product){
        $db = new Database("localhost:3306","root", "");      
             
       
        return $product;
    }


    static function destroy(){
        return <<<HTML
        <h1>Destroy Product</h1>        
HTML;
    }


}
