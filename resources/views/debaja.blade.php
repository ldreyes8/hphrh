@extends ('layouts.index')

@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />        
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css')}}" rel="stylesheet" type="text/css" media="screen">


@endsection

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
             <table class="table table-striped table-bordered table-condensed table-hover" >
                 <thead>
                     <th>Id</th>
                     <th>Identificación</th>
                     <th>Nit</th>
                     <th>Nombre</th>
                     <th>Afiliado</th>
                     <th>Puesto</th>
                     <th>Status</th>
                     <th>Opciones</th>
                 </thead>
                 @foreach ($empleado as $em)
                 <tr id="empleado{{$em->idempleado}}">
                 <td>{{$em->idempleado}}</td>
                 <td>{{$em->identificacion}}</td>
                 <td>{{$em->nit}}</td>
                 <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                 <td>{{$em->afiliado}}</td>
                 <td>{{$em->puesto}}</td>
                 <td>{{$em->statusn}}</td>
                <td>
                     <a href="{{URL::action('ListadoController@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                     <!--a href="{{URL::action('ListadoController@historial',$em->idempleado)}}"><button class="btn btn-primary">Historial</button></a>
                     <a href="{{URL::action('ListadoController@Acta',$em->idempleado)}}"><button class="btn btn-primary">Acta</button></a-->
                     <a href="{{URL::action('ListadoController@laboral',$em->idempleado)}}"><button class="btn btn-primary
                     ">Historia laboral</button></a>
                    <button class="btn btn-primary btn-vacaciones" id="btnsaldo" value="{{$em->idempleado}}">Vacaciones</button>
             
                 </td>
                 </tr>

                 @endforeach
             </table>
         </div>
         {{$empleado->render()}}
    </div>
</div>


<div class="modal fade" id="erroresModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Errores</h4>
      </div>

      <div class="modal-body">
        <ul style="list-style-type:circle" id="erroresContent"></ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('fin')
    @parent
        <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="{{asset('assets/js/RH.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
        <!--
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
        -->
@endsection


