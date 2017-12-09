$(document).on('click','.btn-on',function(e){

	var $f = $(this);


    if($f.data('locked') == undefined && !$f.data('locked'))
    {

		swal({
		    title: "¿Todo está correcto?",
		    text: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#FFFF00",
			confirmButtonText: "Si, enviar",
			cancelButtonText: "No, cancelar",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
		  	if (isConfirm) {
		  		var urlraiz=$("#url_raiz_proyecto").val();
			    var miurl = urlraiz+"/ji/viajejf/revok";

			    $.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			        }
			    });

			    var formData = {
			        gastocabeza: $('#idgastocabeza').val(),
			    };

			    $.ajax({
			        type: "PUT",
			        url: miurl,
			        data: formData,
			        dataType: 'json',

			        success: function (data) {
			            $f.data('locked', true);

			            swal({ 
			                title:"Enviado",
			                text: "el registro ha sido enviado correctamente",
			                type: "success",
			                confirmButtonClass: 'btn-success waves-effect waves-light',
			                confirmButtonText: 'OK!'
			            },
			            function(){
			                cargar_formularioviaje(24);
			            });
			            $f.data('locked',false);
			            
			        },
			        error: function (data) {
			            $('#loading').modal('hide');
			            var errHTML="";
			            if((typeof data.responseJSON != 'undefined')){
			                for( var er in data.responseJSON){
			                    errHTML+="<li>"+data.responseJSON[er]+"</li>";
			                }
			            }else{
			                errHTML+='<li>Error.</li>';
			            }
			            $("#erroresContent").html(errHTML); 
			            $('#erroresModal').modal('show');
			        },
			    });
		   	} else {
		       	swal("Cancelado", "No se envio el registro :)", "error");
		    }
		});
	}else{
        swal({
            title:"Envio en espera",
            text: "Se esta enviando su solicitud :)",
            type: "warning",
        });
    }
});
/**/
$(document).on('click','.btn-of',function(e){

	var $f = $(this);


    if($f.data('locked') == undefined && !$f.data('locked'))
    {

		swal({
		    title: "¿Está seguro de regresar a revisión?",
		    text: "",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#FFFF00",
			confirmButtonText: "Si, enviar",
			cancelButtonText: "No, cancelar",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
		  	if (isConfirm) {
		  		var urlraiz=$("#url_raiz_proyecto").val();
			    var miurl = urlraiz+"/ji/viajejf/revretorna";

			    $.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			        }
			    });

			    var formData = {
			        gastocabeza: $('#idgastocabeza').val(),
			    };

			    $.ajax({
			        type: "PUT",
			        url: miurl,
			        data: formData,
			        dataType: 'json',

			        success: function (data) {
			            $f.data('locked', true);

			            swal({ 
			                title:"Enviado",
			                text: "el registro ha sido enviado correctamente",
			                type: "success",
			                confirmButtonClass: 'btn-success waves-effect waves-light',
			                confirmButtonText: 'OK!'
			            },
			            function(){
			                cargar_formularioviaje(24);
			            });
			            $f.data('locked',false);
			            
			        },
			        error: function (data) {
			            $('#loading').modal('hide');
			            var errHTML="";
			            if((typeof data.responseJSON != 'undefined')){
			                for( var er in data.responseJSON){
			                    errHTML+="<li>"+data.responseJSON[er]+"</li>";
			                }
			            }else{
			                errHTML+='<li>Error.</li>';
			            }
			            $("#erroresContent").html(errHTML); 
			            $('#erroresModal').modal('show');
			        },
			    });
		   	} else {
		       	swal("Cancelado", "No se envio el registro :)", "error");
		    }
		});
	}else{
        swal({
            title:"Envio en espera",
            text: "Se esta enviando su solicitud :)",
            type: "warning",
        });
    }
});

/**/