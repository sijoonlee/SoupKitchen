<?php 
/* -----------------------------Example Of How to connect to the database.-------------------------------*/
//Include the file containing the connection class
require "Database\Database.php";
//Create an instance of the class\


$Database = new Database();
echo $Database->connect("localhost:3306","root", "");
echo "<br>";
echo $Database->updateTable("SP001","Products", "Product_quantity","10");
echo $Database->delete("SP001",'product_id','Products');
$a = array("a","b","c");
echo $Database->insertValues('Products',$a);

$Database->disconnect();

?>