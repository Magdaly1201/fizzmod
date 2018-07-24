
$(function() {
	$(".see-all").click(function list() {
		__ajax("database_operation.php", "").done( function(info){
		
			var products = JSON.parse(info);
			var html = `<table frame="box" cellpadding="10">
							<tr>
								<th> id </th>
								<th> Nombre </th>
								<th> price </th>
								<th> fecha Creación </th>
							</tr>
						`;
//	console.log(products);
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
		})
		$("#result").html('Cargando');

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
				$("#mensaje").html(info); 
			}else {
				console.log(info);
				test($("#productId").val());
			}
		})
		
		$("#mensaje").html('Cargando');
	})	

 	function test(productId) {
		$.ajax({
			type: "POST",
			url: "database_operation.php",
			data: {"id":productId},
			dataType: "json",
			success: function (result) {
				console.log(result);
			},
			error: function (error) {
				alert("Lo siento ocurrio un error inesperado");
			}
		});
 	}
	
})