$(document).ready(function(){
$(".select2").select2();
    $(document).on('click','.btnpr',function(){
        var idper=$(this).val();
        var miurl="nombrelistr";
        $.get(miurl+'/'+ idper, function(data){
            $('#nombre').val(data.nombre1+' '+data.nombre2+' '+data.apellido1+' '+data.apellido2);
            $('#idempleado').val(data.idempleado);
        });
        $('#inputTitle').html("Cambiar de estado a Aspirante");
        $('#formAgregar').trigger("reset");
        $('#formModal').modal('show');
        $('#identificacion').val(idper);
  	});

    $(document).on('click','.btnGuardar',function(e){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var identi=$("#identificacion").val();       
        var formData ={
            empleado:$("#idempleado").val(),
            puesto:$("#puesto").val(),
            afiliado:$("#afiliado").val(),
        }
        $.ajax({
            type: "PUT",
            url: 'uprechazo/'+identi,
            data: formData,
            dataType: 'json',

            success: function (data) {
                swal({ 
                    title:"Envio correcto",
                    text: "Información actualizada correctamente",
                    type: "success"
                },
                function(){
                    window.location.href="/empleado/listado"
                });
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
                    errHTML+='<li>Error al borrar el &aacute;rea de atenci&oacute;n.</li>';
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });
    });
});