$(document).ready(function(){   	
    $("#btngoce").click(function(e){
        var miurl="diastomado";
        var fini = $("#fecha_inicioG").val();
        var ffin = $("#fecha_finalG").val();

        var formData = {                      
            fecha_inicio: $("#fecha_inicioG").val(),
            fecha_final : $("#fecha_finalG").val(),
            idempleado : $("#idempleado").val(),    
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "get",
            url: miurl,
            data: formData,
            dataType: 'json',

            success: function (data) {
                $("#btndescargar").show();

                var sum =0;
                var res;
                for (var i = 0; i < data.length; i++) {
                    var dia = data[i].fechasolicitud;
                    var dsolicitado = data[i].totaldias;
                    var hsolicitado = data[i].totalhoras;
                    var dnotomado = data[i].soldias;
                    var hnotomado = data[i].solhoras;
                    var tdsolicitado = 0;
                    var tdnotomado = 0;
                    var td =0;
                    var resul;

                    hsolicitado = parseInt(hsolicitado);
                    hnotomado = parseInt(hnotomado);
                    dsolicitado = dsolicitado * 8;
                    dnotomado = dnotomado *8;
                    tdsolicitado = dsolicitado + hsolicitado;
                    tdnotomado = dnotomado + hnotomado;
                    td = tdsolicitado - tdnotomado;
                    td = td/8;
                    sum += td;

                    if (td - Math.floor(td) == 0) {
                        resul = td + " Días";
                    }
                    else{
                        td = td - 0.5;
                        resul = td + " ½ "+"Días"
                    }
                    document.getElementById("dataTableItemsCon").innerHTML += "<tr class='fila'><td>" +dia+ "</td><td>" +data[i].fechainicio + " al "+ data[i].fechafin +"</td><td>"+resul+"</td><td>"+data[i].periodo+"</td></tr>";
                }

                if (sum - Math.floor(sum) == 0) {
                    res = sum + " Días";
                }
                else{
                    sum = sum - 0.5;
                    res = sum + " ½ "+"Días"
                }

                document.getElementById('dtomado').innerHTML  = res;
                document.getElementById("finicio").innerHTML = "Fecha incio:"+"   "+ fini;
                document.getElementById("ffinal").innerHTML = "Fecha final:" +"   "+ ffin;
                $('#btnguardarV').removeAttr("disabled");
            },
            error: function (data) {
                $('#loading').modal('hide');
                var errHTML="";
                if((typeof data.responseJSON != 'undefined')){
                    for( var er in data.responseJSON){
                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                    }
                }else{
                    errHTML+='<li>Error al borrar el &aacute;rea de atenci&oacute;n.</li>';
                }
                $("#erroresContentC").html(errHTML); 
                $('#erroresModalC').modal('show');
            }
        });
    });
});
