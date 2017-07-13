function cargar_formulario(arg){
   var urlraiz=$("#url_raiz_proyecto").val();

   $("#capa_modal").show();
   $("#capa_formularios").show();
   var screenTop = $(document).scrollTop();
   $("#capa_formularios").css('top', screenTop);
   $("#capa_formularios").html($("#cargador_empresa").html());
   //if(arg==1){ var miurl=urlraiz+"/form_nuevo_usuario"; }
   if(arg==1){ var miurl=urlraiz+"/empleado/vacaciones"; }
   if(arg==2){ var miurl=urlraiz+"/empleado/permiso"; }
   if(arg==3){ var miurl=urlraiz+"/empleado/goce"; }

   //Listado de Jefe Inmediato Autorizaciones Vacacioens Y permisos

   if(arg==4){ var miurl=urlraiz+"/empleado/solicitadoVP"; }
   if(arg==5){ var miurl=urlraiz+"/empleado/confirmado"; }
   if(arg==6){ var miurl=urlraiz+"/empleado/rechazado"; }
   if(arg==7){ var miurl=urlraiz+"/empleado/vautorizado"; }

    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
     $("#capa_formularios").html(resul);
   
    }).fail( function() 
   {
    $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;

}