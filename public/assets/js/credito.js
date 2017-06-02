function cargarcredito(listado){
	$("#creditos").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarcredito";}
    $.get(url,function(resul){
    $("#creditos").html(resul);
    });
}

$(document).ready(function(){
   	$('#btnAgregarC').click(function(){
    	$('#inputTitleC').html("Agregar crédito"); //asignar un titulo al modal
    	$('#formAgregarC').trigger("reset");
        $('#btnGuardarC').val('add'); //le asignamos un valor al boton guardar para que el evento se guardar y no actualizar
    	$('#formModalC').modal('show'); //inicializa en modal  e invocamos al metodo show inmediatemaente 
	});

    $(document).on('click','.btn-editar-credito',function(){
        var idco=$(this).val(); //obtenemos el valor del fila que deceamos actualizar 
        var miurl="listarcredito1"; // url que nos va a cagar toda la data de este id fila a modificar 
        $.get(miurl+'/'+ idco,function(data){  //obteneomos toda la data de la url y del id especificado
            console.log(data); //mostramos la data en consola 
            $('#idco').val(data.idpdeudas); //obtenemos el id para cargar DB
            $('#acreedor').val(data.acreedor); //obtenemos el valor campo acreedor de la DB
            $('#amortizacionmensual').val(data.amortizacionmensual);//
            $('#montodeuda').val(data.montodeuda);//
            $('#mdeuda').val(data.motivodeuda);//

            $('#inputTitleC').html("Modificar crédito");// cargamos el tiulo del modal 
            $('#formModalC').modal('show');//abrimos el modal ya con los datos del id que deceamos modificar ya con la data 
            $('#btnGuardarC').val('update');//asignamos valor al boton guardar para que actualize
            $('loading').modal('hide');//carga del modal
        });
    });

    $(document).on('click','.btn-delete-credito',function(){
        var idco=$(this).val(); //obtenemo id de la fila que deceamos eliminar
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        //mensaje de alerta para la eliminación
        if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) {
            return false;//Si es cancelar retornanmos el false que es el cierre de la alerta sin que se realiza ningun  cambio 
            }
        else {
                $.ajax({
                    type: "DELETE", //DELETE significa el tipon de metodo que estamos utiliando para la eliminación 
                    url: 'deletecredito/' + idco, //mandamos el id a la url para que elimine el campo de la DB
                    success: function (data) {
                        console.log(data);//cargamos la data
                        $("#deudas" + idco).remove();//eliminamos la fila de la tabla 
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

        /*$.ajax({
            type: "DELETE",
            url: 'deletecredito/' + idco,
            success: function (data) {
                console.log(data);
                $("#deudas" + idco).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });*/

        $("#erroresContentC").html(errHTML); 
        $('#erroresModalC').modal('show');
    });

    $("#btnGuardarC").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')// token para poder enviar el formullario de lo contrario no podremos realizar el crud
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

        if (state == "update") //validacion para que sea de tipo actualizar el campo que deceamos 
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
