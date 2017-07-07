@extends ('layouts.index')
@section('estilos')
    @parent
    
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
@endsection
@section ('contenido')

<div class="tab-pane" id="otros">
    <ul class="nav nav-tabs navtab-custom">
        <li class="active tab"><a href="#solicitud" data-toggle="tab">Solicitudes</a></li>
        <li><a href="#preentrevista" data-toggle="tab">Pre-Entrevista</a></li>
        <li><a href="#precalificado" data-toggle="tab">Pre-Calificados</a></li>
        <li><a href="#resultados" data-toggle="tab">Resultados</a></li>
        <li><a href="#entrevista" data-toggle="tab">Entrevista</a></li>
        <li><a href="#nombramiento1" data-toggle="tab">Nombramiento 1</a></li>
    </ul>
</div>

<div class="tab-content bx-s-0 m-b-0" >
    <div class="tab-pane p-t-10 fade in active" id="solicitud">
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
                     <table id="tblsolicitudE" class="table table-striped table-bordered table-condensed table-hover">
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
                         <tr class="even gradeA">
                            <td>{{$em->idempleado}}
                                <input type="hidden" class="idempleado" value="{{$em->idempleado}}">
                            </td>
                            <td>{{$em->identificacion}}</td>
                            <td>{{$em->nit}}</td>
                            <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                            <td>{{$em->afnombre}}</td>
                            <td>{{$em->puesto}}</td>
                            <td>{{$em->status}}
                                <input type="hidden" class="idstatus" value="{{$em->idstatus}}">
                            </td>
                            <td>
                                <a href="{{URL::action('SController@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                                <a href="{{URL::action('Pprueba@update',$em->idempleado)}}"><button class="btn btn-primary">Aceptar</button></a>
                            
                                <a > 
                                <button id="btnrechazo" 
                                onclick='
                                swal({
                                    title: "¿Está seguro de Rechazar la solicitud?",
                                    text: "Usted rechazara la solicitud de empleo",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "¡Si!",
                                    cancelButtonText: "No",
                                    closeOnConfirm: false,
                                    closeOnCancel: false },

                                    function(isConfirm){
                                    if (isConfirm) 
                                    {
                                        swal(
                                            {
                                                title: "¡Hecho!",
                                                text: "Solicitud rechazada con éxito!!!",
                                                type: "success"
                                            },
                                            function()
                                            {
                                                window.location.href="{{url("empleado/rechazo",array("id"=>$em->idempleado,"ids"=>$em->idstatus))}}";
                                            }
                                        ); 
                                    }

                                    else {
                                    swal("¡Cancelado!",
                                    "No se ha realizado algún cambio...",
                                    "error");
                                    }
                                    });
                                ' 
                                class="btn btn-primary btnrechazo">Rechazar</button></a>
                                <a href="{{URL::action('SController@Spdf',$em->identificacion)}}"><button class="btn btn-primary">Descargar</button></a>
                            </td>
                         </tr>
                         @endforeach
                     </table>
                 </div>
                 {{$empleados->render()}}
           </div>
        </div>
    </div>
    <div class="tab-pane p-t-10 fade" id="preentrevista">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3>Listado de personas en Pre-Entrevista</h3>
            </div>
        </div>
    </div>
    <div class="tab-pane p-t-10 fade" id="precalificado">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3>Listado de personas en Pre-Calificadas</h3>
            </div>
        </div>
    </div>
    <div class="tab-pane p-t-10 fade" id="resultados">
    </div>
    <div class="tab-pane p-t-10 fade" id="entrevista">
    </div>
    <div class="tab-pane p-t-10 fade" id="nombramiento1">
    </div>
</div>

@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
@endsection