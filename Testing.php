<?php 


/* -----------------------------Example Of How to connect to the database.-------------------------------*/
//Include the file containing the connection class
require "Database\Database.php";
//Create an instance of the class
$Database = new Database();
//call the connect function 
echo $Database->connect("localhost:3306","root", "");
//closes the connection.

//$db->selectColsFromWhere($cols={"*"}, "products","");

$DataBase->delete(1,"Products",$where=$id."= 1");
$Database->disconnect();
    
?>