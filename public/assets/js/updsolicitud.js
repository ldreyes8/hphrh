$(document).ready(function(){
    $("#btnupsolicitud").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        
        var my_url='upsolicitud';
        var idpad=$('#idpad').val();
        alert(idpad);
        var formData = {
            //Datos persona
                identificacionup: $('#identificacionup').val(),
                nombre1: $('#nombre1').val(),
                nombre2: $('#nombre2').val(),
                apellido1: $('#apellido1').val(), 
                apellido2: $('#apellido2').val(),
                barriocolonia: $('#barriocolonia').val(),
                telefono: $('#telefono').val(),
                fechanac: $('#fechanac').val(),
            //Datos empleado
                idempleado: $('#idempleado').val(),
                nit: $('#nit').val(),
                dependientes: $('#dependientes').val(),
                iggs: $('#iggs').val(),
                aportemensual: $('#aportemensual').val(),
                vivienda: $('#vivienda').val(),
                alquilermensual: $('#alquilermensual').val(),
                otrosingresos: $('#otrosingresos').val(),
        }
        console.log(formData);
        $.ajax({
            type: "POST",
            url: my_url,
            data: formData,
            dataType: 'json',

            success: function (data) {
                swal({ 
                    title:"Envio correcto",
                    text: "Información actualizada correctamente",
                    type: "success"
                },
                function(){
                    //window.location.href="/empleado/solicitante"
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
            }
        });
        /*var i=0; //inicio del reccorido 
        $("#detallesPad .filaTable").each(function(){//se recorre la tabla 
            var id=$('.padRid:eq('+i+')').val();//se obtiene cada valor 
            var np=$('.padRn:eq('+i+')').val();
            i++;
            console.log(np,id);
            //alert(np);
        });*/
            
    });
});
