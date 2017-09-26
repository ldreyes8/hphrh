$(document).ready(function(){


  $('#btncomentarioEL').click(function(){
      $('#inputTitle').html("Agregar observacion del solicitante");
      $('#formAgregar').trigger("reset");
      $('#btnGuardar').val('expec');
      $('#formModal').modal('show');
  });

  $('#btncomentarioR').click(function(){
      $('#inputTitle').html("Agregar observacion del solicitante");
      $('#formAgregar').trigger("reset");
      $('#btnGuardar').val('refc');
      $('#formModal').modal('show');
  });

  $("#btnGuardar").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl;
        var formData;
        var state=$("#btnGuardar").val();


        var referenciaid= $(".idpreferencia").val();
        var explaboral=$('.idpexperiencia').val();
        var identificacion=$('#identificacionup').val();

        if (state == "refc") 
                {
                  formData = {
                    referenciaid: referenciaid,
                    observacion: $("#observacion").val(),
                    identificacion: identificacion,
                  };
                  miurl = urlraiz+'/empleado/pre_entrevistado/show/1/refcomentario';
                  //miurl = '1/refcomentario';
                }
        if (state == "expec") 
                {
                  formData = {
                    explaboral: explaboral,
                    observacion: $("#observacion").val(),
                    identificacion: identificacion,
                  };
                  miurl = urlraiz+'/empleado/pre_entrevistado/show/1/expcomentaro';
                  //miurl = '1/expcomentaro';
                }

        var obs=$("#observacion").val();

        $.ajax({
            type: "POST",
            url: miurl,
            data: formData,
            dataType: 'json',

            success: function (data) {
              if (state == "refc")
                {
                  var item = '<tr class="even gradeA" >';
                    item += '<td>'+obs+'</td>';
                  $('#productsref').append(item);
                }
              if (state == "expec")
                {
                  var item = '<tr class="even gradeA" >';
                    item += '<td>'+obs+'</td>';
                  $('#productsel').append(item);
                }

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
  
});