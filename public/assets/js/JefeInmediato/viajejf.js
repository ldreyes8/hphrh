$(document).ready(function(){
	$('#btnconfirma').click(function(){
		swal({ 
        	title:"Envio correcto",
        	text: "Información actualizada correctamente",
        	type: "success"
    	},
    	function(){
   		});
	});
	$('#btnrechazo').click(function(){
		swal({ 
        	title:"Envio correcto",
        	text: "Se ha rechazado exitosamente esta solicitud de gastos",
        	type: "success"
    	},
    	function(){
   		});
	});
	$('#btnconfirma1').click(function(){
		alert("Solicitud");
	});
	$('#btnrechazo1').click(function(){
		alert("Rechazo");
	});
});