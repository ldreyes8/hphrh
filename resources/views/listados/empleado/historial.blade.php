@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Historial empleado </h3>
	</div>
</div>
<div class="row">
   <div class=class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="table-responsive">
             <table class="table table-striped table-bordered table-condensed table-hover">
                 <thead>
                     <th>Nombre</th>
                     <th>Autorizado por</th>
                     <th>Fecha</th>
                     <th>Motivo</th>
                     <th>Descripcion</th>
                     <th>Adjunto</th>
                 </thead>
                 @foreach ($historia as $em)
                     <tr>
                         <td>{{$em->nombre1.': '.$em->apellido1}}</td>

                        @foreach ($asignajefe as $esm)
                            <td>{{$esm->nombre1.': '.$esm->apellido1}}</td>
                        @endforeach
                         <td>{{$em->fecha}}</td>
                         <td>{{$em->hsa}}</td>
                         <td>{{$em->comentario}}</td>
                         <td></td>
                     </tr>
                 @endforeach
             </table>
         </div> 
   </div>
</div>
@endsection