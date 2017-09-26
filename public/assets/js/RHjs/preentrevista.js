$(document).ready(function(){
   	$('#btnprecalguardar').click(function(){
   		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
		//alert('prueba');
     var dispo=document.getElementsByName("disponibilidad");
     var dispofin=document.getElementsByName("dispfinsemana");
     var dispovia=document.getElementsByName("dispoviajar");
     var ordenado=document.getElementsByName("ordenado");
     var dispoenvio="ni";
     var dispoenfin="ni";
     var dispoenvia="ni";
     var ordenados="ni";
     for (var i=0;i<dispo.length;i++)
     {
      if(dispo[i].checked)
        dispoenvio=dispo[i].value;
     }

     for (var i=0;i<dispofin.length;i++)
     {
      if(dispofin[i].checked)
        dispoenfin=dispofin[i].value;
     }

     for (var i=0;i<dispovia.length;i++)
     {
      if(dispovia[i].checked)
        dispoenvia=dispovia[i].value;
     }
     for (var i=0;i<ordenado.length;i++)
     {
      if(ordenado[i].checked)
        ordenados=ordenado[i].value;
     }
		var formData = {
        identificacion:$("#identificacion").val(),
        identrevista:$("#identrevista").val(),
   			idempleado:$("#idempleado").val(),
        aportefamilia:$("#aportefamilia").val(),
   			fechaentre:$("#fechaentre").val(),
   			vivecompania:$("#vivecompania").val(),
   			mcorto:$("#mcorto").val(),
   			mmediano:$("#mmediano").val(),
   			mlargo:$("#mlargo").val(),
   			descpersonal:$("#descpersonal").val(),
   			trabajoequipo:$("#trabajoequipo").val(),
   			bajopresion:$("#bajopresion").val(),
   			atencionpublico:$("#atencionpublico").val(),
   			ordenado:ordenados,
   			entrevistadores:$("#entrevistadores").val(),
   			puntual:$("#puntual").val(),
   			presentacion:$("#presentacion").val(),
   			disponibilidad:dispoenvio,
   			dispfinsemana:dispoenfin,
   			dispoviajar:dispoenvia,
   			pretensionminima:$("#pretensionminima").val(),
        dedicanpadres:$("#dedicanpadres").val(),
        lugar:$("#lugar").val(),
        comunicar:$("#comunicar").val(),
        };
        console.log(formData);
       	$.ajax({
            type: "POST",
            url: "prentrevista",
            data: formData,
            dataType: 'json',

            success: function (data) {
            	  
				swal({ 
                    title:"Envio correcto",
                    text: "Información actualizada correctamente",
                    type: "success"
                });
            },
            error: function (data) {
                
            }
        });

	});
});