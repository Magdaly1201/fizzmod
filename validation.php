<?php
include "conection_database.php";

class Validation{
    
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
<script>
    $(function()
    {
        $(".consult").click(function(){
 		var url = "validation.php"; // El script a dónde se realizará la petición.
    	
		$.ajax({
           type: "POST",
           url: url,
           data: $("#form").serialize(), // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               $("#productId").html('');
               $("#mensaje").html(data); // Mostrar la respuestas del script PHP.

		   }
         });

    return false; // Evitar ejecutar el submit del formulario.
 	});
    });
</script>