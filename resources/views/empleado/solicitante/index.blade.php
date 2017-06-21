@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de solicitantes </h3>
		@include('empleado.solicitante.search')
	</div>
    <!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="{{URL::action('SController@pdf')}}"><button class="btn btn-primary">Descargar</button></a>
    </div-->
</div>
<div class="row">
   <div class=class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="table-responsive">
             <table id="tblsolicitud" class="table table-striped table-bordered table-condensed table-hover">
                 <thead>
                     <th>Id</th>
                     <th>Identificación</th>
                     <th>Nit</th>
                     <th>Nombre</th>
                     <th>Afiliado </th>
                     <th>Puesto aplicar</th>
                     <th>Status</th>
                     <th>Opciones</th>
                 </thead>
                 @foreach ($empleados as $em)
                 <tr class="filaTable">
                     <td>{{$em->idempleado}}
                        <input type="hidden" class="idempleado" value="{{$em->idempleado}}">
                     </td>
                     <td>{{$em->identificacion}}</td>
                     <td>{{$em->nit}}</td>
                     <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                     <td>{{$em->afnombre}}</td>
                     <td>{{$em->puesto}}</td>
                     <td>{{$em->status}}</td>
                     <td>
                     
                     <a href="{{URL::action('SController@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                     <a href="{{URL::action('Pprueba@update',$em->idempleado)}}"><button class="btn btn-primary">Aceptar</button></a>
                     <a href="{{URL::action('SController@rechazo',$em->idempleado)}}"><button id="btnrechazo" class="btn btn-primary">Rechazar</button></a>
                     <a href="{{URL::action('SController@Spdf',$em->identificacion)}}"><button class="btn btn-primary">Descargar</button></a>
                     </td>
                 </tr>
                 @endforeach
             </table>
         </div>
         {{$empleados->render()}}
   </div>
</div>
@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    
@endsection