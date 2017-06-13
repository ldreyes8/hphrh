@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de  empleados</h3>
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
                     <th>Afiliado</th>
                     <th>Puesto</th>
                     <th>Opciones</th>
                 </thead>
                 @foreach ($empleado as $em)
                 <tr>
                 <td>{{$em->idempleado}}</td>
                 <td>{{$em->identificacion}}</td>
                 <td>{{$em->nit}}</td>
                 <td>{{$em->nombre.' '.$em->apellido}}</td>
                 <td>{{$em->afiliado}}</td>
                 <td>{{$em->puesto}}</td>
                 <td>
                     <a href="{{URL::action('ListadoController@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                     <a href="{{URL::action('ListadoController@historial',$em->idempleado)}}"><button class="btn btn-primary">Historial</button></a>
                     <a href="{{URL::action('ListadoController@Acta',$em->idempleado)}}"><button class="btn btn-primary">Acta</button></a>
                     <a href="{{URL::action('ListadoController@laboral',$em->idempleado)}}"><button class="btn btn-primary
                     ">Historia laboral</button></a>
                    <button class="btn btn-primary btn-vacaciones" id="btnsaldo" value="{{$em->idempleado}}">Vacaciones</button>
                    <a href="{{URL::action('ListadoController@Acta',$em->idempleado)}}"><button class="btn btn-primary">Despedir</button></a>
                 </td>
                 </tr>

                 @endforeach
             </table>
         </div>
         {{$empleado->render()}}
   </div>
</div>
<div class="col-lg-12">
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <input type="hidden" name="tdias" id="tdias">
            <input type="hidden" name="thoras" id="thoras">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="inputTitle"></h4>
                </div>
              
                    <form role="form" id="formAgregar">
                        <div class="modal-header">
                        <br>                           
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Días acumulados</label>
                                <input id="dacumulado" type="text" class="form-control" name="dias">   
                            </div>
                        </div>
                                   
                    </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('fin')
    @parent
        <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="{{asset('assets/js/RH.js')}}"></script>

@endsection


