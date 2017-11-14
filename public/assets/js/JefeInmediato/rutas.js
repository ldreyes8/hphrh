function detalleviaje(arg,id)
{
	var urlraiz=$("#url_raiz_proyecto").val();
console.log(id);
	if(arg==1){var miurl =urlraiz+"/ji/viajejf/detallesolicitud/"+id+"";}
  if(arg==2){var miurl =urlraiz+"/ji/viajejf/detalleauto/"+id+"";}  
	$.ajax({
		url: miurl
    }).done( function(resul) 
    {
    	$("#VPJF").html(resul);
    }).fail( function() 
   	{
   		$("#VPJF").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   	});
}
