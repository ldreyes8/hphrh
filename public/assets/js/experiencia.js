function cargarexperiencia(listado){
	$("#experiencias").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarexperiencia";}
    $.get(url,function(resul){
    $("#experiencias").html(resul);
    });
}

$(document).ready(function(){
   	$('#btnAgregarE').click(function(){
    	$('#inputTitleE').html("Agregar padecimiento");
    	$('#formAgregarE').trigger("reset");
    	$('#formModalE').modal('show');
	});


    $("#btnGuardarE").click(function(e){
        var miurl="agregarexperiencia";

        añoi = $("#año_ingreso").val();
        añof = $("#año_salida").val();
    
        var formData = {
            empresa: $("#empresa").val(),
            puesto: $("#puesto").val(),
            jefeinmediato: $("#jefeinmediato").val(),
            motivoretiro: $("#motivoretiro").val(),
            ultimosalario: $("#ultimosalario").val(),
            año_ingreso: $("#año_ingreso").val(),
            año_salida: $("#año_salida").val(),
            idempleado: $("#idempleado").val(),
            identificacion: $("#identificacion").val(),
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: miurl,
            data: formData,
            dataType: 'json',

            success: function (data) {
              document.getElementById("dataTableItemsE").innerHTML += "<tr class='fila'><td>" +data.empresa+ "</td><td>"+data.puesto+"</td><td>"+data.jefeinmediato+"</td><td>"+data.motivoretiro+"</td><td>"+data.ultimosalario+"</td><td>"+añoi+"</td><td>"+añof+"</td></tr>";
    
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
                $("#erroresContentE").html(errHTML); 
                $('#erroresModalE').modal('show');
            }
        });
    });
});
