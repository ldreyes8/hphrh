$(document).ready(function(){
   	$('#btnprecalguardar').click(function(){
   		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
		var ordenado=document.getElementsByName("ordenado");
    var ordenados="ni";
    for (var i=0;i<ordenado.length;i++)
     {
      if(ordenado[i].checked)
        ordenados=ordenado[i].value;
     }
		var formData = {
            identificacion:$("#identificacion").val(),
   			idempleado:$("#idempleado").val(),
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
        };
       	$.ajax({
            type: "POST",
            url: "prentrevista",
            data: formData,
            dataType: 'json',

            success: function (data) {
                console.log(formData);
                swal({ 
                    title:"Envio correcto",
                    text: "Información actualizada correctamente",
                    type: "success"
                },
                function(){
                    //window.location.href="/empleado/solicitante"
                });
                
            },
            error: function (data) {
                
            }
        });

	});
});