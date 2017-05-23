<!DOCTYPE html>
<html>
<head>
	<title>Descarga Solicitante</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   
</head>
 <body bgcolor="#RRGGBB">	
<div class="row">
  <div class="col-md-2 col-md-12 col-sm-12 col-xs-12" >
  <img src="assets/images/Habitat/loghab.png" width="125" height="50">
  </div>
</div>
 <div class="row">
  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <h3 class="text-center">Constancia de vacaciones</h3>
        <h4>&nbsp;Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>Luis Daniel Reyes López</u></strong></h4>
        <h4>&nbsp;Puesto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>Programador</u></h4>
        <h4>&nbsp;Ubicación:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>Oficina nacional xela</u></h4>
        <h4>&nbsp;Fecha de ingreso a la fundacion&nbsp;&nbsp;<strong><u>13/02/2015</u></h4>
        <h4>&nbsp;Fecha de emision de la constancia:&nbsp;<strong><u>19/05/2017</u></h4>
        <p>Se hace constar que el colaborador (a) gozó de su período vacacional como se detalla a continuación</p>
  </div>
</div>
<div><p><br></p></div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
      <tr>
        <th>FECHA DE SOLICITUD</th>
        <th>DÍAS TOMADOS</th>
        <th>TOTAL DE DIAS</th>
        <th>PERÌODO VACACIONAL</th>
      </tr>
    
       <tr>
        <td>03/03/11</td>
        <td>18/12/2012 al 14/01/2013</td>
        <td>16 ½ Días</td>
        <td>03/03/11-02/03/12</td>
        </tr>
        <tr>
        <td>03/03/11</td>
        <td>18/12/2012 al 14/01/2013</td>
        <td>16 ½ Días</td>
        <td>03/03/11-02/03/12</td>
        </tr>
        <tr>
        <td>03/03/11</td>
        <td>18/12/2012 al 14/01/2013</td>
        <td>16 ½ Días</td>
        <td>03/03/11-02/03/12</td>
        </tr>
   
    </table>
  </div> 
</div>

<h5 class="text-center">TOTAL DE DIAS      20 </h5>


<p>Quedando completo el período vacacional correspondiente al: <strong><u>03/03/11-02/03/12.</u></strong></p>
      
<div class="text-align: right"><p>&nbsp;&nbsp;SALDO DEL PERIODO: <strong>03/03/11 AL 02/03/12_____ (Llenar este espacio solo si hubiera saldo del periodo).</strong></p></div>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIRMAS DE CONFORMIDAD:</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
_______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________
</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Jefe inmediato Superior&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Colaborador (a)
</p>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vº Bº Depto. de Recursos Humanos
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(firma y sello)
</p>

 
	<script src="assets/js/bootstrap.min.js"></script>
     <!--  
  <script type="text/javascript">
  $("#btngoce").click(function(e){

        var miurl="diastomado";

        $("#btndescargar").show();

        var formData = {                      
            fecha_inicio: $("#fecha_inicio").val(),
            fecha_final : $("#fecha_final").val(),
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
                var sum =0;
                var res;
                for (var i = 0; i < data.length; i++) {
                    var dia = data[i].fechasolicitud;
                    var dsolicitado = data[i].totaldias;
                    var hsolicitado = data[i].totalhoras;
                    var dnotomado = data[i].soldias;
                    var hnotomado = data[i].solhoras;

                    hsolicitado = parseInt(hsolicitado);
                    hnotomado = parseInt(hnotomado);
                  

                    var tdsolicitado = 0;
                    var tdnotomado = 0;

                    var td =0;


                    var resul; 

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
                    document.getElementById("dataTableItems").innerHTML += "<tr class='fila'><td>" +dia+ "</td><td>" +data[i].fechainicio + " al "+ data[i].fechafin +"</td><td>"+resul+"</td><td>"+data[i].periodo+"</td></tr>";
                }

                 if (sum - Math.floor(sum) == 0) {
                        
                        res = sum + " Días";

                    }
                    else{
                        sum = sum - 0.5;
                       
                        res = sum + " ½ "+"Días"
                    }

                document.getElementById('dtomado').innerHTML  = res;
          
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
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });

    });
  </script>
  -->
</body>
</html>