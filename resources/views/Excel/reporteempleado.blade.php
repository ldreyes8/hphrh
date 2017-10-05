<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reporte empleado</title>
</head>
<body>
	<table>
		<tr>
            <th>Afiliado</th>
                <th>Puesto</th>
                <th>Nombre del empleado</th>
                <th>Identificaci&oacute;n</th>
                <th>Salario</th>
                <th>Fecha ingreso</th>
                <th>Correo institucional</th>
                <!--<th>Correo personal</th>-->
                <th>Estado</th>
                <th>idempleado</th>
        </tr>

        	@foreach($nomytras as $ntr)
                <tr>
                    <td>{{$ntr->afiliado}}</td>
                    <td>{{$ntr->puesto}}</td>
                    <td>{{$ntr->nombre1.' '.$ntr->nombre2.' '.$ntr->nombre3.' '.$ntr->apellido1.' '.$ntr->apellido2}}</td>
                    <td>{{$ntr->identificacion}}</td>
                    <td>{{$ntr->salario}}</td>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $ntr->fecha)->format('d-m-Y')}}</td>
                    <td>{{$ntr->email}}</td>
                    <!--<td>{{$ntr->correo}}</td>-->
                    <td>{{$ntr->caso}}</td>
                    <td>{{$ntr->idempleado}}</td>
                </tr>               
            @endforeach
	
	</table>
</body>
</html>