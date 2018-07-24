
$(function() {
	$(".see-all").click(function list() {
		__ajax("database_operation.php", "").done( function(info){
		
			var products = JSON.parse(info);
			if(products.message == "No hay Registros") {
				//console.log(result);
				var html =products.message; 
				$("#result").html(html);
			} else {
			var html = `<table frame="box" cellpadding="10">
							<tr>
								<th> id </th>
								<th> Nombre </th>
								<th> price </th>
								<th> fecha Creación </th>
							</tr>
						`;
			for(var i in products){					
				html+= `<tr>
							<td> ${products[i].id} </td>
							<td> ${products[i].name} </td>
							<td> ${products[i].price} </td>
							<td> ${products[i].date_created} </td>
						</tr>
						`	
			}
		
			html +=` </table> `
			$("#result").html( html );
		}	
		})
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
				consult_id($("#productId").val());
			}
		})
		
		
	})	

 	function consult_id(productId) {
		 
		$.ajax({
			type: "POST",
			url: "database_operation.php",
			data: {"id":productId}
			,
			success: function (result) {
				var products = JSON.parse(result);
				if(products.message == "No hay Registros") {
					//console.log(result);
					var html =products.message; 
					$("#result").html(html);
				} else {
					var products = JSON.parse(result);
					var html = `<table frame="box" cellpadding="10">
								<tr>
									<th> id </th>
									<th> Nombre </th>
									<th> price </th>
									<th> fecha Creación </th>
								</tr>
							`;
				for(var i in products){					
					html+= `<tr>
								<td> ${products[i].id} </td>
								<td> ${products[i].name} </td>
								<td> ${products[i].price} </td>
								<td> ${products[i].date_created} </td>
							</tr>
							`	
				}
			
				html +=` </table> `
				$("#result").html( html );
			}
			},
			error: function (error) {
				alert("Lo siento ocurrio un error inesperado");
			}
		});$("#result").html('Cargando...');
 	}
	
})