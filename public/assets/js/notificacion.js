function cargarnotificacion(arg){
	var urlraiz=$("#url_raiz_proyecto").val();
	$("#noti").html($("#cargador_empresa").html());
	

	if(arg==1){var miurl=urlraiz+"/empleado/notificacion";}
	if(arg==2){var miurl=urlraiz+"/empleado/add";}
	if(arg==3){var miurl=urlraiz+"/seguridad/index";}
	if(arg==4){var miurl=urlraiz+"/medicamento/index";}
	if(arg==5){var miurl=urlraiz+"/medicamento/compra/index";}
	if(arg==6){var miurl=urlraiz+"/medicamento/proveedor/index";}

	if(arg==20){var miurl=urlraiz+"/bienhechor/index";}
 	
    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
     $("#noti").html(resul);
   
    }).fail( function() 
   {
    $("#noti").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;
}

//RETORNA VACACIONES PERMISO
function VP(arg,notifi){

	var my_url;
	var urlraiz=$("#url_raiz_proyecto").val();
    my_url=urlraiz+"/empleado/leernotifica";

	$.ajaxSetup({
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    var formData = {
    	idnotificacion: notifi,
    };

    $.ajax({
    	type: 'POST',
        url: my_url,
        data: formData,
        dataType: 'json',
        
        success: function (data) {
	        if(arg==1)
	        {
	        	window.location.href="/empleado/solicitud"
	        }
	        if(arg==2)
	        {
	        	window.location.href="/empleado/solicitudpermiso"
	        }   
        },

        error: function (data) {
            $('#loading').modal('hide');
            var errHTML="";
            if((typeof data.responseJSON != 'undefined')){
                for( var er in data.responseJSON){
                    errHTML+="<li>"+data.responseJSON[er]+"</li>";
                }
            }else{
                errHTML+='<li>Error</li>';
            }
            $("#erroresContent").html(errHTML); 
            $('#erroresModal').modal('show');
        }
    });   
}
               
