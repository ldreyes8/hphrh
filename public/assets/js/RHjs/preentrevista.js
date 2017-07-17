$(document).ready(function(){
   	$('#btnprecalguardar').click(function(){
   		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
		//alert('prueba');
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
   			puntual:$("#puntual").val(),
   			presentacion:$("#presentacion").val(),
   			disponibilidad:$("#disponibilidad").val(),
   			dispfinsemana:$("#dispfinsemana").val(),
   			dispoviajar:$("#dispoviajar").val(),
   			bajopresion:$("#bajopresion").val(),
   			pretensionminima:$("#pretensionminima").val(),
        };
       	$.ajax({
            type: "POST",
            url: "prentrevista",
            data: formData,
            dataType: 'json',

            success: function (data) {
            	//alert('prueba')
				//swal("Good job!", "You clicked the button!", "success")  
				console.log('alert');   
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