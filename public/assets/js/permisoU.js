$(document).ready(function(){
    var x = $("#idtipoausencia").val();
    if(x ==="4" || x ==="9")
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
    if(x != "5" && x != "4" && x != "9" && x != "11")
    {
        $("#divJ").hide();
        $("#divCHM").show();
        $("#divHMF").show();
        $("#divENF").hide();                   
    }

    if(x === "11")
        {
            $("#divJ").hide();
            $("#divCHM").hide();
            $("#divHMF").hide();
            $("#divENF").hide();
        }

    $("#idtipoausencia").change(event => {
        var x = $("#idtipoausencia").val();
       
        if(x ==="4" || x ==="9" || x ==="7" || x ==="11" || x ==="6")
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
        if(x != "5" && x != "4" && x != "9" && x != "7" && x != "11" && x != "6")
        {
            $("#divJ").hide();
            $("#divCHM").show();
            $("#divHMF").show();
            $("#divENF").hide();                   
        }

       
        if(x === "11")
        {
            $("#divJ").hide();
            $("#divCHM").hide();
            $("#divHMF").hide();
            $("#divENF").hide();
        }
    });   
    
    $("#btndatomarP").click(function(e){

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
                    document.getElementById('datomarP').value = tdh;
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
                    $("#erroresContentP").html(errHTML); 
                    $('#erroresModalP').modal('show');
                }
            });
    });

    $('#btnnuevoP').click(function(e){      
        $('#inputTitleP').html("Solicitud de permiso");
        $('#formAgregarP').trigger("reset");
        $('#formModalP').modal('show');
        $('#datomarP').attr('disabled', 'disabled');
        $('#hhorasP').attr('disabled', 'disabled');
        $('#dacumulado').attr('disabled', 'disabled');
        $('#btnguardarV').attr('disabled', 'disabled');           
    });

    $("#btnguardarP").click(function(e){
        e.preventDefault();
        var $f = $(this);

        if($f.data('locked') == undefined && !$f.data('locked'))
        {
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

            hoy = dd+'-'+mm+'-'+yyyy;

            finicio = $("#fecha_inicio").val();
            ffin = $("#fecha_final").val();
            td = $("#datomarP").val();
            th = $("#hhorasP").val();
            th = th -0;

             hini= $("#hinicio").val();
                hfin=$("#hfin").val();
                mini= $("#mini").val();
                mfin= $("#mfin").val();
            hinic = hini+':'+mini+':00';
            hfina = hfin+':'+mfin+':00';


            var miurl="permiso/store";
            var formData = {
                           
                fecha_inicio: $("#fecha_inicio").val(),
                fecha_final : $("#fecha_final").val(),
                dias: $('#datomarP').val(),
                horas: $('#hhorasP').val(),
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
                justificacion: $("#observaciones").val(),

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

                beforeSend: function(){ $f.data('locked', true);  // (2)
                },

                success: function (data) {
                    //console.log(data);
                    document.getElementById("dataTableItemsPermiso").innerHTML += "<tr class='fila'><td>" +hoy+ "</td><td>" +finicio + "</td><td>" +ffin  + "</td><td>" + hinic+ "</td><td>" +hfina +"</td><td>" +"solicitado"+ "</td><td>"+"</td></tr>";
        
                    $('#formModalP').modal('hide');
                    $("#erroresContentP").html("La solicitud ha sido enviada correctamente"); 
                    $('#erroresModalP').modal('show');
                    
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
                    $("#erroresContentP").html(errHTML); 
                    $('#erroresModalP').modal('show');
                    $("#inputErrorP").html("Errores");
                },
                complete: function(){ $f.data('locked', false);  // (3)
                }
            });
        }else{
            alert("se esta enviando su solicitud");
        }
    });
});




/*
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
        */