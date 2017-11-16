function ji_reportes(arg)
{
    var urlraiz=$("#url_raiz_proyecto").val();

    $("#lisadoEmp").show();    
    var screenTop = $(document).scrollTop();
    $("#lisadoEmp").css('top', screenTop);
    $("#lisadoEmp").html($("#cargador1").html());
    if(arg==0){ var miurl=urlraiz+"/ji/reporte/vpempleado/index";}

    $.ajax({
      url: miurl
    }).done( function(resul) 
    {
      $("#lisadoEmp").html(resul);
    }).fail( function() 
    {
      $("#lisadoEmp").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    }) ;


}

function ji_reporte(arg,id){
    var urlraiz=$("#url_raiz_proyecto").val();

    $("#lisadoEmp").show();    
    var screenTop = $(document).scrollTop();
    $("#lisadoEmp").css('top', screenTop);
    $("#lisadoEmp").html($("#cargador1").html());

    if(arg==1){ var miurl=urlraiz+"/ji/reporte/vacaciones/"+id; }
    if(arg==2){ var miurl=urlraiz+"/ji/reporte/permiso/"+id; }

    $.ajax({
      url: miurl
    }).done( function(resul) 
    {
      $("#lisadoEmp").html(resul);
    }).fail( function() 
    {
      $("#lisadoEmp").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    }) ;
}