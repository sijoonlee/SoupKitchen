<?php
class connection
{

function connect ($servername="localhost",$username="root", $password=""){
// $servername = "localhost";
// $username = "letsmakeit";
// $password = "0505";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
} 
function disconnect(){
    mysqli_close();
}
}

 ?>