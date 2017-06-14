<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Empleados</title>
</head>
<body>
	<table>
		<tr>
            <th>Número de Empleado</th>
            <th>Primer Nombre</th>
            <th>Segundo Nombre</th>
            <th>Tercer Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Nacionalidad</th>
            <th>Estado Civil</th>
            <th>Documento Identificacion</th>
            <th>Número de Documento</th>
            <th>País origen</th>
            <th>Lugar Nacimiento</th>
            <th>NIT</th>
            <th>Número de Afiliación IGSS</th>
            <th>Sexo (M) O (F)</th>
            <th>Fecha Nacimiento</th>
            <th>Cantidad de Hijos</th>
            <th>A trabajado en el extranjero</th>
            <th>En que forma</th>
            <th>País</th>
            <th>Motivo de finalización de la relación laboral en el extranjero</th>
            <th>Nivel Academico</th>
            <th>Profesión</th>
            <th>Etnia</th>
            <th>Idioma</th>
            <th>Tipo de control</th>
            <th>Fecha Inicio Labores</th>
            <th>Fecha Reinicio Labores</th>
            <th>Fecha Retiro Labores</th>
            <th>Puesto</th>
            <th>Jornada de Trabajo</th>
            <th>Días Laborados en el Año</th>
            <th>Permiso de Trabajo</th>
            <th>Salario Anual Nominal</th>
            <th>Bonificación Decreto 78-89 (Q.250.00)</th>
            <th>Total Horas Extras Anuales</th>
            <th>Valor de Hora Extra</th>
            <th>Total Horas Extras Anuales</th>
            <th>Valor de Hora Extra</th>
            <th>Monto Aguinaldo Decreto 76-78</th>
            <th>Monto Bono 14 Decreto 42-92</th>
            <th>Retribución por Comisiones</th>
            <th>Viaticos</th>
            <th>Bonificaciones Adicionales</th>
            <th>Retribución por vacaciones</th>
            <th>Retribución por Indemnización (Articulo 82)</th>
            <th>Días Totales de Trabajo</th>
            <th>Vacaciones tomadas</th>
            <th>Suspensiones</th>
            <th>Total</th>
            <th>Días efectivos</th>
            <th>-</th>
        </tr>

        	@foreach($persona as $per)
                <tr>
                    <td>{{$per->idempleado}}</td>
                    <td>{{$per->nombre1}}</td>
                    <td>{{$per->nombre2}}</td>
                    <td>{{$per->nombre3}}</td>
                    <td>{{$per->apellido1}}</td>
                    <td>{{$per->apellido2}}</td>
                    <td>{{$per->nnac}}</td>
                    <td>{{$per->idcivil}}</td>
                    <td>{{$per->identificacion}}</td>
                    <td>{{$per->mtdo}}</td>

                        <td>{{$per->mtps}}</td> 
                        <td>{{$per->mtmun}}</td>

                    <td>{{$per->nit}}</td>
                    <td>{{$per->iggs}}</td> 
                    <td>{{$per->genero}}</td>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $per->fechanac)->format('d-m-Y')}}</td>
                    <td>
                        @foreach($hijo as $pers)
                            @if($pers->identificacion == $per->identificacion)
                                {{$pers->hijos}}
                            @endif
                        @endforeach 
                    </td>
                    <td>
                        @foreach($trabajoextranjero as $te)
                            @if($te->identificacion == $per->identificacion)
                                {{$te->trabajoext}}
                            @endif
                        @endforeach 
                    </td>  
                    <td>
                        @foreach($trabajoextranjero as $te)
                            @if($te->identificacion == $per->identificacion)
                                {{$te->forma}}
                            @endif
                        @endforeach
                    </td>      
                    <td>
                        @foreach($trabajoextranjero as $te)
                            @if($te->identificacion == $per->identificacion)
                                {{$te->npais}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($trabajoextranjero as $te)
                            @if($te->identificacion == $per->identificacion)
                                {{$te->motivofin}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($academico as $acad)
                            @if($acad->identificacion == $per->identificacion)
                                {{$acad->idnivel}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($academico as $acad)
                            @if($acad->identificacion == $per->identificacion)
                                {{$acad->titulo}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$per->idetnia}}</td>
                    <td>
                        @foreach($idioma as $idid)
                            @if($idid->idempleado == $per->idempleado)
                                {{$idid->ididioma}},
                            @endif
                        @endforeach
                    </td>
                </tr>               
            @endforeach
	
	</table>
</body>
</html>