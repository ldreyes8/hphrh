<div class="box-header navbar-form navbar-left pull-right" id="capa" >
    <div class="form-group">     
        <input type="text" class="form-control" id="dato_buscado" name="dato_buscado" value="{{$dato}}" placeholder="Buscar....">
        <button class="btn btn-default btn-flat" type="button"   onclick="buscarsolicitante();" >Buscar!</button>
    </div>            
</div>


<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#dato_buscado').keypress(function(e)
        {   
            if(e.which == 13){    
                //alert('dd');  
                buscarsolicitante();      
            }   
        }); 
    });
    function buscarsolicitante(){
        var dato=$("#dato_buscado").val();
        var url="busquedas/"+dato;
        $("#tblsolicitante").html($("#cargador_empresa").html());
            $.get(url,function(resul){
            $("#tblsolicitante").html(resul);  
        })
    }
    $(document).on("click",".pagination li a",function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $("#tblsolicitante").html($("#cargador_empresa").html());
        $.get(url,function(resul){
            $("#tblsolicitante").html(resul);  
        })
    })
</script>