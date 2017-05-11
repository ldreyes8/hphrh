$(document).ready(function(){
   	$('#btnnuevo').click(function(e){
    	$('#inputTitle').html("Solicitud de vacaciones");
    	$('#formAgregar').trigger("reset");
    	$('#formModal').modal('show');
        $('#datomar').attr('disabled', 'disabled');
        $('#hhoras').attr('disabled', 'disabled');
        $('#dacumulado').attr('disabled', 'disabled');
        $('#btnguardarV').attr('disabled', 'disabled');

        e.preventDefault();
        $.get('vacaciones/calculardias',function(data){
            var horas = '';
            var dias = '';
            var tdh;
            $.each(data,function(){
                horas = data[0];
                dias = data[1];
            })
            tdh = (dias + ' ' + 'dias' + ' ' + 'con' +' '+ horas +' '+ 'horas');
            document.getElementById('dacumulado').value = tdh;
            document.getElementById('tdias').value = dias;
            document.getElementById('thoras').value = horas;
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
