<?php 
require "Database\Connections.php";

    $conn = new Connection();
    echo $conn->connect("localhost","root", "pass");







    
?>