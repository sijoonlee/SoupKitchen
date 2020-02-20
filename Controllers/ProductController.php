<?php 
require dirname(__DIR__)."/Database/Database.php";
class ProductController{

#################### CONSTANT #######################
    static $address = "localhost:3306";
    static $account = "root";
    static $password = "";
    static $tableProducts = "Products";
#####################################################

    static function index(){
        return <<<HTML
        <h1>Products</h1>
        <form action="/account" method="post">
          <input type="text" name="name" id="">
          <button type="submit">Submit</button>
        </form>
HTML;
    }

    static function create($data){
        $db = new Database(self::$address,self::$account, self::$password);      
        $dataArray = $db->insertNewProduct(self::$tableProducts, $data);          
        $db->disconnect();
        return json_encode($dataArray);
    }

    static function read(){
        $db = new Database(self::$address,self::$account, self::$password);      
        $dataArray = $db->selectAllFromTable(self::$tableProducts);          
        $db->disconnect();
        return json_encode($dataArray);
        //return include_once(dirname(__DIR__)."/Views/inventory.php");       
    }

    static function updateAnProduct($oldId, $dataArray){       
        $db = new Database(self::$address,self::$account, self::$password);
        $result = $db->updateProducts($oldId,$dataArray);
        $db->disconnect();
        return json_encode($result);
    }

    // No longer used from Frontend
    // static function updateQty($product){
    //     $db = new Database("localhost:3306","root", "mysql");      
    //     return $product;
    // }

    static function findAProductById($id){
        $db = new Database(self::$address,self::$account, self::$password);
        $result = $db->findAProductById(self::$tableProducts, $id);
        $db->disconnect();
        return json_encode($result);
    }

    static function deleteAnProduct($id){
        $db = new Database(self::$address,self::$account, self::$password);
        $result = $db->deleteAnProductById(self::$tableProducts, $id);
        $db->disconnect();
        return json_encode($result);
    }


}
