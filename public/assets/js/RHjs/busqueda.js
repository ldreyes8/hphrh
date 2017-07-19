//Busqueda de empleado y paginacion

    function buscarempleado(){
        var rol=$("#select").val();
        var dato=$("#searchText").val();
        console.log(dato);
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
    
    $(document).on("click",".pagination li a",function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $("#lisadoEmp").html($("#cargador_empresa").html());
        $.get(url,function(resul){
            $("#lisadoEmp").html(resul);  
        })
    })