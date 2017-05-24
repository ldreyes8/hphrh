@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de empleados <a href="empleado/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('empleado.empleado.search')
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
                 <td>{{$em->nombre.': '.$em->apellidos}}</td>
                 <td>{{$em->estadocivil}}</td>
                 <td>{{$em->status}}</td>
                 <td>{{$em->puesto}}</td>
                 <td>
                 <a href="#"><button class="btn btn-primary">Detalles</button></a>
                 <a href="#"><button class="btn btn-danger">Anular</button></a>
                 </td>
                 </tr>

                 @endforeach
             </table>
         </div>
         {{$empleados->render()}}
   </div>
</div>
@endsection
