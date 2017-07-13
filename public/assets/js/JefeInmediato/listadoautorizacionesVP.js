function cargarvacaciones(listado){
    $("#profile").html($("#cargador_empresa").html());
    if(listado==1){var url = "vacaciones";}
    $.get(url,function(resul){
    $("#profile").html(resul);
    });
}

function cargarpermisos(listado){
    $("#permiso").html($("#cargador_empresa").html());
    if(listado==1){var url = "permiso";}
    $.get(url,function(resul){
    $("#permiso").html(resul);
    });
}

function cargarconstancia(listado){
    $("#consta").html($("#cargador_empresa").html());
    if(listado==1){var url = "goce";}
    $.get(url,function(resul){
    $("#consta").html(resul);
    });
}

