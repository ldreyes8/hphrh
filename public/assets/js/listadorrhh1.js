function cargarpvsolicitudes(listado){
    $("#pvsolicitados").html($("#cargador_empresa").html());
    if(listado==1){var url = "psolicitado";}
    $.get(url,function(resul){
    $("#pvsolicitados").html(resul);
    });
}

function cargarpvaceptados(listado){
    $("#pvaceptados").html($("#cargador_empresa").html());
    if(listado==1){var url = "pconfirmado";}
    $.get(url,function(resul){
    $("#pvaceptados").html(resul);
    });
}

function cargarpvrechazados(listado){
    $("#pvrechazados").html($("#cargador_empresa").html());
    if(listado==1){var url = "prechazado";}
    $.get(url,function(resul){
    $("#pvrechazados").html(resul);
    });
}

function cargarpvconfirmados(listado){
    $("#pvconfirmados").html($("#cargador_empresa").html());
    if(listado==1){var url = "vautorizadopv";}
    $.get(url,function(resul){
    $("#pvconfirmados").html(resul);
    });
}

$(document).on("click",".pagination li a",function(e){
      e.preventDefault();
      var url = $(this).attr("href");
      $("#pvsolicitados").html($("#cargador_empresa").html());

      $.get(url,function(resul){
        $("#pvsolicitados").html(resul);  
      })
    })


