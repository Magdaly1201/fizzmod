<?php
include "database_connection.php";

class Database_Operation {

//funcion para conultar los products por id o sin id

    function queryProduct($table,$id= null) {

        $condition = "";
        $sql = "" ;
        $i = "";
        $databaseConnection = new Database_Connection;     
//creacion de la conexion a la db 
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
//retorna el json            
            echo json_encode($products);
        }

//desconecta la bd        
        $databaseConnection->disconnectDatabase($connection);
    }
    function insert($table,$fileds) {
//insercion de los registros a la bd        
        $databaseConnection = new Database_Connection();

//crea la variable de conexion
        $connection = $databaseConnection -> connectDatabase();
        
        $sql = "";
        $sql .= "INSERT INTO " .$table;
        $sql .= " (".implode(", ", array_keys($fileds)).") VALUES ";
        $sql .= "('".implode("', '", array_values($fileds))."') ";

//envia el insert a la bd
        $query = mysqli_query($connection,$sql);

//desconexion de la bd 
        $databaseConnection -> disconnectDatabase($connection);
        if($query) {
            return true;
        }
    //print_r($fileds);
    }

}

$DatabaseOperation = new Database_Operation();
//ejecucion del metodo pasandole concatenada la tabla products y recibiendo el id del request ajax
$DatabaseOperation->queryProduct("products",$_POST["id"]);

?>