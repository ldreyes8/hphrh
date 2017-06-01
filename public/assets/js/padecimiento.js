function cargarpadecimiento(listado){
	$("#padecimientos").html($("#cargador_empresa").html());
    if(listado==1){var url = "listarpadecimiento";}
    $.get(url,function(resul){
    $("#padecimientos").html(resul);
    });
}

$(document).ready(function(){
   	$('#btnAgregarP').click(function(){
    	$('#inputTitleP').html("Agregar padecimiento");
    	$('#formAgregarP').trigger("reset");
        $('#btnGuardarP').val('add');
    	$('#formModalP').modal('show');
	});

    $(document).on('click','.btn-editar-padecimiento',function(){
        var idpad=$(this).val();
        var miurl="listarpadecimiento1";
        $.get(miurl+'/'+ idpad,function(data){
            console.log(data);
            $('#idpad').val(data.idppadecimientos);
            $('#nombrep').val(data.nombre);
            $('#inputTitleP').html("Modificar padecimiento");
            $('#formModalP').modal('show');
            $('#btnGuardarP').val('update');
            $('loading').modal('hide');
        });
    });
    
    $("#btnGuardarP").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var formData = {
            nombre: $("#nombrep").val(),
            idempleado: $("#idempleado").val(),
            identificacion: $("#identificacion").val(),
        };

        var state=$("#btnGuardarP").val();
        var type;
        var idpad=$('#idpad').val();
        var my_url;

        //var miurl="agregarpadecimiento";
        
        if (state =="update") 
                {
                    type="PUT";
                    my_url ='updatepad/'+idpad;
                }
        if (state == "add") 
                {
                    type="POST";
                    my_url = 'agregarpadecimiento';
                }
        
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',


            success: function (data) {
                var item = '<tr class="even gradeA" id="pad'+data.idppadecimientos+'">';
                    item += '<td>'+data.nombre+'</td>';
                    item += '<td><button class="fa fa-pencil btn-editar-padecimiento" value="'+data.idppadecimientos+'"></button>';
                    item += '<button class="fa fa-trash-o btn-danger" value="'+data.idppadecimientos+'"></button></td></tr>';
                if (state == "add")
                {
                    $('#productsP').append(item);
                }
                if (state == "update")
                {
                    $("#pad"+idpad).replaceWith(item);
                }
              //document.getElementById("dataTableItemsP").innerHTML += "<tr class='fila'><td>" +data.nombre+ "</td><td><button value=" +data.idppadecimientos+ " class='fa fa-pencil btn-editar-padecimiento'></button><button id='btnEp' class='fa fa-trash-o'></button></td></tr>";
                $('#formAgregarP').trigger("reset");
                $('#formModalP').modal('hide');
                
            },
            error: function (data) {
                $('#loading').modal('hide');
                var errHTML="";
                if((typeof data.responseJSON != 'undefined')){
                    for( var er in data.responseJSON){
                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                    }
                }else{
                    errHTML+='<li>Verificar los datos ingresados.</li>';
                }
                $("#erroresContentP").html(errHTML); 
                $('#erroresModalP').modal('show');
            }
        });
    });
});
