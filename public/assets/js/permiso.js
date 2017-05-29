function cargaracademico(listado){
	$("#academicos").html($("#cargador_empresa").html());
    if(listado==1){var url = "verificar";}
    $.get(url,function(resul){
    $("#academicos").html(resul);
    });
}


$(document).ready(function(){
	$('#btnguardar').click(function(e){
		var miurl = "enviarpermiso";
		nivel = $("#emisor").val();


		var resultado="ninguno";

        var porNombre=document.getElementsByName("autorizacion");

        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<porNombre.length;i++)
        {
        	if(porNombre[i].checked)
        		resultado=porNombre[i].value;
        }

		var formData = {
			observaciones :$("#observaciones").val(),
			autorizacion: resultado,
			receptor: $("#receptor").val(),
			idausencia: $("#idausencia").val(),
			name: $("#name").val(),
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
                //console.log(formData.txtmail);
  $("#doculto").hide();                 //document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +data.titulo+ "</td><td>" +data.establecimiento + "</td><td>" +data.duracion + ": " + data.periodo + "</td><td>" +nivel + "</td><td>" +fingreso + "</td><td>" +fsalida + "</td></tr>";    
                //$('#formModal').modal('hide'); 
                
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

    $('#btnguardarv').click(function(e){
        var miurl = "enviarvacaciones";
        nivel = $("#emisor").val();


        var resultado="ninguno";

        var porNombre=document.getElementsByName("autorizacion");

        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                resultado=porNombre[i].value;
        }

        var formData = {
            observaciones :$("#observaciones").val(),
            autorizacion: resultado,
            receptor: $("#receptor").val(),
            idausencia: $("#idausencia").val(),
            name: $("#name").val(),
            idempleado: $("#idempleado").val(),
            hatomar: $("#hatomar").val(),
            datomar: $("#datomar").val(),
            hdisponible: $("#hdisponible").val(),
            ddisponible: $("#ddisponible").val(),
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
                $("#conte").hide();
                //document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +data.titulo+ "</td><td>" +data.establecimiento + "</td><td>" +data.duracion + ": " + data.periodo + "</td><td>" +nivel + "</td><td>" +fingreso + "</td><td>" +fsalida + "</td></tr>";    
                //$('#formModal').modal('hide');
                
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

    $('#btneditar').click(function(e){
        $("#oculto").show();
    });

    $('#btnconfirmarv').click(function(e){
        var miurl = "enviarconfirmacion";
        nivel = $("#emisor").val();


        var resultado="ninguno";

        var porNombre=document.getElementsByName("autorizacion");

        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                resultado=porNombre[i].value;
        }

        var formData = {
            observaciones :$("#observaciones").val(),
            autorizacion: resultado,
            receptor: $("#receptor").val(),
            idausencia: $("#idausencia").val(),
            name: $("#name").val(),
            idempleado: $("#idempleado").val(),
            idvacadetalle: $("#idvacadetalle").val(),
            solhoras: $("#hhoras").val(),
            soldias: $("#dnotomado").val(),
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
                console.log(formData.txtmail);
                
        $("#botones").hide();
        $("#edit").hide(); 
                //document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +data.titulo+ "</td><td>" +data.establecimiento + "</td><td>" +data.duracion + ": " + data.periodo + "</td><td>" +nivel + "</td><td>" +fingreso + "</td><td>" +fsalida + "</td></tr>";    
                //$('#formModal').modal('hide');
                
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