$(function(){
            $("#form").submit(function(e){
                var fields = $(this).serialize();

                $.post("{{url('persona')}}", fields, function(data){

                    if(data.valid !== undefined){
                        $("#result").html("Gracias, sus datos fueron enviados correctamente");
                        $("#form")[0].reset();
                        $("#error_identi").html('');
                        $("#error_n1").html('');
                    }
                    else{
                        $("#error_identi").html('');
                        $("#error_n1").html('');
                        if (data.identificacion !== undefined){
                            $("#error_identi").html(data.identificacion); 
                        }
                        if (data.nombre1 !== undefined){
                            $("#error_n1").html(data.nombre1);
                        }
                    }
                    var errHTML="";
                 
                

                    if(typeof data.error != 'undefined')
                    {
                        for(e in data.error){
                            errHTML+=data.error[e];
                            //$("#result").html("la fecha inicio no puede ser mayor a la fecha final");
                    }
                    
                    $("#erroresContent").html(errHTML);
                     $('#erroresModal').modal('show');
                }
                      
                });

                return false;
            });
        });        