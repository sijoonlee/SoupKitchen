<?php 


/* -----------------------------Example Of How to connect to the database.-------------------------------*/
//Include the file containing the connection class
require "Database\Connections.php";
//Create an instance of the class
$conn = new Connection();
//call the connect function 
echo $conn->connect("localhost","root", "pass");
//closes the connection.
$conn->disconnect();



    
?>