<?php
include "database_connection.php";

$id="";
class Database_Operation {

//funcion para conultar los products por id o sin id
    function consultProduct($table,$id= null) {

        $condition = "";
        $sql = "" ;
        $i = "";
        $databaseConnection = new Database_Connection;     
        $connection = $databaseConnection -> connectDatabase();

//creacion de la consulta         
        $sql .= "SELECT * FROM ".$table. " WHERE status = 1 " ;

//si se envia un id se concatena a la consulta una condicion dicho id
        if ($id !== null) {
            $condition .= "and  id = '" .$id."' " ;
            $sql .= " ".$condition ;
        }
   
        $query =  mysqli_query($connection,$sql);
//si no trae registro envia un mensaje
        if ($query->num_rows == "" ){
            echo json_encode(array('message'=>"No hay Registros"));
        }else {
//si trae registros crea el array
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

//crea la variable de conexion
        $connection = $databaseConnection -> connectDatabase();
        
        $sql = "";
        $sql .= "INSERT INTO " .$table;
        $sql .= " (".implode(", ", array_keys($fileds)).") VALUES ";
        $sql .= "('".implode("', '", array_values($fileds))."') ";

//envia el insert a la bd
        $query = mysqli_query($connection,$sql);

        $databaseConnection -> disconnectDatabase($connection);
        if($query) {
            return true;
        }
    }

    function deleteProduct($table,$id) {

        $databaseConnection = new Database_Connection();
      
        $connection = $databaseConnection -> connectDatabase();
        
        $sql = "";
        $sql .= "UPDATE " .$table. " SET status = '-1' WHERE id = ".$id ;
        
        //echo $sql;
        $query = mysqli_query($connection,$sql);

        $databaseConnection -> disconnectDatabase($connection);
        if($query) {
            return true;
         }
    }
}
    $DatabaseOperation = new Database_Operation();
    if(isset($_POST['id_delete'])) {
        $DatabaseOperation->deleteProduct("products",$_POST['id_delete']);
        
    }else {
        $id = (isset($_POST['id_consult'])) ? $_POST['id_consult'] : null ;
//ejecucion del metodo pasandole concatenada la tabla products y reciiendo el id del request ajax
        $DatabaseOperation->consultProduct("products",$id);
    }
     
?>