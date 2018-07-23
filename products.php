<?php 
include "conection_database.php";

class Products {

    function addProducts() {
        $json = file_get_contents("pub/products.json");
        
        $products = json_decode($json,true);
        $conectionDatabase = new Conection_Database;     

        foreach($products as $row) {
            $conectionDatabase -> insert("products" ,$row); 
        }
        
    }
}
$products = new Products;
$products -> addProducts(); 


?>
