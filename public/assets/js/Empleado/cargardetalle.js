$('#cancelarmov').click(function(e) {
    var idgcabeza=$(this).val();

    e.preventDefault();
    var $f = $(this);

    if($f.data('locked') == undefined && !$f.data('locked'))
    {

        swal({
            title: "¿Estás seguro?",
            text: "No podrás modificar el registro",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FFFF00",
            confirmButtonText: "Si, enviarlo",
            cancelButtonText: "No, cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                var urlraiz=$("#url_raiz_proyecto").val();
                var miurl = urlraiz+"/empleado/viaje/liquidar/cancelar";

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                var formData = {
                    gasto_encabezado: idgcabeza,
                };

                $.ajax({
                    type: "POST",
                    url: miurl,
                    data: formData,
                    dataType: 'json',

                    success: function (data) {
                        $f.data('locked', true);

                        swal({ 
                            title:"Enviado",
                            text: "el registro ha sido enviado correctamente",
                            type: "success",
                            confirmButtonClass: 'btn-success waves-effect waves-light',
                            confirmButtonText: 'OK!'
                        },
                        function(){
                            cargar_formularioviaje(2);
                        });
                        $f.data('locked',false);
                        
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
                });
            } else {
                swal("Cancelado", "No se ha enviado el registro :)", "error");
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


function detalleavance(arg,id)
{
    var urlraiz=$("#url_raiz_proyecto").val();
    $("#capa_modal").html($("#cargador_empresa").html());
    if(arg==1){var miurl =urlraiz+"/empleado/viaje/detallehistorial/"+id;}
    if(arg==2){var miurl =urlraiz+"/empleado/viaje/detalleavance/"+id;}
    if(arg==4){var miurl =urlraiz+"/asistente/cajachica/"+id;}

    $.ajax({
        url: miurl
    }).done( function(resul) 
    {
        $("#SviajeE").html(resul);
    }).fail( function() 
    {
        $("#SviajeE").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });

}