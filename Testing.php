<?php 


/* -----------------------------Example Of How to connect to the database-------------------------------*/
//Include the file containing the connection class
require "Database\Database.php";
//Create an instance of the class
$db = new Database();
//call the connect function 
echo $db->connect("localhost:3306","root", "mysql");
//closes the connection.
$db->disconnect();



    
?>