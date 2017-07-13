$(document).ready(function(){
   	$('#btnprecalguardar').click(function(){
   		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
		
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
   			ordenado:$("#ordenado").val(),
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