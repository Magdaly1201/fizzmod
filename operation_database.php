<?php
include "database_connection.php";

class Database_Operation {
    
    function queryProduct($table,$id= null) {

        $databaseConnection = new Database_Connection;     
        $connection = $databaseConnection -> connectDatabase();
        
        $sql .= "SELECT * FROM ".$table. " ".$condition ;
        
        if ($id !== null) {
            $condition .= "WHERE id = '" .$id."' " ;
            $sql .= " ".$condition ;
        }
   
        $query =  mysqli_query($connection,$sql);

        while($row = mysqli_fetch_array($query)) {
            $products[$i] = $row;
            $i++;
        }
        
        echo json_encode($products);

        $databaseConnection->disconnectDatabase($connection);
    }

}

$DatabaseOperation = new Database_Operation();
$DatabaseOperation->queryProduct("products");


?>