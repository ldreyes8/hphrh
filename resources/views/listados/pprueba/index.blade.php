@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Personas en periodo de prueba</h3>
		@include('listados.pprueba.search')
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
                     <th>Afiliado</th>
                     <th>Puesto</th>
                     <th>Salario</th>
                     <th>Status</th>
                     <th>Opciones</th>
                 </thead>
                 @foreach ($empleado as $em)
                 <tr>
                 <td>{{$em->idempleado}}</td>
                 <td>{{$em->identificacion}}</td>
                 <td>{{$em->nit}}</td>
                 <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                 <td>{{$em->naf}}</td>
                 <td>{{$em->npo}}</td>
                 <td>{{$em->sal}}</td>
                 <td>{{$em->statusn}}</td>
                 <td>
                 <a href="{{URL::action('Confirmacion@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                 <a href="{{URL::action('Confirmacion@update',$em->idempleado)}}"><button class="btn btn-primary">Confirmar</button></a>

                 <a> 
                    <button id="btnrechazo" 
                    onclick='
                        if (!confirm("ADVERTENCIA!! Finalizara el periodo de esta Persona")){return false;}
                        else 
                        {
                            location.href=("{{URL::action("SController@rechazoPP",$em->idempleado)}}");
                        }
                        ' 
                    class="btn btn-danger">Rechazar</button></a>


                 </td>
                 </tr>

                 @endforeach
             </table>
         </div>
         {{$empleado->render()}}
   </div>
</div>
@endsection

