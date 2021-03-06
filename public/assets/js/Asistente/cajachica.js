$('#btnGuardarAperturaC').click(function(e) {
    e.preventDefault();
    var $f = $(this);

    if($f.data('locked') == undefined && !$f.data('locked'))
    {
        var urlraiz=$("#url_raiz_proyecto").val();

        var resdeposito="ninguno";
        var resvehiculo="ninguno";
        var itemsData=[];

        var miurl=urlraiz+"/asistente/cajachica/store";

        var deposito=document.getElementsByName("deposito");
        var solicitarveh=document.getElementsByName("hvehiculo");

        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<deposito.length;i++)
        {
            if(deposito[i].checked)
            resdeposito=deposito[i].value;
        }
        
        var formData = {
            proyecto: $('#idproyecto').val(),
            monto_solicitado: $('#monto').val(),
            cheque_o_transferencia: resdeposito,
            moneda :$('#moneda').val(),
            fecha_inicio: $('#fecha_inicio').val(),
            fecha_final: $('#fecha_final').val(),
            motivo: $('#motivo').val(),
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
                $f.data('locked', true);

                swal({
                    title:"Envio correcto",
                    text: "La solicitud ha sido enviada correctamente",
                    type: "success",
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
                $("#inputError").html('error');
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            },
        });
    }else{
        swal({
            title:"Envio en espera",
            text: "Se esta enviando su solicitud :)",
            type: "warning",
        });
    }
});

$(document).on('click','.btn-cancelviaje',function(e){
    e.preventDefault();
    swal({
        title: "¿Esta seguro?",
        text: "Retornara a la pagina principal",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FFFF00",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            swal({ 
                title:"Gracias",
                text: "Solicitud cancelada",
                type: "success",
                confirmButtonClass: 'btn-success waves-effect waves-light',
                confirmButtonText: 'OK!'
            },
            function(){
                cargar_formularioviaje(0);
            });
        }else {
            swal("Cancelado", " :)", "error");
        }
    });    
});