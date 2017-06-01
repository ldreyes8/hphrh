function cargarcredito(listado){
	$("#creditos").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarcredito";}
    $.get(url,function(resul){
    $("#creditos").html(resul);
    });
}

$(document).ready(function(){
   	$('#btnAgregarC').click(function(){
    	$('#inputTitleC').html("Agregar crédito");
    	$('#formAgregarC').trigger("reset");
        $('#btnGuardarC').val('add');
    	$('#formModalC').modal('show');
	});

    $(document).on('click','.btn-editar-credito',function(){
        var idco=$(this).val();
        var miurl="listarcredito1";
        $.get(miurl+'/'+ idco,function(data){
            console.log(data);
            $('#idco').val(data.idpdeudas);
            $('#acreedor').val(data.acreedor);
            $('#amortizacionmensual').val(data.amortizacionmensual);
            $('#montodeuda').val(data.montodeuda);
            $('#mdeuda').val(data.motivodeuda);

            $('#inputTitleC').html("Modificar crédito");
            $('#formModalC').modal('show');
            $('#btnGuardarC').val('update');
            $('loading').modal('hide');
        });
    });

    $(document).on('click','.btn-delete-credito',function(){
        var idco=$(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "DELETE",
            url: 'deletecredito/' + idco,
            success: function (data) {
                console.log(data);
                $("#deudas" + idco).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

        $("#erroresContentC").html(errHTML); 
        $('#erroresModalC').modal('show');
    });

    $("#btnGuardarC").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var formData = {
            acreedor: $("#acreedor").val(),
            amortizacionmensual: $("#amortizacionmensual").val(),
            montodeuda: $("#montodeuda").val(),
            mdeuda:$("#mdeuda").val(),
            idempleado: $("#idempleado").val(),
            identificacion: $("#identificacion").val(),
        };

        var state=$("#btnGuardarC").val();
        var type;
        var idco=$('#idco').val();
        var my_url;

        if (state == "update") 
                {
                    type="PUT";
                    my_url = 'updateco/'+idco;
                }
        if (state == "add") 
                {
                    type="POST";
                    my_url = 'agregarcredito';
                }

        //var miurl="agregarcredito";

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',

            success: function (data) {
                var item = '<tr class="even gradeA" id="deudas'+data.idpdeudas+'">';
                    item += '<td>'+data.acreedor+'</td>'+'<td>' +data.amortizacionmensual+ '</td>'+'<td>'+data.montodeuda+'</td>'+'<td>'+data.motivodeuda+'</td>';
                    item += '<td><button class="fa fa-pencil btn-editar-credito" value="'+data.idpdeudas+'"></button>';
                    item += '<button class="fa fa-trash-o btn-delete-credito" value="'+data.idpdeudas+'"></button></td></tr>';
                if (state == "add")
                {
                    $('#productsC').append(item);
                }
                if (state == "update")
                {
                    $("#deudas"+idco).replaceWith(item);
                }

              //document.getElementById("dataTableItemsC").innerHTML += "<tr class='fila'><td>" +data.acreedor+ "</td><td>" +data.amortizacionmensual + "</td><td>" +data.montodeuda + "</td></tr>";
                $('#formAgregarC').trigger("reset");
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
