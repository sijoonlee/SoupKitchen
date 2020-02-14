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

    /***************************************************
        Format for $newRecord array for insertNewRecord
        $newRecord = array(
            "product_id" => product ID
            "product_name" => product name
            "product_quantity" => product qty
            "product_type" => type of product
            "product_image" => image file stored as BLOB
        );
    ***************************************************/
    function insertNewRecord($tableName, $newRecord)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO $tableName VALUES
            (?, ?, ?, ?, ?);
        ");
        $stmt->bind_param("ssisb", 
            $newRecord["product_id"], 
            $newRecord["product_name"], 
            $newRecord["product_quantity"],
            $newRecord["product_type"],
            $newRecord["product_image"]
        );
        try
        {
            if (!$stmt->execute())
            {
                throw new Exception("Failed to insert new record", 69);
            }
        }
        catch (Exception $ex)
        {
            $errMsg = "Error #" . $ex->getCode() . ": " . $ex->getMessage();
        }
        $errMsg = "New record inserted successfully";
        return $errMsg;
    }

    /*---------------UPDATES----------------------------*/ 
    // UPDATE (table name) SET (column Name) = (new value) WHERE (where condition)

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

    //Data order: ID, TYPE, NAME, QUANTITY
    function updateProducts($oldID , $data = array()){
        $sql = "UPDATE products
                SET 
                product_id= '". $data["product_id"].
               "', product_type= '" .$data["product_type"].
               "', product_name= '" . $data["product_name"].
               "', product_quantity= " . $data["product_quantity"].
               ", product_image= '" . $data["product_image"].
               "' WHERE product_id='$oldID'";
        var_dump($sql);

            if ($this->conn->query($sql) === TRUE) {
                return 1;
            } else {
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