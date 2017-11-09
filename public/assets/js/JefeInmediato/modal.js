function cargarvacante(arg){
	var urlraiz=$("#url_raiz_proyecto").val();

	if(arg==1){
		var miurl=urlraiz+"/empleado/plazavacante";
		var errHTML="";

		$.ajax({
			url: miurl
		}).done( function(resul) 
		{
			$("#listadoVacante").html(resul);
			$('#inputTitleVacante').html("Solicitud de un puesto vacante");
        	$('#formModalVacante').modal('show');

		}).fail(function() 
		{
			$("#listadoVacante").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
		}) ;
	}
}