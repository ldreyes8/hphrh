function cargar_formularioRH(arg){
  var urlraiz=$("#url_raiz_proyecto").val();

   $("#capa_modal").show();
   $("#capa_formularios").show();
   var screenTop = $(document).scrollTop();
   $("#capa_formularios").css('top', screenTop);
   $("#capa_formularios").html($("#cargador_empresa").html());
   //if(arg==1){ var miurl=urlraiz+"/form_nuevo_usuario"; }
   if(arg==1){ var miurl=urlraiz+"/empleado/psolicitado"; }
   if(arg==2){ var miurl=urlraiz+"/empleado/pconfirmado"; }
   if(arg==3){ var miurl=urlraiz+"/empleado/prechazado"; }

   //Listado de Jefe Inmediato Autorizaciones Vacacioens Y permisos

   if(arg==4){ var miurl=urlraiz+"/empleado/vautorizadopv"; }
 
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

$(document).on("click",".pagination li a",function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    $("#pvsolicitados").html($("#cargador_empresa").html());

    $.get(url,function(resul){
        $("#pvsolicitados").html(resul);  
    })
  })

function buscarindexsolicitado()
{
    var tipoausencia=$("#select").val();
    var dato=$("#searchText").val();
    if(dato == "")
    {
        var url="busquedaindexsolicitado/"+tipoausencia+"";
    }
    else
    {
        var url="busquedaindexsolicitado/"+tipoausencia+"/"+dato+"";
    }
    $("#pvsolicitados").html($("#cargador_empresa").html());
        $.get(url,function(resul){
        $("#pvsolicitados").html(resul);  
    })
}

function buscarindexaceptado()
{
    var tipoausencia=$("#select").val();
    var dato=$("#searchText").val();
    if(dato == "")
    {
        var url="busquedaindexaceptado/"+tipoausencia+"";
    }
    else
    {
        var url="busquedaindexaceptado/"+tipoausencia+"/"+dato+"";
    }
    $("#pvsolicitados").html($("#cargador_empresa").html());
        $.get(url,function(resul){
        $("#pvsolicitados").html(resul);  
    })
}

function buscarindexrechazado()
{
    var tipoausencia=$("#select").val();
    var dato=$("#searchText").val();
    if(dato == "")
    {
        var url="busquedaindexrechazado/"+tipoausencia+"";
    }
    else
    {
        var url="busquedaindexrechazado/"+tipoausencia+"/"+dato+"";
    }
    $("#pvsolicitados").html($("#cargador_empresa").html());
        $.get(url,function(resul){
        $("#pvsolicitados").html(resul);  
    })
}