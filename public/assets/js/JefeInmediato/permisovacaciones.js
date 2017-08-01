$(document).on("click",".pagination li a",function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    $("#VPJF").html($("#cargador_empresa").html());

    $.get(url,function(resul){
        $("#VPJF").html(resul);  
    })
  })

function buscarindexsolicitadoJI()
{
    var tipoausencia=$("#select").val();
    var dato=$("#searchText").val();
    if(dato == "")
    {
        var url="busquedaindexsolicitadoJI/"+tipoausencia+"";
    }
    else
    {
        var url="busquedaindexsolicitadoJI/"+tipoausencia+"/"+dato+"";
    }
    $("#VPJF").html($("#cargador_empresa").html());
        $.get(url,function(resul){
        $("#VPJF").html(resul);  
    })
}

function buscarindexaceptadoJI()
{
    var tipoausencia=$("#select").val();
    var dato=$("#searchText").val();
    if(dato == "")
    {
        var url="busquedaindexaceptadoJI/"+tipoausencia+"";
    }
    else
    {
        var url="busquedaindexaceptadoJI/"+tipoausencia+"/"+dato+"";
    }
    $("#VPJF").html($("#cargador_empresa").html());
        $.get(url,function(resul){
        $("#VPJF").html(resul);  
    })
}

function buscarindexrechazadoJI()
{
    var tipoausencia=$("#select").val();
    var dato=$("#searchText").val();
    if(dato == "")
    {
        var url="busquedaindexrechazadoJI/"+tipoausencia+"";
    }
    else
    {
        var url="busquedaindexrechazadoJI/"+tipoausencia+"/"+dato+"";
    }
    $("#VPJF").html($("#cargador_empresa").html());
        $.get(url,function(resul){
        $("#VPJF").html(resul);  
    })
}