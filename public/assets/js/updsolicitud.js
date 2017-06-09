$(document).ready(function(){
    $("#btnupsolicitud").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        
        var my_url='upsolicitud';
        var tabla=$("#detallesPad .filaTable");
        /*var idpad=$('#idpads').val();
        alert(idpad);*/
        var i=0; //inicio del reccorido 
        tabla.each(function(){//se recorre la tabla 
            var idpad=$('.idpad:eq('+i+')').val();//se obtiene cada valor 
            var np=$('.nombrepa:eq('+i+')').val();
            $.post(my_url,
            {
                idpad: idpad,
                np: np
            },
            function(data){});
            i++;
            console.log(np,idpad);
            //alert(np);
        });

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
            //Datos padecimientos
                /*idpad: idpad,
                nombrepa: np,*/

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
        
            
    });
});
