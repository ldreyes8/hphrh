$(document).ready(function() {
    $(".select2").select2();
    $("#btnguardar").hide();
    $("#btncancelar").hide();
});

var cont=0;

$("#btnguardar").hide();
$("#btncancelar").hide();

function valida(e){
    tecla = e.keyCode || e.which;
    tecla_final = String.fromCharCode(tecla);
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8 || tecla==37 || tecla==39 ||tecla==46 ||tecla==9)
    {
        return true;
    } 
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    //patron =/^\d{9}$/;
    return patron.test(tecla_final);
}
            
var contJI=0;
function limpiar()
{
    $("#confirma").attr('checked',false);
}
function AsignajefeAsecenso()
{
    confirma=$("#confirma").val();
    jefeTex=$("#jefe option:selected").text();
    idjefe=$("#jefe").val();
    no=("No");
    si=("Si");
    if (idjefe !="") 
    {
        if($('#confirma').is(':checked'))
        { 
            var fila='<tr class="selected" id="fila'+contJI+'">';
            fila += '<td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminar('+contJI+');">X</button></td>';
            fila += '<td><input type="hidden" name="idjefes" value="'+idjefe+'">'+jefeTex+'</td>';
            fila += '<td>'+idjefe+'</td>';
            fila += '<td>'+si+'</td> </tr>';
            contJI++;
            $('#detalle7').append(fila);
            limpiar();
        }
        else
        {
            var fila='<tr class="selected" id="fila'+contJI+'">';
            fila += '<td><button type="button" style="background-color:#E6E6E6"  class="btn " onclick="eliminar('+contJI+');">X</button></td>';
            fila += '<td><input type="hidden" name="idjefes" value="'+idjefe+'">'+jefeTex+'</td>';
            fila += '<td>'+idjefe+'</td>';
            fila += '<td>'+no+'</td> </tr>';
            contJI++;
            $('#detalle7').append(fila);
        }
        cont++;
        evaluar();
    }
    else
    {
        alert('Existen campos obligatorios');
    }
}

function evaluar(){
    if (cont>0){
        $("#btnguardar").show();
        //$("#btncancelar").show();
    }
    else{
        $("#btnguardar").hide(); 
        $("#btncancelar").hide();
    }
}

function eliminar(index)
{
    $("#fila" + index).remove();
    cont = cont -1;
    console.log(cont);
    console.log(index);
    evaluar();
}

function asignar_jefeinmediato(idempleado){
    var identificacion=$("#jefe1").val();
    var notifica = $("#confirma1").val();
    var urlraiz=$("#url_raiz_proyecto").val();
    
    if($('#confirma1').is(':checked'))
    {
        notifica = "Si";
    }
    else{
        notifica = "No";
    }
    $("#zona_etiquetas_nombramiento").html($("#cargador_empresa").html());
    var miurl=urlraiz+"/empleado/asignar_jefeinmediato/"+idempleado+"/"+identificacion+"/"+notifica+""; 
    $.ajax({
        url: miurl
    }).done( function(resul) 
    { 
        var etiquetas="";
        $.each(roles,function(index, value) {
            console.log(resul);
            etiquetas+= '<span class="label label-warning">'+value+'</span> ';
        })
        $("#zona_etiquetas_nombramiento").html(etiquetas);
    }).fail( function() 
    {
        $("#zona_etiquetas_nombramiento").html('<span style="color:red;">...Error: Aun no ha agregado roles o revise su conexion...</span>');
    });
}

function quitar_jefeinmediato(idempleado){
    var identificacion=$("#jefe2").val();
    var urlraiz=$("#url_raiz_proyecto").val();
    $("#zona_etiquetas_nombramiento").html($("#cargador_empresa").html());
    var miurl=urlraiz+"/empleado/quitar_jefeinmediato/"+idempleado+"/"+identificacion+""; 

    $.ajax({
        url: miurl
    }).done( function(resul) 
    { 
        var etiquetas="";
        var roles=$.parseJSON(resul);
        $.each(roles,function(index, value) {
            etiquetas+= '<span class="label label-warning" style="margin-left:10px;" >'+value+'</span> ';
        })
        $("#zona_etiquetas_nombramiento").html(etiquetas);
    }).fail( function() 
    {
        $("#zona_etiquetas_nombramiento").html('<span style="color:red;">...Error: Aun no ha agregado roles  o revise su conexion...</span>');
    });
}

$(document).on('click','.btn-guardarAsecenso',function(e){
    swal({
        title: "¿Estás seguro?",
        text: "No podrás eliminar este registro",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FFFF00",
        confirmButtonText: "Si, enviar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            var itemsData=[];
            var miurl = "addasecenso";
                        
            $('#detalle7 tr').each(function(){
                var jefe = $(this).find('td').eq(2).html();
                var notificar = $(this).find('td').eq(3).html();
                valor = new Array(jefe,notificar);
                itemsData.push(valor);
            });

            var formData = {
                idpuesto: $('#idpuesto').val(),
                idempleado: $('#idempleado').val(),
                fecha: $('#dato1').val(),
                salario: $('#salario').val(),
                descripcion: $('#descripcion').val(),
                idafiliado: $('#idafiliado').val(),
                idcaso: $('#idcaso').val(),
                mjf: $("#mji").val(),
                items: itemsData,
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
                //beforeSend: function(){ $f.data('locked', true);  // (2)
                //},

                success: function (data) {
                    swal({ 
                        title:"Envio correcto",
                        text: "Gracias",
                        type: "success"
                    },
                    function(){
                        window.location.href="/empleado/listado"
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
                        errHTML+='<li>Error...</li>';
                    }
                    swal({ 
                        title:"Ups error",
                        text: "Verifique campos",
                        type: "error",
                        confirmButtonClass: 'btn-danger waves-effect waves-light',
                        confirmButtonText: 'OK!'
                    },
                    function(){
                        $("#erroresContent").html(errHTML); 
                        $('#erroresModal').modal('show');
                    });    
                },
                //complete: function(){ $f.data('locked', false);  // (3)
                 //}
            }); 
        }else {
            swal("Cancelado", "No se ha guardado el registro :)", "error");
        }
    });                            
});

$(document).on('click','.btn-cancelarAsecenso',function(e){
    document.getElementById("inlineRadio1").checked = false;
    document.getElementById("inlineRadio16").checked = false;
    //var yea=document.getElementById("detalle7").rows.length;
    var tam = cont - 1;
    for (var i = Things.length - 1; i >= 0; i--) {
        Things[i]
    }
    cont = cont -1;
});

$(document).on('click','.btn-aceptar',function(e){
    
    var miurl = "puestoupdate";
    var status = "Autorizado";
    var idvacante =$(this).val();

    var formData = {
        idvacante: $('#idvacante').val(),
        idvacante: idvacante,
        status: status,
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: "PUT",
        url: miurl,
        data: formData,
        dataType: 'json',
    
        success: function (data) {
            swal({ 
                title:"Envio correcto",
                text: "Gracias",
                type: "success"
                },

            );
            $("#vacante" + idvacante).remove();
                                
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
            },
        });             
    });

$(document).on('click','.btn-rechazar',function(e){

    var idvacante =$(this).val();    
    swal({
        title: "¿Estás seguro?",
        text: "No podrás recuperar este registro",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FFFF00",
        confirmButtonText: "Si, borrar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
    
            var miurl = "puestoupdate";
            var status = "Rechazado";

            var formData = {
                idvacante: $('#idvacante').val(),
                idvacante: idvacante,
                status: status,
                valor: 1,
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: miurl,
                data: formData,
                dataType: 'json',
            
                success: function (data) {
                    swal({ 
                        title:"Envio correcto",
                        text: "Gracias",
                        type: "success"
                        },

                    );
                    $("#vacante" + idvacante).remove();
                                        
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
         }else {
            swal("Cancelado", "No se ha borrado el registro :)", "error");
        }
    });                
});


$(document).on('click','.btn-disablevacante',function(e){
    var idvacante =$(this).val();    
    swal({
        title: "¿Estás seguro?",
        text: "No podrás recuperar este registro",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FFFF00",
        confirmButtonText: "Si, borrar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {


            var miurl = "puestoupdate";
            var status = "Eliminado";

            var formData = {
                idvacante: $('#idvacante').val(),
                idvacante: idvacante,
                status: status,
                valor: 2,
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: miurl,
                data: formData,
                dataType: 'json',
            
                success: function (data) {
                    swal({ 
                        title:"Se borro el registro correctamente",
                        text: "Gracias",
                        type: "success"
                        },

                    );
                    $("#vacante" + idvacante).remove();
                                        
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
        }else {
            swal("Cancelado", "No se ha borrado el registro :)", "error");
        }
    });             
});