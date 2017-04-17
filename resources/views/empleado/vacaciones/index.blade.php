@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de vacaciones </h3>
		@include('empleado.solicitante.search')
	</div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <a href="{{URL::action('SolicitanteController@pdf')}}"><button class="btn btn-primary">Descargar</button></a>
    </div>
</div>

<div class="row">
   <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
         <div class="table-responsive">
             <table class="table table-striped table-bordered table-condensed table-hover">
                 <thead>
                     <th>Id</th>
                     <th>Identificación</th>
                     <th>Nit</th>
                     <th>Nombre</th>
                     <th>Estado civil</th>
                     <th>Status</th>
                     <th>Puesto aplicar</th>
                     <th>Opciones</th>
                 </thead>
                 @foreach ($empleados as $em)
                 <tr>
                 <td>{{$em->idempleado}}</td>
                 <td>{{$em->identificacion}}</td>
                 <td>{{$em->nit}}</td>
                 <td>{{$em->nombre1.': '.$em->apellido1}}</td>
                 <td>{{$em->estadocivil}}</td>
                 <td>{{$em->status}}</td>
                 <td>{{$em->puesto}}</td>
                 <td>
                 <a href="{{URL::action('SolicitanteController@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                 <a href=""><button class="btn btn-danger">Anular</button></a>
                 
                 </td>
                 </tr>

                 @endforeach
             </table>
         </div>
         {{$empleados->render()}}
   </div>
</div>
@endsection
