$(document).ready(function(){
    $("#btnupsolicitud").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var ident=$('#identificacionup').val();
        

        var urlraiz=$("#url_raiz_proyecto").val();
        var myurl=urlraiz+'/empleado/pre_entrevistado/show/1/upsolicitudPE';
        var itemsData=[];
        var itemsDataR=[];
        var itemsDataF=[];
        var itemsDataE=[];
        var itemsDataD=[];
        var itemsDataA=[];
        var tablaP=$("#detallesPad .filaTable");
        var tablaD=$("#detallesD .filaTableD");
        var tablaEL=$("#detallesEL .filaTableEL");
        var tablaR=$("#detallesR .filaTableR");
        var tablaF=$("#detallesF .filaTableF");
        var tablaA=$("#detallesA .filaTableA");
        var a=0;  //contador para el recorrido de la tabla academicos
        var f=0;  //contador para el recorrido de la tabla familiar
        var r=0;  //contadir para el recorrido de la tabla referencias 
        var el=0; //contador para el recorrido de la tabla experiencia laboral 
        var d=0;  //contador para el rocorrido de la tabla deudas
        var i=0;  //contador para el recorrido de la tabla padecimientos

        tablaP.each(function(){//se recorre la tabla 
            var idpad=$('.idpad:eq('+i+')').val();//se obtiene cada valor 
            var np=$('.nombrepa:eq('+i+')').val();
            valor = new Array(idpad,np);
            itemsData.push(valor);
            i++;
        });
        tablaD.each(function(){
            var idpdeudas=$('.idpdeudas:eq('+d+')').val();
            var acreedor=$('.acreedor:eq('+d+')').val();
            var pago=$('.pago:eq('+d+')').val();
            var montodeuda=$('.montodeuda:eq('+d+')').val();
            var motivodeuda=$('.motivodeuda:eq('+d+')').val();
            valor = new Array(idpdeudas,acreedor,pago,montodeuda,motivodeuda);
            itemsDataD.push(valor);
            d++;
        });
        tablaEL.each(function(){
            var idpexperiencia=$('.idpexperiencia:eq('+el+')').val();
            var empresa=$('.empresa:eq('+el+')').val();
            var puesto=$('.puesto:eq('+el+')').val();
            var jefeinmediato=$('.jefeinmediato:eq('+el+')').val();
            var teljefeinmediato=$('.teljefeinmediato:eq('+el+')').val();
            var motivoretiro=$('.motivoretiro:eq('+el+')').val();
            var ultimosalario=$('.ultimosalario:eq('+el+')').val();
            var fingresoex=$('.fingresoex:eq('+el+')').val();
            var fsalidaex=$('.fsalidaex:eq('+el+')').val();
            var recomiendaexp=$('.recomiendaexp:eq('+el+')').val();
            var confirmadorexp=$('.confirmadorexp:eq('+el+')').val();
            var observacionel=$('.observacionel:eq('+el+')').val();
            valor = new Array(idpexperiencia,empresa,puesto,jefeinmediato,teljefeinmediato,motivoretiro,ultimosalario,fingresoex,fsalidaex,recomiendaexp,confirmadorexp,observacionel);
            itemsDataE.push(valor);
            el++;
        });
        tablaR.each(function(){
            var idpreferencia=$('.idpreferencia:eq('+r+')').val();
            var nombrer=$('.nombrer:eq('+r+')').val();
            var telefonor=$('.telefonor:eq('+r+')').val();
            var profesion=$('.profesion:eq('+r+')').val();
            var tiporeferencia=$('.tiporeferencia:eq('+r+')').val();
            
            var recomiendaper=$('.recomiendaPL:eq('+r+')').val();
            var confirmadorref=$('.confirmadorref:eq('+r+')').val();
            var observacionr=$('.observacionr:eq('+r+')').val();
            valor=new Array(idpreferencia,nombrer,telefonor,profesion,tiporeferencia,recomiendaper,confirmadorref,observacionr);
            itemsDataR.push(valor);
            r++;
        });
        tablaF.each(function(){
            var idpfamilia=$('.idpfamilia:eq('+f+')').val();
            var nombref=$('.nombref:eq('+f+')').val();
            var parentezco=$('.parentezco:eq('+f+')').val();
            var telefonof=$('.telefonof:eq('+f+')').val();
            var ocupacion=$('.ocupacion:eq('+f+')').val();
            var edad=$('.edad:eq('+f+')').val();
            valor = new Array(idpfamilia,nombref,parentezco,telefonof,ocupacion,edad);
            itemsDataF.push(valor);
            f++;
        });
        tablaA.each(function(){
            var idpacademico=$('.idpacademico:eq('+a+')').val();
            var titulo=$('.titulo:eq('+a+')').val();
            var establecimiento=$('.establecimiento:eq('+a+')').val();
            var duracion=$('.duracion:eq('+a+')').val();
            var selectpicker=$('.selectpicker:eq('+a+')').val();
            var fingreso=$('.fingreso:eq('+a+')').val();
            var fsalida=$('.fsalida:eq('+a+')').val();
            valor = new Array(idpacademico,titulo,establecimiento,duracion,selectpicker,fingreso,fsalida);
            itemsDataA.push(valor);
            a++;
        });

        var formData = {
            //Datos persona
                identificacionup: $('#identificacionup').val(),
                nombre1: $('#nombre1').val(),
                nombre2: $('#nombre2').val(),
                apellido1: $('#apellido1').val(), 
                apellido2: $('#apellido2').val(),
                barriocolonia: $('#barriocolonia').val(),
                telefono: $('#telefono').val(),
                fechanac: $('#fechanac').val(),
            //Datos empleado
                idempleado: $('#idempleado').val(),
                nit: $('#nit').val(),
                dependientes: $('#dependientes').val(),
                iggs: $('#iggs').val(),
                aportemensual: $('#aportemensual').val(),
                vivienda: $('#vivienda').val(),
                alquilermensual: $('#alquilermensual').val(),
                otrosingresos: $('#otrosingresos').val(),
                selectpicker1: $('.selectpicker1').val(),

                idobservacionGR: $(".idpreferencia").val(),
                observacionG: $("#observacionGR").val(),

                idpexperienciaGE:$('.idpexperiencia').val(),
                observacionGE: $("#observacionGEL").val(),
                items:itemsData,
                itemsR:itemsDataR,
                itemsF:itemsDataF,
                itemsE:itemsDataE,
                itemsD:itemsDataD,
                itemsA:itemsDataA,
        };
       $.ajax({
            type: "POST",
            url: myurl,
            data: formData,
            dataType: 'json',

            success: function (data) {
                swal({ 
                    title:"Envio correcto",
                    text: "Información actualizada correctamente",
                    type: "success"
                },
                function(){
                    //window.location.href="/empleado/solicitante"
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
            
    });
});
