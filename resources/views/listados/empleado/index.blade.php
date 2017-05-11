@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de  empleaos</h3>
		@include('listados/empleado.search')
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
                     <th>Iggs</th>
                     <th>Opciones</th>
                 </thead>
                 @foreach ($empleado as $em)
                 <tr>
                 <td>{{$em->idempleado}}</td>
                 <td>{{$em->identificacion}}</td>
                 <td>{{$em->nit}}</td>
                 <td>{{$em->nombre.': '.$em->apellido}}</td>
                 <td>{{$em->estadocivil}}</td>
                 <td>{{$em->statusn}}</td>
                 <td>{{$em->afiliacionigss}}</td>
                 <td>
                 <a href="{{URL::action('SController@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                 <a href=""><button class="btn btn-danger">Anular</button></a>
                 </td>
                 </tr>

                 @endforeach
             </table>
         </div>
         {{$empleado->render()}}
   </div>
</div>



@endsection

