function cargarotros(listado){
    $("#otros").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarotros";}
    $.get(url,function(resul){
    $("#otros").html(resul);
    });
}

$(document).ready(function(){
    $('#btnAgregarO').click(function(){
        $('#inputTitleO').html("Agregar otros");
        $('#formAgregarO').trigger("reset");
        $('#formModalO').modal('show');
    });


    $("#btnGuardarO").click(function(e){
        var miurl="agregarotros";

        celcorporativo = $("#celcorporativo").val();
        talla = $("#talla").val();
        altura = $("#altura").val();
        peso = $("#peso").val();
    
        var formData = {
            celcorporativo : $("#celcorporativo").val(),
            talla : $("#talla").val(),
            altura : $("#altura").val(),
            peso : $("#peso").val(),
            idempleado: $("#idempleado").val(),
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
              document.getElementById("dataTableItemsO").innerHTML += "<tr class='fila'><td>" +celcorporativo+ "</td><td>" +talla + "</td><td>" +altura + "</td><td>" + peso + "</td><td><button class='fa fa-pencil'></button> <button class='fa fa-trash-o'></button></td></tr>";
    
                $('#formModalO').modal('hide');
                
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
                $("#erroresContentO").html(errHTML); 
                $('#erroresModalO').modal('show');
            }
        });
    });
});
