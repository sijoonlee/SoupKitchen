<?php
class Database
{
    private $conn;

    function __construct($servername="",$username="", $password=""){
        if($servername != "")
            $this->connect($servername, $username, $password);
    }

     function connect ($servername="localhost",$username="root", $password="mysql"){
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, "SoupKitchen");

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }  
        return "Connected successfully";
    } 

     function selectAllFromTable($tableName){        
        $returnData = array();
        $sql = "SELECT * FROM $tableName";
        $result = $this->conn->query($sql);
        $rows = array();
        if ($result->num_rows > 0) {            
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        } 
        return json_encode($rows);
    }

    /*-----------FUNCTIONS WE NEED----------------------*/     
    /*---------------SELECTS----------------------------*/ 
    // SELECT * from (table name) WHERE (where condition)
    // SELECT (column name) FROM (table name)
    // SELECT (column name) FROM (table name) WHERE (where condition)

     function selectColsFromWhere($cols = array(), $tableName, $where)
    {
        for($index = 0; $index<$cols.length();$index++){
            $columns+=$cols[$index] . ", ";
        }
        $sql = "SELECT $columns FROM $tableName where $where";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                return $row["field"];
            }
        } else {
            echo "0 results";
        }
    }
    
    /*---------------INSERTS----------------------------*/ 
    // INSERT INTO (table name) VALUES (values array)

    /*---------------UPDATES----------------------------*/ 
    // UPDATE (table name) SET (column Name) = (new value) WHERE (where condition)

     function updateQty($productID,$newQty)
    {
        $sql = "UPDATE Products
                SET product_quantity=$newQty
                WHERE product_id='$productID'";       
        if ($this->conn->query($sql) === TRUE) {
            echo "Record Updated";
        } else {
            echo "Error updating record: " . $conn->error;
        }        
    }

    //Data order: ID, TYPE, NAME, QUANTITY
    function updateProducts($oldID , $data = array()){
        $sql = "UPDATE Products
                SET " .
                (isset($data["product_id"]) ? "product_id= '" . $data["product_id"] . "'," : "") .
                (isset($data["product_type"]) ? "product_type= '" . $data["product_type"] . "'," : "") .
                (isset($data["product_name"]) ? "product_name= '" . $data["product_name"] . "'," : "") .
                (isset($data["product_quantity"]) ? "product_quantity= '" . $data["product_quantity"] . "'," : "") .
                (isset($data["product_image"]) ? "product_image= '" . $data["product_image"] . "'," : "");
        $sql = rtrim($sql, ","); // delete unnecesarry comma at the end
        $sql = $sql . " WHERE product_id='$oldID'";
       
            if ($this->conn->query($sql) === TRUE) {
                return $data;
            } else {
                // var_dump($sql);
                // var_dump($this->conn);
                return 0;
            }  

    }


    /*---------------DELETES----------------------------*/ 
    // DELETE FROM (table name) WHERE (where condition)
    
    function disconnect(){
        mysqli_close($this->conn);
    }
}

 ?>