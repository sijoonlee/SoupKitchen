<?php 
/* -----------------------------Example Of How to connect to the database.-------------------------------*/
//Include the file containing the connection class
require "Database\Database.php";
//Create an instance of the class
$db = new Database();
//call the connect function 
echo $db->connect("localhost:3306","root", "mysql");
//closes the connection.



$getCols = array("*");
//echo $db->selectColsFromWhere($getCols, "products","id = 1");

$testArray = array(
    "product_id" => "SP001",
    "product_type" => "Plant",  
    "product_name" => "NewName",
    "product_quantity" => "111",
    "product_image" => "askhgdajgdjaksdgagdkhagskdajsdadgkahgdahshdahsgddahsdhas"
      
);
echo $db->updateProducts("SP001",$testArray);
$db->disconnect();

    
?>