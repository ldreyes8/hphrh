$(document).ready(function(){
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

    $('#btnconfirmar').click(function(e){
        $('#Title').html("Confirmar goce de vacaciones");
        $('#formModificar').trigger("reset");
        $('#formGoce').modal('show');
        $("#oculto").hide();
    });

    $('#btnConfirmarV').click(function(e){
        var resultado="ninguno";
        var saldoh = 0;
        var saldod = 0;

        horas = $("#solhoras").val();
        dias = $("#soldias").val();


        var porNombre=document.getElementsByName("autorizacion");

        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                resultado=porNombre[i].value;
        }
        if(resultado == "Si_gozado")
        {
            saldod ='0';
            saldoh = '00:00:00';

        }
        if(resultado == "No_gozado")
        {
            saldod = dias;
            saldoh = horas;
        }
        if(resultado == "Goce_temporal")
        {
            saldod = $("#dtomados").val();
            saldoh = $("#htomadas").val();
            saldoh = saldoh+':00'+':00';
        }

        var miurl="vacaciones/update";

        var formData = {
            idempleado: $('#idempleado').val(),
            idvacadetalle: $('#idvacadetalle').val(),
            solhoras: saldoh,
            soldias: saldod,
            goce: resultado,
            name: $('#name').val(),
        
            
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
                //document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +hoy+ "</td><td>" +finicio + "</td><td>" +ffin  + "</td><td>" + td + "</td><td>" +th +"</td><td>" +"solicitado"+ "</td></tr>";
                $('#formGoce').modal('hide');                
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
    
	$("#btnguardarV").click(function(e){
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



        var miurl="vacaciones/store";
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
                document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +hoy+ "</td><td>" +finicio + "</td><td>" +ffin  + "</td><td>" + td + "</td><td>" +th +"</td><td>" +"solicitado"+ "</td></tr>";
    
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

    $("#btngoce").click(function(e){

        var miurl="diastomado";

        $("#btndescargar").show();

        var formData = {                      
            fecha_inicio: $("#fecha_inicio").val(),
            fecha_final : $("#fecha_final").val(),
            idempleado : $("#idempleado").val(),    
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
                var sum =0;
                var res;
                for (var i = 0; i < data.length; i++) {
                    var dia = data[i].fechasolicitud;
                    var dsolicitado = data[i].totaldias;
                    var hsolicitado = data[i].totalhoras;
                    var dnotomado = data[i].soldias;
                    var hnotomado = data[i].solhoras;

                    hsolicitado = parseInt(hsolicitado);
                    hnotomado = parseInt(hnotomado);
                  

                    var tdsolicitado = 0;
                    var tdnotomado = 0;

                    var td =0;


                    var resul; 

                    dsolicitado = dsolicitado * 8;
                    dnotomado = dnotomado *8;

                    tdsolicitado = dsolicitado + hsolicitado;
                    tdnotomado = dnotomado + hnotomado;


                    td = tdsolicitado - tdnotomado;

                    td = td/8;

                    sum += td;

                    if (td - Math.floor(td) == 0) {
                        
                        resul = td + " Días";

                    }
                    else{
                        td = td - 0.5;
                        resul = td + " ½ "+"Días"
                    }
                    document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +dia+ "</td><td>" +data[i].fechainicio + " al "+ data[i].fechafin +"</td><td>"+resul+"</td><td>"+data[i].periodo+"</td></tr>";
                }

                 if (sum - Math.floor(sum) == 0) {
                        
                        res = sum + " Días";

                    }
                    else{
                        sum = sum - 0.5;
                       
                        res = sum + " ½ "+"Días"
                    }

                document.getElementById('dtomado').innerHTML  = res;
          
                     $('#btnguardarV').removeAttr("disabled");

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
    
/*
    $("#btndescargar").click(function(e){

        var miurl="Gpdf";

        var formData = {                      
            fecha_inicio: $("#fecha_inicio").val(),
            fecha_final : $("#fecha_final").val(),
            idempleado : $("#idempleado").val(),    
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: miurl,
            data: formData,
            dataType: 'json',

            success: function (data) {
                console.log("mensjae");
                              
            },
            error: function (data) {
                $('#loading').modal('hide');
                var errHTML="";
                if((typeof data.responseJSON != 'undefined')){
                    for( var er in data.responseJSON){
                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                    }
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });

    });*/
});
