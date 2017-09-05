$(document).ready(function(){
  $('#btnAgregarO').click(function(){
      $('#inputTitleo').html("Agregar observacion del solicitante");
      $('#formAgregaro').trigger("reset");
      $('#btnGuardaro').val('obpre');
      $('#formModalo').modal('show');
  });

  $('#btnAgregarOPC').click(function(){
      $('#inputTitleo').html("Agregar observacion del solicitante");
      $('#formAgregaro').trigger("reset");
      $('#btnGuardaro').val('obpc');
      $('#formModalo').modal('show');
  });
  $('#btnAgregarOE').click(function(){
      $('#inputTitleo').html("Agregar observacion del solicitante");
      $('#formAgregaro').trigger("reset");
      $('#btnGuardaro').val('obe');
      $('#formModalo').modal('show');
  });
  $("#btnGuardaro").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var miurl;
        var state=$("#btnGuardaro").val();
        var formData = {
                identrevista: $("#identrevista").val(),
                observacion: $("#observacion").val(),
                identificacion: $('#identificacion').val(),
           	};

        if (state == "obpre") 
                {
                  miurl = 'objtpre';
                }
        if (state == "obpc") 
                {
                  miurl = 'objtpc';
                }
        if (state == "obe") 
                {
                  miurl = 'obje';
                }
        var obs=$("#observacion").val();

        $.ajax({
            type: "POST",
            url: miurl,
            data: formData,
            dataType: 'json',

            success: function (data) {
                  var item = '<tr class="even gradeA" >';
                    item += '<td>'+obs+'</td>';
                  $('#listaOb').append(item);

              $('#formModalo').modal('hide');
                
            },
            error: function (data) {
                $('#loading').modal('hide');
                var errHTML="";
                if((typeof data.responseJSON != 'undefined')){
                    for( var er in data.responseJSON){
                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                    }
                }else{
                    errHTML+='<li>Error, por favor intente mas tarde.</li>';
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });
    });
  
});