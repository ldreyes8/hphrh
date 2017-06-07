$(document).ready(function(){
    $("#btnupsolicitud").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var my_url=;

        var formData = {
            identificacionup: $('#identificacionup').val(),
            barriocolonia: $('#barriocolonia').val(),
            telefono: $('#telefono').val(),
        }
        console.log(formData);
        $.ajax({
            type: "PUT",
            url: my_url,
            data: formData(identificacionup),
            dataType: 'json',

            success: function (data) {
    
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
