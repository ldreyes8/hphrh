function cargar_formularioviaje(arg){
  var urlraiz=$("#url_raiz_proyecto").val();

   $("#capa_modal").show();
   $("#capa_formularios").show();
   var screenTop = $(document).scrollTop();
   $("#capa_formularios").css('top', screenTop);
   $("#capa_formularios").html($("#cargador_empresa").html());
   //if(arg==1){ var miurl=urlraiz+"/form_nuevo_usuario"; }
   if(arg==1){ var miurl=urlraiz+"/empleado/viaje/solicitar"; }
   if(arg==2){ var miurl=urlraiz+"/empleado/viaje/liquidar"; }
   if(arg==3){ var miurl=urlraiz+"/empleado/viaje/add"; }
   //Listado de Jefe Inmediato Autorizaciones Vacacioens Y permisos

   if(arg==4){ var miurl=urlraiz+"/empleado/vautorizadopv"; }

   if(arg==20){ var miurl=urlraiz+"/ji/viajejf/solicitados"; }
   if(arg==21){ var miurl=urlraiz+"/ji/viajejf/autorizados"; }
   if(arg==22){ var miurl=urlraiz+"/ji/viajejf/detalleauto"; }
 
    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
    	$("#capa_formularios").html(resul);
    }).fail( function() 
    {
    	$("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });
}




$(document).on("click",".pagination li a",function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    $("#pvsolicitados").html($("#cargador_empresa").html());

    $.get(url,function(resul){
        $("#pvsolicitados").html(resul);  
    })
});


$(document).on('click','.btn-SolViaje',function(e){
    $('#inputTitleViaje').html("Solicitud de viaje");
    $('#formAgregarViaje').trigger("reset");
    $('#formModal').modal("show");

}); 

$(document).on('click','.btn-addviaje',function(e){
    e.preventDefault();
    var $f = $(this);

    if($f.data('locked') == undefined && !$f.data('locked'))
    {
        var resdeposito="ninguno";
        var resvehiculo="ninguno";

        var miurl="vacaciones/update";

        var deposito=document.getElementsByName("deposito");
        var solicitarveh=document.getElementsByName("hvehiculo");

        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<deposito.length;i++)
        {
            if(deposito[i].checked)
            resdeposito=deposito[i].value;
        }

        for(var i=0;i<solicitarveh.length;i++)
        {
            if(solicitarveh[i].checked)
            resvehiculo=solicitarveh[i].value;
        }
        
        var formData = {
            idproyecto: $('#idproyecto').val(),
            monto_solicitado: $('#monto').val(),
            cheque_o_transferencia: resdeposito,
            moneda :$('#moneda').val(),
            fecha_inicio: $('#fecha_inicio').val(),
            fecha_final: $('#fecha_final').val(),
            motivo: $('#motivo').val(),
            vehiculo: $('#idvehiculo').val(),
            kilometraje_inicial: $('#kinicial').val(),
            kilometraje_final: $('#kfinal').val(),
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
                //document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +hoy+ "</td><td>" +finicio + "</td><td>" +ffin  + "</td><td>" + td + "</td><td>" +th +"</td><td>" +"solicitado"+ "</td></tr>";
                $('#formGoce').modal('hide');
                swal({
                    title:"Envio correcto",
                    text: "La solicitud ha sido enviada correctamente",
                    type: "success",
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
                    errHTML+='<li>Error.</li>';
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            },
            complete: function(){ $f.data('locked', false);  // (3)
            }
        });
    }else{
        swal({
            title:"Envio en espera",
            text: "Se esta enviando su solicitud :)",
            type: "warning",
        });
    }
});


