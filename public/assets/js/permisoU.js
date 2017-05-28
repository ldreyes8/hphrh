$(document).ready(function(){
    var x = $("#idtipoausencia").val();
    if(x ==="4")
    {
        $("#divCHM").hide();
        $("#divHMF").hide();
        $("#divENF").show();
        $("#divJ").hide();

    }

    if(x == "5")
    {
        $("#divJ").show();
        $("#divCHM").show();
        $("#divHMF").show();
        $("#divENF").hide();                   
    }
    if(x != "5" && x != "4")
    {
        $("#divJ").hide();
        $("#divCHM").show();
        $("#divHMF").show();
        $("#divENF").hide();                   
    }
    $("#idtipoausencia").change(event => {
        var x = $("#idtipoausencia").val();
       
        if(x ==="4")
        {
            $("#divCHM").hide();
            $("#divHMF").hide();
            $("#divENF").show();
            $("#divJ").hide();
        }

        if(x == "5")
        {
            $("#divJ").show();
            $("#divCHM").show();
            $("#divHMF").show();
            $("#divENF").hide();                   
        }
        if(x != "5" && x != "4")
        {
            $("#divJ").hide();
            $("#divCHM").show();
            $("#divHMF").show();
            $("#divENF").hide();                   
        }
    });   
    
    $("#btndatomar").click(function(e){

            tdias = parseInt($("#tdias").val());
            thoras =parseInt($("#thoras").val());
            var tt = 0;

            tdias = tdias * 8;

            tt = tdias + thoras;

            var miurl="diashatomar";
            var formData = {                      
                fecha_inicio: $("#fecha_inicio").val(),
                fecha_final : $("#fecha_final").val(),    
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "get",
                url: miurl,
                data: formData,
                dataType: 'json',

                success: function (data) {
                    var dias = '';
                    $.each(data,function(){
                         dias = data[0];
                    })
                    tdh = dias;
                    document.getElementById('datomar').value = tdh;
                    tdh = tdh *8;

                    if(tdh > tt)
                    {                    
                        alert("Verificar los dias a tomar")
                        
                    }
                    else{
                         $('#btnguardarV').removeAttr("disabled");}

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

    $('#btnnuevo').click(function(e){
        var errHTML="";
        e.preventDefault();
        $.get('vacaciones/calculardias',function(data){
           
            var horas = '';
            var dias = '';
            var tdh;

            $.each(data,function(){
                horas = data[0];
                dias = data[1];
                autorizacion = data[2];
            })

            if(autorizacion == 'Autorizado' || autorizacion == 'solicitado')
            {
                //alert('No puede realizar una solicitud porque tiene una en proceso');
            swal({
                title: "Solicitud denegada",
                text: "No puede realizar una solicitud porque tiene una en proceso",
                type: "error",
                confirmButtonClass: 'btn-danger waves-effect waves-light',
               
            });
             
            }
            else{
                $('#inputTitle').html("Solicitud de vacaciones");
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
            }
        });
    });

    $("#btnguardarP").click(function(e){
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1; //hoy es 0!
        var yyyy = hoy.getFullYear();

        if(dd<10) {
            dd='0'+dd
        } 

        if(mm<10) {
            mm='0'+mm
        }

        hoy = dd+'/'+mm+'/'+yyyy;

        finicio = $("#fecha_inicio").val();
        ffin = $("#fecha_final").val();
        td = $("#datomar").val();
        th = $("#hhoras").val();
        th = th -0;


        var miurl="permiso/store";
        var formData = {
                       
            fecha_inicio: $("#fecha_inicio").val(),
            fecha_final : $("#fecha_final").val(),
            dias: $('#datomar').val(),
            horas: $('#hhoras').val(),
            idmunicipio: $('#idmunicipio').val(),
            idempleado: $('#idempleado').val(),
            name: $('#name').val(),
            tdias: $('#tdias').val(),
            thoras: $("#thoras").val(),
            hini: $("#hinicio").val(),
            hfin: $("#hfin").val(),
            mini: $("#mini").val(),
            mfin: $("#mfin").val(),
            idtipoausencia: $("#idtipoausencia").val(),
            concurrencia : $("#concurrencia").val(),
            tipocaso : $("#tipocaso").val(),
            juzgadoinstitucion: $("#Jusgado").val(),

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
                //console.log(data);
                //document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +hoy+ "</td><td>" +finicio + "</td><td>" +ffin  + "</td><td>" + td + "</td><td>" +th +"</td><td>" +"solicitado"+ "</td><td>"+"</td></tr>";
    
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
                    errHTML+='<li>Error.</li>';
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }

        });
    });
});


$(function(){
            $("#form").submit(function(e){

                var fields = $(this).serialize();

                $.post("{{url('empleado/permiso')}}", fields, function(data){

                    if(data.valid !== undefined){
                        $("#result").html("En hora buena formulario enviado correctamente");
                        
                        $("#form")[0].reset();
                        $("#error_fechaini").html('');
                        $("#error_fechafin").html('');
                    }
                    else{
                        $("#error_fechaini").html('');
                        $("#error_fechafin").html('');
                        if (data.fini !== undefined){
                            $("#error_fechaini").html(data.fini); 
                        }
                        if (data.ffin !== undefined){
                            $("#error_fechafin").html(data.ffin);
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