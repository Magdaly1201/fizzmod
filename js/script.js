
function deleteProduct(productId){
	$.ajax({
		type: "POST",
		url: "database_operation.php",
		data: {"id_delete":productId}
		,
		success: function (result) {
			$("#fila_"+productId).remove();		

		},
		error: function (error) {
			alert("Lo siento ocurrio un error inesperado");
		}
	});
 
}

$(function() {
	$(".see-all").click(function list() {
		__ajax("database_operation.php", "").done( function(info){
			var products = JSON.parse(info);
//si devuelve un mensaje de no hay registro se ejecuta
			if(products.message == "No hay Registros") { 
				var html =products.message; 
				//envia el mensaje 
				$("#result").html(html);
			} else { 
//creacion de la tabla con los registros consultados en la bd
				var html = `<table frame="box" cellpadding="10">
								<tr>
									<th> id </th>
									<th> Nombre </th>
									<th> price </th>
									<th> fecha Creación </th>
									<th> Acción </th>
								</tr>
							`;
				for(var i in products){					
					html+= `<tr id='fila_${products[i].id}'>
								<td> ${products[i].id} </td>
								<td> ${products[i].name} </td>
								<td> ${products[i].price} </td>
								<td> ${products[i].date_created} </td>
								<td> 
									<input type="button" class="delete"	onclick='deleteProduct(${products[i].id})' value="ELIMINAR">  
								</td>
							</tr>
							`	
				}
		
				html +=` </table> `
//envia el resultado de la tabla ya creada			
				$("#result").html( html );
				////asignarEventoCick();
			}	
		})
//mensaje de cargando mientras realiza la consulta
		$("#result").html('Cargando...');
	});
	
	
	function __ajax(url, data) {
		var ajax = $.ajax({
			"method": "POST",
			"url": url,
			"data": data
		})
		return ajax;
	}
	
	$(".consult").click(function list() {
		__ajax("validation.php", $("#productId").serialize()).done( function(info){	
			if($.trim(info).length >0) {
				$("#productId").html("#productId");
				$("#result").html(info); 
			}else {
//enviar el id despues de validado a la consulta 				
				consult_id($("#productId").val());
			}
		})	
	})


//funcion de consultar id	
 	function consult_id(productId) {
		 
		$.ajax({
			type: "POST",
			url: "database_operation.php",
			data: {"id":productId}
			,
			success: function (result) {
				var products = JSON.parse(result);
//validar que exista registro				
				if(products.message == "No hay Registros") {
					//console.log(result);
					var html =products.message; 
					$("#result").html(html);
				} else {
//si existe registro creacion de la tabla con todos los registros					
					var products = JSON.parse(result);
									var html = `<table frame="box" cellpadding="10">
								<tr>
									<th> id </th>
									<th> Nombre </th>
									<th> price </th>
									<th> fecha Creación </th>
									<th> Acción </th>
								</tr>
							`;
				for(var i in products){					
					html+= `<tr id='fila_${products[i].id}'>
								<td> ${products[i].id} </td>
								<td> ${products[i].name} </td>
								<td> ${products[i].price} </td>
								<td> ${products[i].date_created} </td>
								<td> 
									<input type="button" class="delete"	onclick='deleteProduct(${products[i].id})' value="ELIMINAR">  
								</td>
							</tr>
							`	
				}
		
				html +=` </table> `
//envia el resultado de la tabla ya creada			
				$("#result").html( html );
				}
			},
			error: function (error) {
				alert("Lo siento ocurrio un error inesperado");
			}
		});$("#result").html('Cargando...');
 	}
	
})