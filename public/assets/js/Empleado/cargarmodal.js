function cargar_formularioviaje(arg){
  var urlraiz=$("#url_raiz_proyecto").val();

   $("#capa_modal").show();
   $("#capa_formularios").show();
   var screenTop = $(document).scrollTop();
   $("#capa_formularios").css('top', screenTop);
   $("#capa_formularios").html($("#cargador_empresa").html());
   //if(arg==1){ var miurl=urlraiz+"/form_nuevo_usuario"; }
   if(arg==1){ var miurl=urlraiz+"/empleado/viaje/solicitar"; }
   if(arg==2){ var miurl=urlraiz+"/empleado/viaje/liquidar"; }
   if(arg==3){ var miurl=urlraiz+"/empleado/viaje/add"; }
   if(arg==4){ var miurl=urlraiz+"/empleado/cajachica/solicitar"; }
   //Listado de Jefe Inmediato Autorizaciones Vacacioens Y permisos

   if(arg==4){ var miurl=urlraiz+"/empleado/vautorizadopv"; }

   if(arg==20){ var miurl=urlraiz+"/ji/viajejf/solicitados"; }
   if(arg==21){ var miurl=urlraiz+"/ji/viajejf/autorizados"; }
   if(arg==22){ var miurl=urlraiz+"/ji/viajejf/detalleauto"; }
 
    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
    	$("#capa_formularios").html(resul);
    }).fail( function() 
    {
    	$("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });
}




$(document).on("click",".pagination li a",function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    $("#pvsolicitados").html($("#cargador_empresa").html());

    $.get(url,function(resul){
        $("#pvsolicitados").html(resul);  
    })
});