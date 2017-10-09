$(document).ready(function(){
   	$('#btnAgregarE').click(function(){
    	$('#inputTitleE').html("Agregar Experiencia");
    	$('#formAgregarE').trigger("reset");
    	$('#formModalE').modal('show');
	});

    $("#btnGuardarE").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var formData = {
            empresa: $("#empresa").val(),
            puesto: $("#puesto").val(),
            jefeinmediato: $("#jefeinmediato").val(),
            teljefeinmediato: $("#teljefeinmediato").val(),
            motivoretiro: $("#motivoretiro").val(),
            ultimosalario: $("#ultimosalario").val(),
            año_ingreso: $("#año_ingreso").val(),
            año_salida: $("#año_salida").val(),
            idempleado: $("#idempleado").val(),
            identificacion: $("#identificacion").val(),
        };
        var type;
        var my_url;
        type="POST";
        my_url = 'agregarexperiencia';

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',

            success: function (data) {
                var item = '<tr class="even gradeA" id="experiencia'+data.idpexperiencia+'">';
                    item += '<td>'+data.empresa+'</td>'+'<td>' +data.puesto+ '</td>'+'<td>'+data.jefeinmediato+'</td>'+'<td>'+data.teljefeinmediato+'</td>'+'<td>'+data.motivoretiro+'</td>'+'<td>'+data.ultimosalario+'</td>'+'<td>'+data.fingresoex+'</td>'+'<td>'+data.fsalidaex+'</td>';
                $('#products').append(item);
                $('#formAgregarE').trigger("reset");
                $('#formModalE').modal('hide');
                
            },
            error: function (data) {
                $('#loading').modal('hide');
                var errHTML="";
                if((typeof data.responseJSON != 'undefined')){
                    for( var er in data.responseJSON){
                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                    }
                }else{
                    errHTML+='<li>Verificar los datos ingresados.</li>';
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });
    });
});