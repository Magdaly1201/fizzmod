<?php
class Conection_Database {
    public $conection;

    function connectDatabase() {

        $host = "remote.fizzmod.com";
        $user = "EmDElaBVQMc3NVnx";
        $password = "iUPGdNdw8NQBpqXcI9Mx1";
        $db = "db_EmDElaBVQMc3NVnx";
       
        try{
            $conection = mysqli_connect( $host, $user, $password, $db );            
            return $conection;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    
    }
    function disconnectDatabase($conection) {

        try{
            $close = mysqli_close($conection);
            $conection = null;
            return $close;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

$conection_database = new Conection_database();

?>
