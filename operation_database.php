<?php
include "conection_database.php";

class Operation_database {
    
    function queryProduct($table,$id= null) {

        $conectionDatabase = new Conection_Database;     
        $conection = $conectionDatabase -> connectDatabase();
        
        $sql .= "SELECT * FROM ".$table. " ".$condition ;
        
        if ($id !== null) {
            $condition .= "WHERE id = '" .$id."' " ;
            $sql .= " ".$condition ;
        }
/*
        $statement = $conection->prepare($sql);
        $value = $statement->execute();

        if($value) {
            while($result = $statement->fetch(PDO::FETCH_ASSOC)) {
                $products["data"][] = $result;
            }
        }
*/
        
        $query =  mysqli_query($conection,$sql);

        while($row = mysqli_fetch_array($query)) {
            $products[$i] = $row;
            $i++;
        }
        
        echo json_encode($products);

        $conectionDatabase->disconnectDatabase($conection);
    }

}

$operation_database = new Operation_database();
$operation_database->queryProduct("products");


?>