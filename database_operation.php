<?php
include "database_connection.php";

class Database_Operation {
    
    function queryProduct($table,$id= null) {

        $condition = "";
        $sql = "" ;
        $i = "";
        $databaseConnection = new Database_Connection;     
        $connection = $databaseConnection -> connectDatabase();
        
        $sql .= "SELECT * FROM ".$table. " WHERE status = 1 " ;
        //echo $sql;
        if ($id !== null) {
            $condition .= "and  id = '" .$id."' " ;
            $sql .= " ".$condition ;
        }
   
        $query =  mysqli_query($connection,$sql);
        //echo $sql;
        print_r(mysql_num_rows($query));
        if ($query->num_rows == "" ){
            echo json_encode(array('message'=>"No hay Registros"));
            //echo json_encode ($message);
        }else {
            while($row = mysqli_fetch_array($query)) {
                $products[$i] = $row;
                $i++;
            }
            echo json_encode($products);
        }

        
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
$DatabaseOperation->queryProduct("products",$_POST["id"]);
//$DatabaseOperation->queryProduct("products",4);

?>