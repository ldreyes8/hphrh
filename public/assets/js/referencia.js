function cargarreferencia(listado){
	$("#referencias").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarreferencia";}
    $.get(url,function(resul){
    $("#referencias").html(resul);
    });
}

$(document).ready(function(){
   	$('#btnAgregarR').click(function(){
    	$('#inputTitleR').html("Agregar referencias");
    	$('#formAgregarR').trigger("reset");
    	$('#formModalR').modal('show');
	});


    $("#btnGuardarR").click(function(e){
        var miurl="agregarreferencia";

        nombre = $("#nombre").val();
        telefono = $("#telefono").val();
    
        var formData = {
            nombre: $("#nombre").val(),
            telefono: $("#telefono").val(),
            profesion: $("#profesion").val(),           
            tiporeferencia: $("#tiporeferencia").val(),
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
              document.getElementById("dataTableItemsR").innerHTML += "<tr class='fila'><td>" +nombre+ "</td><td>" +telefono + "</td><td>" +data.profesion + "</td><td>" + data.tiporeferencia + "</td></tr>";
    
                $('#formModalR').modal('hide');
                
            },
            error: function (data) {
                $('#loading').modal('hide');
                var errHTML="";
                if((typeof data.responseJSON != 'undefined')){
                    for( var er in data.responseJSON){
                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                    }
                }else{
                    errHTML+='<li>Error al borrar el &aacute;rea de atenci&oacute;n.</li>';
                }
                $("#erroresContentR").html(errHTML); 
                $('#erroresModalR').modal('show');
            }
        });
    });
});
