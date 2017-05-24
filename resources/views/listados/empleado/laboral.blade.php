@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Historia de empleado en Fundación Hábitat </h3>
	</div>
</div>
<div class="row">
   <div class=class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="table-responsive">
             <table class="table table-striped table-bordered table-condensed table-hover">
                 <thead>
                     <th>Nombre</th>
                     <th>Afiliado</th>
                     <th>Puesto</th>
                     <th>Caso</th>
                     <th>Fecha inicio</th>
                     <th>Salario</th>
                 </thead>
                 @foreach ($historia as $em)
                     <tr>
                         <td>{{$em->nombre1.': '.$em->apellido1}}</td>
                         <td>{{$em->naf}}</td>
                         <td>{{$em->npu}}</td>
                         <td>{{$em->nc}}</td>
                         <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $em->fecha)->format('d-m-Y')}}</td>
                         <td>{{$em->salario}}</td>
                     </tr>
                 @endforeach
             </table>
         </div> 
   </div>
</div>
@endsection