<?php 
include "database_connection.php";

class Products {

    function addProducts() {
        $json = file_get_contents("pub/products.json");
        
        $products = json_decode($json,true);
        $database_connection = new Database_Connection;     

        foreach($products as $row) {
            $conectionDatabase -> insert("products" ,$row); 
        }
        
    }
}
$products = new Products;
$products -> addProducts(); 


?>
