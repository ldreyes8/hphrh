<!DOCTYPE html>
<html>
<head>
	<title>Descarga Solicitante</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   
</head>
<body>	
<div class="row">
  <div class="col-md-2 col-md-12 col-sm-12 col-xs-12" >
  <img src="assets/images/Habitat/loghab.png" width="125" height="50">
  </div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3 class="text-center">Constancia de vacaciones</h3>
        <h4>Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong> {{$usuario->nombre1.' '.$usuario->nombre2.' '.$usuario->nombre3.' '.$usuario->apellido1.' '.$usuario->apellido2}}</strong></h4>
        <h4>Puesto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{$usuario->puesto}}</strong></h4>
        <h4>Ubicaci&oacute;n:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{$usuario->afiliado}}</strong></h4>
        <h4>Fecha de ingreso a la fundaci&oacute;n:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{\Carbon\Carbon::createFromFormat('Y-m-d',$usuario->fechaingreso)->format('d/m/Y')}}</strong></h4>
        <h4>Fecha de emision de la constancia:&nbsp;&nbsp;&nbsp;<strong>{{$year}}</strong></h4>
        <h4>Fecha inicio:&nbsp;&nbsp;&nbsp;<strong>{{$fini}}</strong></h4>
        <h4>Fecha final:&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{$ffin}}</strong></h4>        
        <p>Se hace constar que el colaborador (a) goz&oacute; de su per&iacute;odo vacacional como se detalla a continuaci&oacute;n</p>
    </div>
</div>
<div><p><br></p></div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
        <tr>
            <th>FECHA DE SOLICITUD</th>
            <th>DÍAS TOMADOS</th>
            <th>TOTAL DE DIAS</th>
            <th>A&Ntilde;O</th>
        </tr>
        <tr>
            <td width="25%">
                <table cellpadding="0" cellspacing="1">
                    @foreach($rangogoce as $rango)
                        <tr>
                            <td>{{$rango->fechasolicitud}}</td>
                         </tr>
                    @endforeach
                </table>
            </td>
            <td width="40%">
                <table cellpadding="0" cellspacing="1">
                    @foreach($rangogoce as $rango)
                        <tr>

                            <td>{{$rango->fechainicio.' '.'al'.' '.$rango->fechafin}}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
            <td width="20%">
                <table cellpadding="0" cellspacing="1">
                    @foreach($collection as $col)
                        <tr><td>{{$col}}</td></tr>
                    @endforeach
                </table>
            </td>
            <td width="15%">
                <table cellpadding="0" cellspacing="0">
                    @foreach($rangogoce as $rango)
                        <tr>
                            <td>{{$rango->periodo}}</td>
                        </tr>
                    @endforeach
                </table>
            </td>    
        </tr>
    </table>
  </div> 
</div>
 
<h5 class="text-center">TOTAL DE DIAS &nbsp;&nbsp;&nbsp;&nbsp; {{$res}}</h5>


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


</body>
</html>