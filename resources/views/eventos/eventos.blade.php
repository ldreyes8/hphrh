@extends ('layouts.index')
@section ('contenido')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>Creación de un evento</h3>
  </div>
</div>
<div class="panel-heading">
        <button class="btn btn-success" id="btnAgregarO"><i class="icon-user icon-white" ></i> Agregar otros</button>
</div>
<div class="row">
   <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
         <div class="table-responsive">
             <table class="table table-striped table-bordered table-condensed table-hover">
                 <thead>
                     <th>Título</th>
                     <th>Post</th>
                     <th>Fecha</th>
                     <th>Imagen</th>
                     <th>Opciones</th>
                 </thead>
                 @foreach ($tablero as $t)
                 <tr>
                 <td>{{$t->titulo}}</td>
                 <td>{{$t->post}}</td>
                 <td>{{$t->fechapublica}}</td>
                 <td>{{$t->imagen}}</td>
                 <td>
                 <a href=""><button class="btn btn-primary">Editar</button></a>
                 </td>
                 </tr>
                 @endforeach
             </table>
         </div>
   </div>
</div>
@endsection
