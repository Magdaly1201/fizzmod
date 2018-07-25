<?   
include "database_connection.php";

class Validation{
    
//funcion para validar si el campo esta vacio retornando un mensaje    
    public function noEmpty($productId) {
        
        if($productId == "") {
            print "el campo esta vacio";
        }else {
            return true;
        }
    }
//funcion para validar si el campo no es numerico retornando un mensaje    
    public function numeric($productId) {
        if(!is_numeric($productId)) {
            print "el campo no es numerico";
        }
        return true;
    }
 }
    $validation = new Validation();

    $numeric="";

    $noEmpty = $validation->noEmpty($_POST["productId"]);

//si return true entra y valida que sea numerico    
    if($noEmpty == 1) {
//ejecuta la funcion para validar si es numerico
        $numeric = $validation->numeric($_POST["productId"]);
    }
//si numeric return true  entra y retorna true señalando que la validaciones se ejecutaron   
    if ($numeric == 1) {
        //return json_encode(array('mensaje'=>"hola"));
        return true;
    }


?>