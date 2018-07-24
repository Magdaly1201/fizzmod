<?php
class Database_Connection {
    public $connection;

    function connectDatabase() {

//creacion de las variables de conexion        
        $host = "remote.fizzmod.com";
        $user = "EmDElaBVQMc3NVnx";
        $password = "iUPGdNdw8NQBpqXcI9Mx1";
        $db = "db_EmDElaBVQMc3NVnx";
       
        try{
//crear la variable de conexion
            $connection = mysqli_connect( $host, $user, $password, $db );            
            return $connection;
        }catch(Exception $e){
            echo $e->getMessage();
        }    
    }
    
//funcion para cerrar la conexion a la bd    
    function disconnectDatabase($connection) {

        try{
            $close = mysqli_close($connection);
            $connection = null;
            return $close;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

$databaseConnection = new Database_Connection();

?>
