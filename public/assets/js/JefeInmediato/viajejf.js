$(document).ready(function(){
	$('#btnconfirma').click(function(){
		swal({ 
        	title:"Envio correcto",
        	text: "Información actualizada correctamente",
        	type: "success"
    	},
    	function(){
   		});
	});
	$('#btnrechazo').click(function(){
		swal({ 
        	title:"Envio correcto",
        	text: "Se ha rechazado exitosamente esta solicitud de gastos",
        	type: "success"
    	},
    	function(){
   		});
	});
	$('#btnconfirma1').click(function(){
		alert("Solicitud");
	});
	$(document).on('click','.quitar',function(){
	//$('#quitar').click(function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
		var idvv=$(this).val();
		var urlraiz=$("#url_raiz_proyecto").val();
		var miurl=urlraiz+'/ji/viajejf/delvhc/'+idvv;

		swal({
            title: "¿Está seguro de Rechazar la solicitud de este vehiculo?",
            text: "Usted rechazara la solicitud de este vehiculo",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "¡Si!",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false },

            function(isConfirm){
            if (isConfirm) 
            {

            	swal(
                    {
                        title: "¡Se ha completado exitosamente!",
                        text: "",
                        type: "success"
                    },
                    function()
                    {
                        $.ajax({
		                    type: "DELETE",
		                    url: miurl,
		                    success: function (data) {
		                        //console.log(data);
		                        $("#vc" + idvv).remove();
		                    },
		                    error: function (data) {
		                        console.log('Error:', data);
		                    }
		                });
                    }
                );

				
            }
        	else {
                swal("¡Cancelado!",
                "No se ha realizado algún cambio...",
                "error");
            }
        });

		breack();
	});
	$('#btngastoviaje').click(function(e){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl=urlraiz+'/ji/viajejf/respuesta';
		var itemsDatav=[];
        var i=0;
        $("#tablavh tr").each(function(){
        	var idpad=$('.idvehiculo:eq('+i+')').val();
        	valor = new Array(idpad);
            itemsDatav.push(valor);
            i++;
        });
        var formData={
        	rconfirma:$("input:radio[id=rconfirma]:checked").val(),
			observacion:$("#observacion").val(),
			idge:$("#idge").val(),
			items:itemsDatav,
        };
        console.log(itemsDatav);
		$.ajax({
            type: "PUT",
            url: miurl,
            data: formData,
            dataType: 'json',

            success: function (data) {
                /*swal({ 
                    title:"Envio correcto",
                    text: "Información guardada correctamente",
                    type: "success"
                },
                function(){
                    window.location.href="https://www.habitatguate.org/";        
                });*/
                    
            },
            error: function (data) {
                $('#loading').modal('hide');
                var errHTML="";
                if((typeof data.responseJSON != 'undefined')){
                    for( var er in data.responseJSON){
                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                    }
                }else{
                    errHTML+='<li>Error, intente mas tarde gracias.</li>';
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });

	});
});