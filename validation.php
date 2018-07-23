<?php   
include "database_connection.php";

class Validation{
    public $numeric = null;
    
    public function noEmpty($productId) {
        if($productId == "") {
            print "el campo esta vacio";
        }else {
            return true;
        }
    }
    public function numeric($productId) {
        if(!is_numeric($productId)) {
            print "el campo no es numerico";
        }
        return true;
    }
 }
    $validation = new Validation();

    $noEmpty = $validation->noEmpty($_POST["productId"]);
    if($noEmpty == 1) {
       $numeric = $validation->numeric($_POST["productId"]);
    }
    if ($numeric == 1) {
        return true;
    }


?>