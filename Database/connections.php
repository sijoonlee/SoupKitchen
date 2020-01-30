<?php
class Connection
{
    function connect ($servername="localhost",$username="root", $password=""){
        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }  
        return "Connected successfully";
    } 
    
    function disconnect(){
        mysqli_close();
    }
}

 ?>
