function cargaracademico(listado){
	$("#academicos").html($("#cargador_empresa").html());
    if(listado==1){var url = "verificar";}
    $.get(url,function(resul){
    $("#academicos").html(resul);
    });
}


$(document).ready(function(){
	$('#btnguardar').click(function(e){
        e.preventDefault();
        //Guardamos la referencia al formulario
        var $f = $(this);
        //Comprobamos si el semaforo esta en verde (1)
        if($f.data('locked') == undefined && !$f.data('locked'))
        {
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
                emisor: $("#emisor").val(), 
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


                beforeSend: function(){ $f.data('locked', true);  // (2)
                },

                success: function (data) {
              
                swal({
                    title:"Envio correcto",
                    text: "El permiso ha sido autorizado, se ha enviado un correo automaticamente al empleado",
                    type: "success"
                },
                function(){
                    window.location.href="/empleado/permisos"
                });
     
                    
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
                },
                complete: function(){ $f.data('locked', false);  // (3)
                }
            });
        }else{
            alert("se esta enviando su solicitud");
        }        
	});

    $('#btnguardarv').click(function(e){
        e.preventDefault();
        var $f = $(this);

        if($f.data('locked') == undefined && !$f.data('locked'))
        {
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

                beforeSend: function(){ $f.data('locked', true);  // (2)
                },
                success: function (data) {
                    swal({
                    title:"Envio correcto",
                    text: "La vacaciones ha sido autorizado, se ha enviado un correo automaticamente al empleado",
                    type: "success"
                },
                function(){
                    window.location.href="/empleado/vsolicitado";
                });
                   
                    //window.location.replace("vsolicitado");
            
                    //$("#conte").hide();
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
                },
                complete: function(){ $f.data('locked', false);  // (3)
                }
            });
        }else{
            alert("se esta enviando su solicitud");
        }
        
    });

    $('#btneditar').click(function(e){
        $("#oculto").show();
    });

    ////
    ////
    $('#btnconfirmarv').click(function(e){
        e.preventDefault();
        var $f = $(this);

        if($f.data('locked') == undefined && !$f.data('locked'))
        {
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

                beforeSend: function(){ $f.data('locked', true);  // (2)
                },

                success: function (data) {
                swal({
                    title:"Envio correcto",
                    text: "La vacaciones han sido confirmadas, se ha enviado un correo automaticamente al empleado",
                    type: "success"
                },
                function(){
                    window.location.href="/empleado/vautorizado";
                }); 
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
                ,
                complete: function(){ $f.data('locked', false);  // (3)
                }
            });
        }else{
            alert("se esta enviando su solicitud");
        }
    });

});