<?php
class Database
{
    private $conn;

    function __construct($servername="",$username="", $password=""){
        if($servername != "")
            $this->connect($servername, $username, $password);
    }

     function connect ($servername="localhost",$username="root", $password=""){
        // Create connection
        $this->conn = new mysqli($servername, $username, $password, "soupkitchen");

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

    function updateProducts($oldID, $dataArray = array()){
        $sql = "UPDATE products
                SET 
                    product_id = "+$dataArray['product_id']+",
                    product_name =" +$dataArray['product_name']+",
                    product_quantity= " + $dataArray['product_quantity']+",
                    product_type = " + $dataArray['product_type']+",                    
                WHERE product_id='$oldID'";
        echo "sql is " + $sql;
           
    }




     function updateQty($productID,$newQty)
    {
        $sql = "UPDATE products
                SET product_quantity=$newQty
                WHERE product_id='$productID'";       
        if ($this->conn->query($sql) === TRUE) {
            echo "Record Updated";
        } else {
            echo "Error updating record: " . $conn->error;
        }        
    }

    /*---------------DELETES----------------------------*/ 
    // DELETE FROM (table name) WHERE (where condition)
    
    function disconnect(){
        mysqli_close($this->conn);
    }
}

 ?>