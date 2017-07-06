function cargarempleados(listado){
	$("#lisadoEmp").html($("#cargador_empresa").html());
    if(listado==1){var url = "empleados";}
    $.get(url,function(resul){
    $("#lisadoEmp").html(resul);
    });
}

function cargarechazados(listado){
	$("#rechazadosf").html($("#cargador_empresa").html());
    if(listado==1){var url = "rechazados";}
    $.get(url,function(resul){
    $("#rechazadosf").html(resul);
    });
}

function cargarsolicitudes(listado){
    $("#listadoSol").html($("#cargador_empresa").html());
    if(listado==1){var url = "solicitudes";}
    $.get(url,function(resul){
    $("#listadoSol").html(resul);
    });
}


$(document).on("click",".pagination li a",function(e){
  e.preventDefault();
  var url = $(this).attr("href");
  $("#lisadoEmp").html($("#cargador_empresa").html());

  $.get(url,function(resul){
    $("#lisadoEmp").html(resul);  
  })
})

function buscarusuario(){
  var rol=$("#select").val();
  var dato=$("#searchText").val();
  if(dato == "")
  {
    var url="busqueda/"+rol+"";
  }
  else
  {
    var url="busqueda/"+rol+"/"+dato+"";
  }

  $("#lisadoEmp").html($("#cargador_empresa").html());
  $.get(url,function(resul){
    $("#lisadoEmp").html(resul);  
  })
}
