
function cargaracademico(listado){
	$("#academicos").html($("#cargador_empresa").html());
    if(listado==1){var url = "listaracademico";}
    $.get(url,function(resul){
    $("#academicos").html(resul);
    });
}

   	$('#btnAgregar').click(function(){
    	$('#inputTitle').html("Agregar informacion academico");
    	$('#formAgregar').trigger("reset");
    	$('#inRol').val(0);
    	$('#inPuesto').val(0);
    	$('#btnGuardar').val('add');
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
