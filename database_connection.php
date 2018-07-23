<?php
class Database_Connection {
    public $connection;

    function connectDatabase() {

        $host = "remote.fizzmod.com";
        $user = "EmDElaBVQMc3NVnx";
        $password = "iUPGdNdw8NQBpqXcI9Mx1";
        $db = "db_EmDElaBVQMc3NVnx";
       
        try{
            $connection = mysqli_connect( $host, $user, $password, $db );            
            return $connection;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    
    }
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
