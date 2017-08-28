$(document).ready(function(){

    //Calculo de vacaciones de un empleado
        $(document).on('click','.btn-vacaciones',function(){
            var errHTML="";
            idempleado=$(this).val();
            $.get('empleados/calculardias/'+idempleado,function(data){
               
                var horas = '';
                var dias = '';
                var tdh;

                $.each(data,function(){
                    horas = data[0];
                    dias = data[1];
                    autorizacion = data[2];
                })

                $('#inputTitle').html("Saldo de vacaciones");
                $('#formAgregar').trigger("reset");
                $('#formModal').modal('show');
                $('#datomar').attr('disabled', 'disabled');
                $('#hhoras').attr('disabled', 'disabled');
                $('#dacumulado').attr('disabled', 'disabled');
                $('#btnguardarV').attr('disabled', 'disabled'); 

                tdh = (dias + ' ' + 'dias' + ' ' + 'con' +' '+ horas +' '+ 'horas');
                document.getElementById('dacumulado').value = tdh;
                document.getElementById('tdias').value = dias;
                document.getElementById('thoras').value = horas;
                
            });
        });

    //Despido de un empleado

        $(document).on('click','.btn-despedir',function(){
            var errHTML="";
            idempleado=$(this).val();

                $.get('personabaja/'+idempleado,function(data){
                   
                    var nombre1 = '';
                    var nombre2 = '';
                    var nombre3 = '';
                    var apellido1 = '';
                    var apellido2 = '';
                    var apellido3 = '';

                    var NC = "";

                    $('#inputTitleDespedir').html("Formulario de despidos");
                    $('#formDespedir').trigger("reset");
                    $('#formModalDespedir').modal('show');

                    if (data.nombre2 == null)
                    {
                        data.nombre2 = '';
                    }

                    if (data.nombre3 == null)
                    {
                        data.nombre3 = '';
                    }

                     if (data.apellido2 == null)
                    {
                        data.apellido2 = '';
                    }

                    if (data.apellido3 == null)
                    {
                        data.apellido3 = '';
                    }

                    NC = (data.nombre1 + ' ' +data.nombre2 + ' ' +data.nombre3 + ' ' +data.apellido1 + ' ' +data.apellido2 + ' ' +data.apellido3);

                    document.getElementById('idE').value = idempleado;
                    document.getElementById('nombreC').value = NC;
                    document.getElementById('idemple').value = data.idempleado;
                    document.getElementById('identifica').value = data.identificacion;
                });
               
        });

        $(document).on('click','.btn-adddespedir',function(e){

            swal({
                title: "¿Esta seguro de despedir a esta persona?",
                text: "No podrá revertir este cambio",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                confirmButtonText: "Si, despedir",
                closeOnConfirm: false
            }, 

            function () {
                var idEP=$("#idE").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                var formData = {
                    idempleado: $("#idemple").val(),
                    identificacion: $("#identifica").val(),
                    fecha_despido: $("#fecha_inicio").val(),           
                    motivo: $("#idstatus option:selected").text(),
                    observaciones : $("#observaciones").val(),
                    idstatus: $("#idstatus").val(),
                };

                var state=$("#btnGuardarBaja").val();

                var type;
                var my_url;

                type="POST";
                my_url = 'addbaja';

                $.ajax({
                    type: type,
                    url: my_url,
                    data: formData,
                    dataType: 'json',

                    success: function (data) {
                        
                        swal({
                          title:"Envio correcto",
                          text: "Se ha despedido al empleado correctamente",
                          type: "success",
                        });

                        $("#empleado" + idEP).remove();
                        $('#formDespedir').trigger("reset");
                        $('#formModalDespedir').modal('hide');

                        
                    },
                    error: function (data) {
                        $('#loading').modal('hide');
                        var errHTML="";
                        if((typeof data.responseJSON != 'undefined')){
                            for( var er in data.responseJSON){
                                errHTML+="<li>"+data.responseJSON[er]+"</li>";
                            }
                        }else{
                            errHTML+='<li>Error</li>';
                        }
                        $("#erroresContent").html(errHTML); 
                        $('#erroresModal').modal('show');
                    }
                });
            });           
        });
});


