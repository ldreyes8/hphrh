function cargarfamilia(listado){
    
    $("#familiares").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarfamilia";}
    $.get(url,function(resul){
    $("#familiares").html(resul);
    });
    
}

$(document).ready(function(){
   	$('#btnAgregarF').click(function(){
        
    	$('#inputTitleF').html("Agregar información familiar");
    	$('#formAgregarF').trigger("reset");
        $('#btnGuardarF').val('add');
    	$('#formModalF').modal('show');
	});

    $(document).on('click','.btn-editar-familia',function(){
        var idfam=$(this).val();
        var miurl="listarfamilia1";
        $.get(miurl+'/'+ idfam,function(data){
            console.log(data);
            $('#idfam').val(data.idpfamilia);
            $('#nombref').val(data.nombref);
            $('#apellidof').val(data.apellidof);
            $('#parentezco').val(data.parentezco);
            $('#edad').val(data.edad);
            $('#ocupacion').val(data.ocupacion);
            $('#emergencia').val(data.emergencia);
            $('#telefonof').val(data.telefonof);

            $('#inputTitleF').html("Modificar información familiar");
            $('#formModalF').modal('show');
            $('#btnGuardarF').val('update');
            $('loading').modal('hide');
        });

    });
    
    $(document).on('click','.btn-delete-familia',function(){
        var idfam=$(this).val();
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
                    url: 'deletefam/' + idfam,
                    success: function (data) {
                        console.log(data);
                        $("#fam" + idfam).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

        /*$.ajax({
            type: "DELETE",
            url: 'deletefam/' + idfam,
            success: function (data) {
                console.log(data);
                $("#fam" + idfam).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });*/

            $("#erroresContentF").html(errHTML); 
            $('#erroresModalF').modal('show');
        });
    
    $("#btnGuardarF").click(function(e){
        //var miurl="agregarfamiliar";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        if($('#emergencia').is(':checked'))
        {
            emer = "Si";
        }
        else
        {
            emer = "No";
        }

        var formData = {
            nombre: $("#nombref").val(),
            apellido: $("#apellidof").val(),
            parentezco: $("#parentezco").val(),           
            edad: $("#edad").val(),
            ocupacion : $("#ocupacion").val(),
            idempleado: $("#idempleado").val(),
            identificacion: $("#identificacion").val(),
            emergencia :emer,
            telefonof: $("#telefonof").val(),

        };
        
        var state=$("#btnGuardarF").val();

        var type;
        var idfam=$('#idfam').val();
        var my_url;

        if (state == "update") 
                {
                    type="PUT";
                    my_url = 'updatefam/'+idfam;
                }
        if (state == "add") 
                {   
                    type="POST";
                    my_url = 'agregarfamiliar';
                }

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',

            success: function (data) {
                var item = '<tr class="even gradeA" id="fam'+data.idpfamilia+'">';
                    item += '<td>'+data.parentezco+'</td>'+'<td>'+data.nombref+' '+data.apellidof+'</td>'+'<td>'+data.ocupacion+'</td>'+'<td>'+data.edad+'</td>'+'<td>'+data.telefonof+'</td>'+'<td>'+data.emergencia+'</td>';
                    item += '<td><button class="fa fa-pencil btn-editar-familia" value="'+data.idpfamilia+'"></button>';
                    item += '<button class="fa fa-trash-o btn-delete-familia" value="'+data.idpfamilia+'"></button></td></tr>';
                if (state == "add")
                {
                    $('#productsF').append(item);
                }
                if (state == "update")
                {
                    $("#fam"+idfam).replaceWith(item);
                }

                //document.getElementById("dataTablefamilia").innerHTML += "<tr class='fila'><td>" +data.parentezco+ "</td><td>" +nombref + " " + apellidof + "</td><td>" +data.ocupacion + "</td><td>" +data.edad + "</td><td>" +data.telefonof + "</td><td>" +data.emergencia + "</td></tr>";
                $('#formAgregarF').trigger("reset");
                $('#formModalF').modal('hide');
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
                $("#erroresContentF").html(errHTML); 
                $('#erroresModalF').modal('show');
            }
        });
    });

});