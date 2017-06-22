@extends ('layouts.index')
@section ('contenido')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="{{URL::action('Reporte@Empleadoexcel')}}"><button class="btn btn-primary">Descargar</button></a>
        <p><h2 ALIGN=center>Informe Empleado General</h2></p>
    </div>
</div>
<div class="row">
    <div class="table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <thead style="background-color:#A9D0F5">
                <th>Afiliado</th>
                <th>Puesto</th>
                <th>Nombre del empleado</th>
                <th>Identificaci&oacute;n</th>
                <th>Salario</th>
                <th>Fecha ingreso</th>
                <th>Estado</th>
            </thead>
            <tbody>
            @foreach($nomytras as $ntr)
                <tr>
                    <td>{{$ntr->afiliado}}</td>
                    <td>{{$ntr->puesto}}</td>
                    <td>{{$ntr->nombre1.' '.$ntr->nombre2.' '.$ntr->nombre3.' '.$ntr->apellido1.' '.$ntr->apellido2}}</td>
                    <td>{{$ntr->identificacion}}</td>
                    <td>{{$ntr->salario}}</td>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $ntr->fecha)->format('d-m-Y')}}</td>
                    <td>{{$ntr->caso}}</td>
                </tr>               
            @endforeach
          </tbody>
        </table>
    </div>
</div>
@endsection
