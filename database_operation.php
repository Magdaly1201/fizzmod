<?php
include "database_connection.php";

class Database_Operation {
    
    function queryProduct($table,$id= null) {

        $condition = "";
        $sql = "" ;
        $i = "";
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
    function insert($table,$fileds) {
        
        $databaseConnection = new Database_Connection();
        $connection = $databaseConnection -> connectDatabase();
        
        $sql = "";
        $sql .= "INSERT INTO " .$table;
        $sql .= " (".implode(", ", array_keys($fileds)).") VALUES ";
        $sql .= "('".implode("', '", array_values($fileds))."') ";

        $query = mysqli_query($connection,$sql);
        
        $databaseConnection -> disconnectDatabase($connection);
        if($query) {
            return true;
        }
    //print_r($fileds);
    }

}

$DatabaseOperation = new Database_Operation();
$DatabaseOperation->queryProduct("products");


?>