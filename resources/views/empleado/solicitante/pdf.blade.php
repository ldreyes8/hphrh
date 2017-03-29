<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
			<th scope="row">Nombre</th>
			<th>Telefono</th>
			<th>Fecha nacimiento</th>
			<th>Direccion</th>
			<th>No. de Dpi</th>
		</tr>
		@foreach($empleados as $emp)
		<tr>
			<td>{{$emp->nombre1}}</td>
			<td>{{$emp->telefono}}</td>
			<td>{{$emp->fechanac}}</td>
			<td>{{$emp->identificacion}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>