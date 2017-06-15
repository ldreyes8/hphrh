function cargaracademico(listado){
	$("#academicos").html($("#cargador_empresa").html());
    if(listado==1){var url = "listaracademico";}
    $.get(url,function(resul){
    $("#academicos").html(resul);
    });
}

$(document).ready(function(){
   	$('#btnAgregar').click(function(){
    	$('#inputTitle').html("Agregar información académica");
    	$('#formAgregar').trigger("reset");
        $('#btnGuardar').val('add');
    	$('#formModal').modal('show');
	});

    $('#btnAgregarI').click(function(){
        $('#inputTitleI').html("Agregar información académica");
        $('#formAgregarI').trigger("reset");
        $('#btnGuardarI').val('add');
        $('#formModalI').modal('show');
    });

    $("#iddepartamento1").change(event => {
        $.get(`towns/${event.target.value}`, function(res, sta){
            $("#pidmunicipio").empty();
                res.forEach(element => {
                    $("#pidmunicipio").append(`<option value=${element.idmunicipio}> ${element.nombre} </option>`);
                });
            });
        });

    $(document).on('click','.btn-editar-academico',function(){
        var idacad=$(this).val();
        var miurl="listaracademico1";
        $.get(miurl+'/'+ idacad,function(data){
            console.log(data);
            $('#idacad').val(data.idpacademico);
            $('#titulo').val(data.titulo);
            $('#establecimiento').val(data.establecimiento);
            $('#duracion').val(data.duracion);
            $('#fechaingreso').val(data.fingreso);
            $('#fechasalida').val(data.fsalida);
            $('#pidmunicipio option:selected').val(data.idmunicipio);
            $('#pidmunicipio option:selected').text(data.nombre);
            //$("#pidmunicipio").append(`<option value=${data.idmunicipio}> ${data.nombre} </option>`);
            $('#idnivel').val(data.idnivel);
            $('#periodo').val(data.periodo);

            $('#inputTitle').html("Modificar información academica");
            $('#formModal').modal('show');
            $('#btnGuardar').val('update');
            $('loading').modal('hide');
        });
    });

    $(document).on('click','.btn-delete-academico',function(){
        var idacad=$(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) {
            return false;
            }
            else {
                $.ajax({
                    type: "DELETE",
                    url: 'deleteacad/' + idacad,
                    success: function (data) {
                        console.log(data);
                        $("#academico" + idacad).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

        /*$.ajax({
            type: "DELETE",
            url: 'deleteacad/' + idacad,
            success: function (data) {
                console.log(data);
                $("#academico" + idacad).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });*/

        $("#erroresContentC").html(errHTML); 
        $('#erroresModalC').modal('show');
    });

    $("#btnGuardar").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var formData = {
            titulo: $("#titulo").val(),
            establecimiento: $("#establecimiento").val(),
            duracion: $("#duracion").val(),           
            fecha_ingreso: $("#fechaingreso").val(),
            fecha_salida : $("#fechasalida").val(),
            idmunicipio: $("#pidmunicipio").val(),
            idempleado: $("#idempleado").val(),
            identificacion: $("#identificacion").val(),
            idnivel: $("#idnivel").val(),
            periodo: $("#periodo").val(),
        };
            nivel=$("#idnivel option:selected").text();
        var state=$("#btnGuardar").val();

        var type;
        var idacad=$('#idacad').val();
        var my_url;

        if (state == "update") 
                {
                    type="PUT";
                    my_url = 'updateAca/'+idacad;
                }
        if (state == "add") 
                {
                    type="POST";
                    my_url = 'agregaracademico';
                }
        
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',

            success: function (data) {
                var item = '<tr class="even gradeA" id="academico'+data.idpacademico+'">';
                    item +='<td>'+data.titulo+'</td>'+'<td>' +data.establecimiento+ '</td>'+'<td>'+data.duracion+' '+data.periodo+'</td>'+'<td>'+nivel+'</td>'+'<td>'+data.fingreso+'</td>'+'<td>'+data.fsalida+'</td>';
                    item += '<td><button class="fa fa-pencil btn-editar-academico" value="'+data.idpacademico+'"></button>';
                    item += '<button class="fa fa-trash-o btn-delete-academico" value="'+data.idpacademico+'"></button></td></tr>';
                if (state == "add")
                {
                    $('#productsA').append(item);
                }
                if (state == "update")
                {
                    $("#academico"+idacad).replaceWith(item);
                }

                //document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +data.titulo+ "</td><td>" +data.establecimiento + "</td><td>" +data.duracion + ": " + data.periodo + "</td><td>" +nivel + "</td><td>" +fingreso + "</td><td>" +fsalida + "</td></tr>";
                $('#formAgregar').trigger("reset");
                $('#formModal').modal('hide');
                
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
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });
    });
});
