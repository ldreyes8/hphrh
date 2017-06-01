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
        $('#btnGuardarO').val('add');
        $('#formModalO').modal('show');
    });

    $(document).on('click','.btn-editar-cel',function(){

        var idem=$(this).val();
        var miurl="listarotros1";
        $.get(miurl+'/'+ idem,function(data){
            console.log(data);
            $('#idem').val(data.idempleado);
            $('#celcorporativo').val(data.celcorporativo);
            $('#talla').val(data.talla);
            $('#altura').val(data.altura);
            $('#peso').val(data.peso);

            $('#inputTitleO').html("Actualizar otros");
            $('#formModalO').modal('show');
            $('#btnGuardarO').val('update');
            $('loading').modal('hide');
        });
        
    });
    $("#btnGuardarO").click(function(e){
        var miurl="agregarotros";

        celcorporativo = $("#celcorporativo").val();
        talla = $("#talla").val();
        altura = $("#altura").val();
        peso = $("#peso").val();
        var idem=$('#idem').val();
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
                var item = '<tr class="even gradeA" id="idem'+data.idempleado+'">';
                    item += '<td>'+data.celcorporativo+'</td>'+'<td>' +data.talla+ '</td>'+'<td>'+data.altura+'</td>'+'<td>'+data.peso+'</td>';
                    item += '<td><button class="fa fa-pencil btn-editar-cel" value="'+data.idempleado+'"></button>';
                    $("#idem"+idem).replaceWith(item);
                /*if (state == "add")
                {
                    $('#products').append(item);
                }
                if (state == "update")
                {
                    $("#idem"+idex).replaceWith(item);
                }*/
              //document.getElementById("dataTableItemsO").innerHTML += "<tr class='fila'><td>" +celcorporativo+ "</td><td>" +talla + "</td><td>" +altura + "</td><td>" + peso + "</td><td><button class='fa fa-pencil'></button></tr>";
                $('#formAgregarO').trigger("reset");
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
