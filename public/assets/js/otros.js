function cargarotros(listado){
    $("#otros").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarotros";}
    $.get(url,function(resul){
    $("#otros").html(resul);
    });
}

$(document).ready(function()
{
    //agregar otro
        $('#btnAgregarO').click(function(){
            $('#inputTitleO').html("Agregar otros");
            $('#formAgregarO').trigger("reset");
            $('#btnGuardarO').val('add');
            $('#formModalO').modal('show');
        });

        $(document).on('click','.btn-editar-cel',function(){

            var idem=$(this).val();
            var miurl="listarotros1";
            $.get(miurl+'/'+ idem,function(data){
                console.log(data);
                $('#idem').val(data.idempleado);
                $('#celcorporativo').val(data.celcorporativo);
                $('#talla').val(data.talla);
                $('#altura').val(data.altura);
                $('#peso').val(data.peso);

                $('#inputTitleO').html("Actualizar otros");
                $('#formModalO').modal('show');
                $('#btnGuardarO').val('update');
                $('loading').modal('hide');
            });  
        });

        $("#btnGuardarO").click(function(e){
            var miurl="agregarotros";

            celcorporativo = $("#celcorporativo").val();
            talla = $("#talla").val();
            altura = $("#altura").val();
            peso = $("#peso").val();
            var idem=$('#idem').val();
            var formData = {
                celcorporativo : $("#celcorporativo").val(),
                talla : $("#talla").val(),
                altura : $("#altura").val(),
                peso : $("#peso").val(),
                idempleado: $("#idempleado").val(),
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
                    var item = '<tr class="even gradeA" id="idem'+data.idempleado+'">';
                        item += '<td>'+data.celcorporativo+'</td>'+'<td>' +data.talla+ '</td>'+'<td>'+data.altura+'&nbsp;Metros</td>'+'<td>'+data.peso+'&nbsp;Libras</td>';
                        item += '<td><button class="fa fa-pencil btn-editar-cel" value="'+data.idempleado+'"></button>';
                        $("#idem"+idem).replaceWith(item);
                    /*if (state == "add")
                    {
                        $('#products').append(item);
                    }
                    if (state == "update")
                    {
                        $("#idem"+idex).replaceWith(item);
                    }*/
                  //document.getElementById("dataTableItemsO").innerHTML += "<tr class='fila'><td>" +celcorporativo+ "</td><td>" +talla + "</td><td>" +altura + "</td><td>" + peso + "</td><td><button class='fa fa-pencil'></button></tr>";
                    $('#formAgregarO').trigger("reset");
                    $('#formModalO').modal('hide');
                    
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
                    $("#erroresContentO").html(errHTML); 
                    $('#erroresModalO').modal('show');
                }
            });
        });
    //agregar idioma
        $('#btnAgregarI').click(function(){
            $('#inputTitleI').html("Agregar un idioma");
            $('#formAgregarI').trigger("reset");
            $('#btnGuardarI').val('add');
            $('#formModalI').modal('show');
        });

        $(document).on('click','.btn-editar-idioma',function(){

            var idpi=$(this).val();
            var miurl="listaridioma";
            $.get(miurl+'/'+ idpi,function(data){
                console.log(data);
                $('#idpi').val(data.idpidioma);
                $('#niveli').val(data.nivel);
                $('#ididioma option:selected').val(data.ididioma);
                $('#ididioma option:selected').text(data.nombre);
                $('#inputTitleI').html("Actualizar Idioma");
                $('#formModalI').modal('show');
                $('#btnGuardarI').val('update');
                $('loading').modal('hide');
            });   
        });

        $("#btnGuardarI").click(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var state=$("#btnGuardarI").val();
            var type;
            var my_url;
            var formData = {
                idempleadoI : $("#idempleadoI").val(),
                ididioma : $("#ididioma").val(),
                nivel : $("#niveli").val(),
            };
            ididioma = $("#ididioma option:selected").text();
            var idpi=$('#idpi').val();

            if (state =="update") 
                    {
                        type="PUT";
                        my_url ='updateidioma/'+idpi;
                    }
            if (state == "add") 
                    {
                        type="POST";
                        my_url = 'agregaridioma';
                    }

            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',

                success: function (data) {
                  var item = '<tr class="even gradeA" id="idpi'+data.idpidioma+'">';
                        item += '<td>'+ididioma+'</td>'+'<td>'+data.nivel+'</td>';
                        item += '<td><button class="fa fa-pencil btn-editar-idioma" value="'+data.idpidioma+'"></button>';
                        item += '<button class="fa fa-trash-o btn-delete-idioma" value="'+data.idpidioma+'"></button></td></tr>';
                    if (state == "add")
                    {
                        $('#productsI').append(item);
                    }
                    if (state == "update")
                    {
                        $("#idpi"+idpi).replaceWith(item);
                    }
                    $('#formAgregarI').trigger("reset");
                    $('#formModalI').modal('hide');
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
                    $("#erroresContentO").html(errHTML); 
                    $('#erroresModalO').modal('show');
                }
            });
        });

        $(document).on('click','.btn-delete-idioma',function(){
            var idpi=$(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) {
                return false;
                }
                else {
                    $.ajax({
                        type: "DELETE",
                        url: 'deleteidioma/' + idpi,
                        success: function (data) {
                            console.log(data);
                            $("#idpi" + idpi).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            $("#erroresContentO").html(errHTML); 
            $('#erroresModalO').modal('show');
        });
    //agregar licencia
        $('#btnAgregarL').click(function(){
            $('#inputTitleL').html("Agregar licencia de conducir");
            $('#formAgregarL').trigger("reset");
            $('#btnGuardarL').val('add');
            $('#formModalL').modal('show');
        });

        $("#btnGuardarL").click(function(e){
            var state=$("#btnGuardarL").val();
            var type;
            var my_url;
            var formData = {
                identificacion : $("#identificacionl").val(),
                licenciaid : $("#licenciaid").val(),
                vigencia : $("#vigencia").val(),
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            licenciaid = $("#licenciaid option:selected").text();
            var idlic=$('#idlic').val();

            if (state =="update") 
                    {
                        type="PUT";
                        my_url ='updatelic/'+idlic;
                    }
            if (state == "add") 
                    {
                        type="POST";
                        my_url = 'agregarlicencia';
                    }

            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',

                success: function (data) {
                    var item = '<tr class="even gradeA" id="idlic'+data.idplicencia+'">';
                        item += '<td>'+licenciaid+'</td>'+'<td>'+data.vigencia+'</td>';
                        item += '<td><button class="fa fa-pencil btn-editar-licencia" value="'+data.idplicencia+'"></button>';
                        item += '<button class="fa fa-trash-o btn-delete-licencia" value="'+data.idplicencia+'"></button></td></tr>';
                    if (state == "add")
                    {
                        $('#productsL').append(item);
                    }
                    if (state == "update")
                    {
                        $("#idlic"+idlic).replaceWith(item);
                    }

                    $('#formAgregarL').trigger("reset");
                    $('#formModalL').modal('hide');
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
                    $("#erroresContentO").html(errHTML); 
                    $('#erroresModalO').modal('show');
                }
            });
        });

        $(document).on('click','.btn-editar-licencia',function(){

            var idlic=$(this).val();
            var miurl="listarlicencia";
            $.get(miurl+'/'+ idlic,function(data){
                console.log(data);
                $('#idlic').val(data.idplicencia)
                $('#licenciaid option:selected').val(data.idlicencia);
                $('#licenciaid option:selected').text(data.tipolicencia);
                $('#vigencia').val(data.vigencia);

                $('#inputTitleL').html("Actualizar licencia de conducir");
                $('#formModalL').modal('show');
                $('#btnGuardarL').val('update');
                $('loading').modal('hide');
            });   
        });

        $(document).on('click','.btn-delete-licencia',function(){
            var idlic=$(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) {
                return false;
                }
                else {
                    $.ajax({
                        type: "DELETE",
                        url: 'deletelic/' + idlic,
                        success: function (data) {
                            console.log(data);
                            $("#idlic" + idlic).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }

            $("#erroresContentO").html(errHTML); 
            $('#erroresModalO').modal('show');
        });
    //Aplicar aún puesto
        $('#btnAgregarPAF').click(function(){
            $('#inputTitlePAF').html("Aplicar aún puesto");
            $('#formAgregarPAF').trigger("reset");
            $('#formModalPAF').modal('show');
        });
        $("#btnGuardarPAF").click(function(e){
            var miurl="SolicitanteI";

            var formData = {
                afiliado : $("#celcorporativo").val(),
                puesto : $("#talla").val(),
                idempleado: $("#idempleadoPAF").val(),
                identificacion : $("#identificacionPAF").val(),
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
                    $('#formAgregarPAF').trigger("reset");
                    $('#formModalPAF').modal('hide');
                    
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
                    $("#erroresContentO").html(errHTML); 
                    $('#erroresModalO').modal('show');
                }
            });
        });
});
