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
        th = th -0;

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
                document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +hoy+ "</td><td>" +finicio + "</td><td>" +ffin  + "</td><td>" + td + "</td><td>" +th +"</td><td>"+0+"</td><td>"+0+"</td><td>" +"solicitado"+ "</td><td>"+"</td></tr>";
    
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

    $("#btndatomar").click(function(e){

        tdias = parseInt($("#tdias").val());
        thoras =parseInt($("#thoras").val());
        var tt = 0;

        tdias = tdias * 8;

        tt = tdias + thoras;

        var miurl="vacaciones/diashatomar";
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
});
