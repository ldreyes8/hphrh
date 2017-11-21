<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.m-0 {
			margin: 0px !important;
		}
		.table {
			margin-bottom: 10px;
		}
	</style>
	<title>Descarga Liquidacion</title>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
</head>
<body>  
	<div class="row">
		<div class="col-md-2 col-md-12 col-sm-12 col-xs-12" >
			<img src="assets/images/Habitat/loghab.png" width="125" height="50">
	  	</div>
	</div>

	<table class="table m-0" width="100%" bordercolor="#000000" cellspacing="0" cellpadding="0" style="font-size: 10px;">
	        	<tr>
	                <th>Fecha</th>
	                <th>Descripci&oacute;n</th>
	                <th># Factura</th>
	                <th>Empleado</th>
	                <th>Cuenta</th>
	                <th>Eventos</th>
	                <th>Línea de presupuesto</th>
	                <th>Proyecto L9</th>
	                <th>Funci&oacute;n L2</th>
	                <th>Monto</th>
	            </tr>
	            @foreach($gastoviajeemp as $gvi)
	            <tbody>
		            <tr>
		                <td width="5%">{{\Carbon\Carbon::createFromFormat('Y-m-d',$gvi->fecha)->format('d/m/Y')}}</td>
		                <td width="14%">{{$gvi->descripcion}}</td>
		                <td width="10">{{$gvi->factura}}</td>
		                <td width="15%">{{$gvi->nombre1.' '.$gvi->nombre2.' '.$gvi->nombre3.' '.$gvi->apellido1.' '.$gvi->apellido2.' '.$gvi->apellido3}}</td>
		                <td width="10%">{{$gvi->cuenta}}</td>
		                <td width="12%">Generic</td>
		                <td width="10%">Donante Generico</td>
		                <td width="12%">{{$gvi->proyecto}}</td>
		                <td width="7%">10</td>
		                <td width="5%">{{$gvi->monto}}</td>
		            </tr>
	            </tbody>
	            @endforeach
	        </table>
	  
</body>
</html>