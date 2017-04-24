@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de permiso<a href="permiso/create"><button class="btn btn-success">Nuevo</button></a></h3>
	</div>
</div>

<div class="row">
   <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Solicitud</th>
                    <th>Iniicio</th>
                    <th>Fin</th>
                    <th>Hora inicio</th>
                    <th>Hora final</th>
                    <th>Autorizacion</th>
                    <th>Tipo caso</th>
                </thead>
                @foreach ($ausencias as $aus)
                <tr>
                    <td></td>

                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechainicio)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechafin)->format('d-m-Y')}}</td>
                    <td>{{$aus->horainicio}}</td>
                    <td>{{$aus->horafin}}</td> 
                    <td>{{$aus->autorizacion}}</td>
                    <td>{{$aus->tipocaso}}</td>
                 </tr>
                
                @endforeach
             </table>
         </div>
         {{$ausencias->render()}}
   </div>
</div>
@endsection
