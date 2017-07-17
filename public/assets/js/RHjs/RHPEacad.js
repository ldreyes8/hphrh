$(document).ready(function(){
   	$('#btnAgregar').click(function(){
    	$('#inputTitle').html("Agregar información académica adicional.");
    	$('#formAgregar').trigger("reset");
    	$('#formModal').modal('show');
	});

    $("#iddepartamento1").change(event => {
        $.get(`towns/${event.target.value}`, function(res, sta){
            $("#pidmunicipio").empty();
                res.forEach(element => {
                    $("#pidmunicipio").append(`<option value=${element.idmunicipio}> ${element.nombre} </option>`);
                });
            });
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
            idpais: $('#idpaisPA').val(),
        };
            nivel=$("#idnivel option:selected").text();
        var state=$("#btnGuardar").val();

        var type;
        var idacad=$('#idacad').val();
        var my_url;

        type="POST";
        my_url = 'adicionalacad';
        var fingreso12=$("#fechaingreso").val();
        var fsalida12=$("#fechasalida").val();

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',

            success: function (data) {
                var item = '<tr class="even gradeA" id="academico'+data.idpacademico+'">';
                    item +='<td>'+data.titulo+'</td>'+'<td>' +data.establecimiento+ '</td>'+'<td>'+data.duracion+' '+data.periodo+'</td>'+'<td>'+nivel+'</td>'+'<td>'+fingreso12+'</td>'+'<td>'+fsalida12+'</td>';

                    $('#productsA').append(item);

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
                    errHTML+='<li>Error</li>';
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });
    });
});
