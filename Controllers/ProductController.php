<?php 
class ProductController{    
    
    static function index(){
        return <<<HTML
        <h1>Products</h1>
        <form action="SoupKitchen/account" method="post">
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
        $dataArray = [
            [
              "id"   => "VP001",
              "type" => "vegetable",
              "name" => "Potato",
              "qty" => "10"
            ],
            [
              "id"   => "VP002",
              "type" => "vegetable",
              "name" => "Potato Small",
              "qty" => "12"
            ],
            [
              "id"   => "VP003",
              "type" => "vegetable",
              "name" => "Potato Large",
              "qty" => "14"
            ]
          ];
          $dataArray = json_encode($dataArray);
          return include_once(dirname(__DIR__)."/views/inventory.php");       
    }

    static function edit(){
        return <<<HTML
        <h1>Edit Product</h1>       
HTML;
    }

    static function destroy(){
        return <<<HTML
        <h1>Destroy Product</h1>        
HTML;
    }


}
