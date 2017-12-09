function detalleviaje(arg,id)
{
	var urlraiz=$("#url_raiz_proyecto").val();
console.log(id);
	if(arg==1){var miurl =urlraiz+"/ji/viajejf/detallesolicitud/"+id+"";}
<<<<<<< HEAD
  if(arg==2){var miurl =urlraiz+"/ji/viajejf/detalleauto/"+id+"";}
  if(arg==3){var miurl =urlraiz+"/asistete/viaje/detallesliq/"+id+"";}
  if(arg==4){var miurl =urlraiz+"/ji/viajejf/detallesliq/"+id+"";}  
=======
  if(arg==2){var miurl =urlraiz+"/ji/viajejf/detalleauto/"+id+"";}  
>>>>>>> parent of d2dac8a... Se esta modificando viajes en asistentes
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
