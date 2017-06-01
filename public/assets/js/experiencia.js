function cargarexperiencia(listado){
	$("#experiencias").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarexperiencia";}
    $.get(url,function(resul){
    $("#experiencias").html(resul);
    });
}

$(document).ready(function(){
   	$('#btnAgregarE').click(function(){
    	$('#inputTitleE').html("Agregar Experiencia");
    	$('#formAgregarE').trigger("reset");
        $('#btnGuardarE').val('add');
    	$('#formModalE').modal('show');
	});

    $(document).on('click','.btn-editar-experiencia',function(){
        var idex=$(this).val();
        var miurl="listarexperiencia1";
        $.get(miurl+'/'+ idex,function(data){
            console.log(data);
            $('#idex').val(data.idpexperiencia);
            $('#empresa').val(data.empresa);
            $('#puesto').val(data.puesto);
            $('#jefeinmediato').val(data.jefeinmediato);
            $('#motivoretiro').val(data.motivoretiro);
            $('#ultimosalario').val(data.ultimosalario);
            $('#año_ingreso').val(data.fingresoex);
            $('#año_salida').val(data.fsalidaex);

            $('#inputTitleE').html("Modificar experiencias");
            $('#formModalE').modal('show');
            $('#btnGuardarE').val('update');
            $('loading').modal('hide');
        });
    });

    $(document).on('click','.btn-delete-experiencia',function(){
        var idex=$(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "DELETE",
            url: 'deletexp/' + idex,
            success: function (data) {
                console.log(data);
                $("#experiencia" + idex).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

        $("#erroresContentE").html(errHTML); 
        $('#erroresModalE').modal('show');
    });

    $("#btnGuardarE").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

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
        var state=$("#btnGuardarE").val();

        var type;
        var idex=$('#idex').val();
        var my_url;

        if (state == "update") 
                {
                    type="PUT";
                    my_url = 'updatexp/'+idex;
                }
        if (state == "add") 
                {
                    type="POST";
                    my_url = 'agregarexperiencia';
                }

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',

            success: function (data) {
                var item = '<tr class="even gradeA" id="experiencia'+data.idpexperiencia+'">';
                    item += '<td>'+data.empresa+'</td>'+'<td>' +data.puesto+ '</td>'+'<td>'+data.jefeinmediato+'</td>'+'<td>'+data.motivoretiro+'</td>'+'<td>'+data.ultimosalario+'</td>'+'<td>'+data.fingresoex+'</td>'+'<td>'+data.fsalidaex+'</td>';
                    item += '<td><button class="fa fa-pencil btn-editar-experiencia" value="'+data.idpexperiencia+'"></button>';
                    item += '<button class="fa fa-trash-o btn-delete-experiencia" value="'+data.idpexperiencia+'"></button></td></tr>';
                if (state == "add")
                {
                    $('#products').append(item);
                }
                if (state == "update")
                {
                    $("#experiencia"+idex).replaceWith(item);
                }
              //document.getElementById("dataTableItemsE").innerHTML += "<tr class='fila'><td>" +data.empresa+ "</td><td>"+data.puesto+"</td><td>"+data.jefeinmediato+"</td><td>"+data.motivoretiro+"</td><td>"+data.ultimosalario+"</td><td>"+añoi+"</td><td>"+añof+"</td></tr>";
                $('#formAgregarE').trigger("reset");
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
