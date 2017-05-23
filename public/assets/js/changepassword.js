 $("#btnchangepassword").click(function(e){
        var miurl="cambiar_password";


        var formData = {
            password: $("#password").val(),
            email: $("#email").val(),
            idusuario: $("#id").val(),
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
                
                window.location.href = "logout";
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

                $("#erroresContentPassword").html(errHTML); 
                $('#erroresModalPassword').modal('show');

            }
        });
    });