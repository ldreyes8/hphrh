$(document).ready(function(){
    $("#btnupsolicitud").click(function(){
        var i=0; //inicio del reccorido 
        $("#detallesPad .filaTable").each(function(){//se recorre la tabla 
            var id=$('.padRid:eq('+i+')').val();//se obtiene cada valor 
            var np=$('.padRn:eq('+i+')').val();
            i++;
            console.log(np,id);
            //alert(np);
        });
            
    });
});
