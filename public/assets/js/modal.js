function cargarbusqueda(arg){
	var urlraiz=$("#url_raiz_proyecto").val();
	$("#modalbuscar").html($("#cargador_empresa").html());
	
	if(arg==1){var miurl=urlraiz+"/empleado/viaje/cargarbusqueda"; var titulo="Buscar vehiculo" ;}
	if(arg==2){var miurl=urlraiz+"/medicamento/cargarbusqueda"; var titulo="Buscar medicamento" ;}
	if(arg==3){var miurl=urlraiz+"/medicamento/ubicacion/cargarbusqueda"; var titulo="Buscar ubicacion" ; }
	if(arg==6){var miurl=urlraiz+"/medicamento/proveedor/cargarbusqueda"; var titulo="Buscar proveedor" ;}
	if(arg==7){var miurl=urlraiz+"/medicamento/ubicacion/cargarbusqueda"; var titulo="Buscar ubicacion" ; }

	if(arg==20){var miurl=urlraiz+"/bienhechor/index";}

	var errHTML="";

    $.ajax({
        url: miurl
    }).done( function(resul) 
    {
        $("#modalbuscar").html(resul);
        $('#inputTitleBuscar').html(titulo);
        $('#formModalBuscar').modal('show');
    }).fail( function() 
    {
        $("#modalbuscar").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });
}