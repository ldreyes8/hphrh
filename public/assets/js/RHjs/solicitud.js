$(document).ready(function(){
	//inicio document

   
    $(document).on('click','.btn-enviar-datos',function(e){
        //e.preventDefault();
		
        /*items, tablas y variables*/
        	var itemsDataTE=[];
        	var tablaTE=$("#detalleTE tr");

        	var itemsDataPF=[];
        	var tablaPF=$("#detalle4 tr");

        	var itemsDataPA=[];
        	var tablaPA=$("#detalle6 tr");

        	var itemsDataPI=[];
        	var tablaPI=$("#detalle7 tr");

        	var itemsDataPL=[];
        	var tablaPL=$("#detalle5 tr");

        	var itemsDataPR=[];
        	var tablaPR=$("#detalle3 tr");

        	var itemsDataPC=[];
        	var tablaPC=$("#detalle8 tr");

        	var itemsDataPD=[];
        	var tablaPD=$("#detalles tr");

        	var itemsDataPP=[];
        	var tablaPP=$("#detalle tr");

        /*fin items*/
        /*Recorrido de tablas*/
        	tablaTE.each(function(){//se recorre la tabla 
	            var forma=$(this).find('td').eq(1).html();//se obtiene cada valor
	            var idpaiste=$(this).closest('tr').find('input[id="paisTe"]').val();
	            var motivofin=$(this).find('td').eq(3).html();
	            valor = new Array(forma,idpaiste,motivofin);
	            itemsDataTE.push(valor);
	        });
	        tablaPF.each(function(){
                var nombref = $(this).find('td').eq(1).html();
                var apellidof = $(this).find('td').eq(2).html();
                var edad = $(this).find('td').eq(3).html();
                var telefonof = $(this).find('td').eq(4).html();
                var parentezco = $(this).find('td').eq(5).html();
                var ocupacion = $(this).find('td').eq(6).html();
                var emergencia = $(this).closest('tr').find('input[id="emergencia"]').val();
                valor = new Array(nombref,apellidof,edad,telefonof,parentezco,ocupacion,emergencia);
                itemsDataPF.push(valor);
            });
            tablaPA.each(function(){
                var titulo = $(this).find('td').eq(1).html();
                var establecimiento = $(this).find('td').eq(2).html();
                var duracion = $(this).find('td').eq(3).html();
                var periodo = $(this).find('td').eq(4).html();
                var idnivel = $(this).closest('tr').find('input[id="nivelid"]').val();
                var fingreso = $(this).find('td').eq(6).html();
                var fsalida = $(this).find('td').eq(7).html();
                var idmunicipio = $(this).closest('tr').find('input[id="pidmunicipio"]').val();
                var idpais = $(this).closest('tr').find('input[id="idpaisPAAT"]').val();
                valor = new Array(titulo,establecimiento,duracion,periodo,idnivel,fingreso,fsalida,idmunicipio,idpais);
                itemsDataPA.push(valor);
            });
            tablaPI.each(function(){//se recorre la tabla 
	            var ididioma=$(this).closest('tr').find('input[id="eidioma"]').val();
	            var nivel=$(this).find('td').eq(2).html();
	            valor = new Array(ididioma,nivel);
	            itemsDataPI.push(valor);
	        });
	        tablaPL.each(function(){
                var empresa = $(this).find('td').eq(1).html();
                var puesto = $(this).find('td').eq(2).html();
                var jefeinmediato = $(this).find('td').eq(3).html();
                var teljefeinmediato = $(this).find('td').eq(4).html();
                var motivoretiro = $(this).find('td').eq(5).html();
                var ultimosalario = $(this).find('td').eq(6).html();
                var fingresoex = $(this).find('td').eq(7).html();
                var fsalidaex = $(this).find('td').eq(8).html();
                valor = new Array(empresa,puesto,jefeinmediato,teljefeinmediato,motivoretiro,ultimosalario,fingresoex,fsalidaex);
                itemsDataPL.push(valor);
            });
            tablaPR.each(function(){
                var nombrer = $(this).find('td').eq(1).html();
                var telefonor = $(this).find('td').eq(2).html();
                var profesion = $(this).find('td').eq(3).html();
                var tiporeferencia = $(this).find('td').eq(4).html();
                valor = new Array(nombrer,telefonor,profesion,tiporeferencia);
                itemsDataPR.push(valor);
            });
            tablaPP.each(function(){//se recorre la tabla 
	            var padecimiento=$(this).find('td').eq(1).html();//se obtiene cada valor
	            valor = new Array(padecimiento);
	            itemsDataPP.push(valor);
	        });
	        tablaPD.each(function(){
                var acreedor = $(this).find('td').eq(1).html();
                var amortizacionmensual = $(this).find('td').eq(2).html();
                var montodeuda = $(this).find('td').eq(3).html();
                var mdeuda = $(this).find('td').eq(4).html();
                valor = new Array(acreedor,amortizacionmensual,montodeuda,mdeuda);
                itemsDataPD.push(valor);
            });
            tablaPC.each(function(){//se recorre la tabla 
	            var licenciape=$(this).closest('tr').find('input[id="licenciape"]').val();
	            var vigencia=$(this).find('td').eq(2).html();
	            valor = new Array(licenciape,vigencia);
	            itemsDataPC.push(valor);
	        });
        /*Fin Recorrido de tablas*/

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

		var formData = {
			//Datos de pais
				idpaisPS: $('#idpaisPS').val(),
            //Datos persona
            	iddocumento: $('#iddocumento').val(),
                identificacion: $('#identificacion').val(),
                nombre1: $('#nombre1').val(),
                nombre2: $('#nombre2').val(),
                nombre3: $('#nombre3').val(),
                apellido1: $('#apellido1').val(), 
                apellido2: $('#apellido2').val(),
                apellido3: $('#apellido3').val(),
                genero: $("input:radio[id=genero]:checked").val(),
                barriocolonia: $('#barriocolonia').val(),
                telefono: $('#telefono').val(),
                celular: $('#celular').val(),
                fechanac: $('#dato1').val(),
                iddepartamento: $('#iddepartamento').val(),
                idmunicipio: $('#idmunicipio').val(),
                idnacionalidad: $('#idnacionalidad').val(),
                idetnia: $('#idetnia').val(),
                ive: $("input:radio[id=ive]:checked").val(),
                parientepolitico: $("input:radio[id=parientepolitico]:checked").val(),
                nombrep: $('#nombrep').val(),
                puestop: $('#puestop').val(),
                dependencia: $('#dependencia').val(),
                archivo: $('#prs').val(),
                trabajoext: $("input:radio[id=trabajoext]:checked").val(),
            //Datos empleados
                nit: $('#nit').val(),
                numerodependientes: $('#numerodependientes').val(),
                afiliacionigss: $('#afiliacionigss').val(),
                aportemensual: $('#aportemensual').val(),
                vivienda: $('#vivienda').val(),
                alquilermensual: $('#alquilermensual').val(),
                otrosingresos: $('#otrosingresos').val(),
                idcivil: $('#idcivil').val(),
                pretension: $("#pretension").val(),
                correo: $("#correo").val(),
                idpuesto:$('#puesto').val(),
                idafiliado: $("#afiliado").val(),

                itemsTE:itemsDataTE,
                itemsPF:itemsDataPF,
                itemsPA:itemsDataPA,
                itemsPI:itemsDataPI,
                itemsPL:itemsDataPL,
                itemsPR:itemsDataPR,
                itemsPP:itemsDataPP,
                itemsPC:itemsDataPC,
                itemsPD:itemsDataPD,

                validacion:$("#g-recaptcha-response").val(),
        };
        /*Inicio de ajax*/
        console.log(formData);
        $.ajax({
            type: "POST",
            url: "solicitud/ds",
            data: formData,
            dataType: 'json',

            success: function (data) {
                swal({ 
                    title:"Envio correcto",
                    text: "Información guardada correctamente",
                    type: "success"
                },
                function(){
                    window.location.href="https://www.habitatguate.org/";        
                });
                    
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

        /*Fin ajax*/
	});
	//fin document	
});