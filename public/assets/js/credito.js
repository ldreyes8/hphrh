function cargarcredito(listado){
	$("#creditos").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarcredito";}
    $.get(url,function(resul){
    $("#creditos").html(resul);
    });
}

$(document).ready(function(){
   	$('#btnAgregarC').click(function(){
    	$('#inputTitleC').html("Agregar credito");
    	$('#formAgregarC').trigger("reset");
    	$('#formModalC').modal('show');
	});


    $("#btnGuardarC").click(function(e){
        var miurl="agregarcredito";

        nombre = $("#nombre").val();
        telefono = $("#telefono").val();
    
        var formData = {
            acreedor: $("#acreedor").val(),
            amortizacionmensual: $("#amortizacionmensual").val(),
            montodeuda: $("#montodeuda").val(),
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
              document.getElementById("dataTableItemsC").innerHTML += "<tr class='fila'><td>" +data.acreedor+ "</td><td>" +data.amortizacionmensual + "</td><td>" +data.montodeuda + "</td></tr>";
    
                $('#formModalC').modal('hide');
                
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
                $("#erroresContentC").html(errHTML); 
                $('#erroresModalC').modal('show');
            }
        });
    });
});
