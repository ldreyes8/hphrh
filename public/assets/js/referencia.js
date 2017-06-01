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
            $('#btnGuardarR').val('add');
        	$('#formModalR').modal('show');
    	});

        $(document).on('click','.btn-editar-referencia',function(){
            var idref=$(this).val();
            var miurl="listarreferencia1";
            $.get(miurl+'/'+ idref,function(data){
                console.log(data);
                $('#idref').val(data.idpreferencia);
                $('#nombre').val(data.nombrer);
                $('#telefono').val(data.telefonor);
                $('#profesion').val(data.profesion);
                $('#tiporeferencia').val(data.tiporeferencia);
                $('#inputTitleR').html("Modificar referencias");
                $('#formModalR').modal('show');
                $('#btnGuardarR').val('update');
                $('loading').modal('hide');
            });
        });
        $(document).on('click','.btn-delete-referencia',function(){
            var idref=$(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: 'deleteref/' + idref,
                success: function (data) {
                    console.log(data);
                    $("#referencia" + idref).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

            $("#erroresContentR").html(errHTML); 
            $('#erroresModalR').modal('show');
        });

    });
    $("#btnGuardarR").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var formData = {
            nombre: $("#nombre").val(),
            telefono: $("#telefono").val(),
            profesion: $("#profesion").val(),           
            tiporeferencia: $("#tiporeferencia").val(),
            idempleado: $("#idempleado").val(),
            identificacion: $("#identificacion").val(),
        };

        var state=$("#btnGuardarR").val();
        //alert(state);
        //var miurl="agregarreferencia";
        var type;
        var idref=$('#idref').val();
        var my_url;

        if (state == "update") 
                {
                    type="PUT";
                    my_url = 'updateref/'+idref;
                }
        if (state == "add") 
                {
                    type="POST";
                    my_url = 'agregarreferencia';
                }
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',

            success: function (data) {
                var item = '<tr class="even gradeA" id="referencia'+data.idpreferencia+'">';
                    item += '<td>'+data.nombrer+'</td>'+'<td>' +data.telefonor+ '</td>'+'<td>'+data.profesion+'</td>'+'<td>'+data.tiporeferencia+'</td>';
                    item += '<td><button class="fa fa-pencil btn-editar-referencia" value="'+data.idpreferencia+'"></button>';
                    item += '<button class="fa fa-trash-o btn-delete-referencia" value="'+data.idpreferencia+'"></button></td></tr>';
                if (state == "add")
                {
                    $('#products-list').append(item);
                }
                if (state == "update")
                {
                    $("#referencia"+idref).replaceWith(item);
                }
                    //document.getElementById("dataTableItemsR").innerHTML += "<tr class='fila'><td>" +data.nombrer+ "</td><td>" +data.telefonor + "</td><td>" +data.profesion + "</td><td><button value=" + data.tiporeferencia + " class='fa fa-pencil btn-editar-referencia'></button> <button class='fa fa-trash-o'></button></td></tr>";
                $('#formAgregarR').trigger("reset");
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
