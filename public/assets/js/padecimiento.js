function cargarpadecimiento(listado){
	$("#padecimientos").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarpadecimiento";}
    $.get(url,function(resul){
    $("#padecimientos").html(resul);
    });
}

$(document).ready(function(){
   	$('#btnAgregarP').click(function(){
    	$('#inputTitleP').html("Agregar padecimiento");
    	$('#formAgregarP').trigger("reset");
    	$('#formModalP').modal('show');
	});


    $("#btnGuardarP").click(function(e){
        var miurl="agregarpadecimiento";

        nombre = $("#nombrep").val();
    
        var formData = {
            nombre: $("#nombrep").val(),
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
              document.getElementById("dataTableItemsP").innerHTML += "<tr class='fila'><td>" +data.nombre+ "</td></tr>";
    
                $('#formModalP').modal('hide');
                
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
                $("#erroresContentP").html(errHTML); 
                $('#erroresModalP').modal('show');
            }
        });
    });
});
