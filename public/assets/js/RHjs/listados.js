function cargar_formularioRH(arg){
    var urlraiz=$("#url_raiz_proyecto").val();

    $("#capa_modal").show();
    $("#capa_formularios").show();
    var screenTop = $(document).scrollTop();
    $("#capa_formularios").css('top', screenTop);
    $("#capa_formularios").html($("#cargador_empresa").html());
    //if(arg==1){ var miurl=urlraiz+"/form_nuevo_usuario"; }
    if(arg==1){ var miurl=urlraiz+"/empleado/empleados"; }
    if(arg==2){ var miurl=urlraiz+"/empleado/debaja"; }
    if(arg==3){ var miurl=urlraiz+"/empleado/rechazados";}
    if(arg==4){ var miurl=urlraiz+"/empleado/indexnombramiento"; }

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

function vernombramiento_emp(arg){
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl =urlraiz+"/empleado/addnombramiento/"+arg+""; 
    $("#lisadoEmp").show();
    var screenTop = $(document).scrollTop();
    $("#lisadoEmp").css('top', screenTop);
    $("#lisadoEmp").html($("#cargador_empresa").html());

    $.ajax({
      url: miurl
    }).done( function(resul) 
    {
      $("#lisadoEmp").html(resul);
    }).fail( function() 
    {
      $("#lisadoEmp").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });
}