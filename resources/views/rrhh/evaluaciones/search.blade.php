<div class="box-header navbar-form navbar-left pull-right" id="capa" >
    <div class="form-group">     
        <input type="text" class="form-control" id="dato_buscado" name="dato_buscado"  placeholder="Buscar....">
        <button class="btn btn-default btn-flat" type="button"   onclick="evaluacion();" >Buscar!</button>
    </div>            
</div>


<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#dato_buscado').keypress(function(e)
        {   
            if(e.which == 13){    
                //alert('dd');  
                evaluacion();      
            }   
        }); 
    });
    function evaluacion(){
        var dato=$("#dato_buscado").val();
        var url="busquedaeva/"+dato;
        $("#tblevaluacion").html($("#cargador_empresa").html());
            $.get(url,function(resul){
            $("#tblevaluacion").html(resul);  
        })
    }
    $(document).on("click",".pagination li a",function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $("#tblevaluacion").html($("#cargador_empresa").html());
        $.get(url,function(resul){
            $("#tblevaluacion").html(resul);  
        })
    })
</script>