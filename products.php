<?php 
include "database_operation.php";

class Products {

    function addProducts() {
        $json = file_get_contents("pub/products.json");
        
        $products = json_decode($json,true);
        $database_operation = new Database_Operation;     

        foreach($products as $row) {
            $database_operation -> insert("products" ,$row); 
        }
        
    }
}
$products = new Products;
//ejecucion de la funcion addProducts para la inclusion del archivo .json en la bd
$products -> addProducts(); 


?>
