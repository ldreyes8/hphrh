@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        
@endsection
@section ('contenido')
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="">
                                <div class="">
                                    <ul class="nav nav-tabs navtab-custom">

                                        <li class="active" data-toggle="tab" aria-expanded="false">
                                            <a data-toggle="tab" aria-expanded="false" onclick="cargar_formulario(4);">
                                                <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                                                <span class="hidden-xs">Solicitados</span>
                                            </a>
                                        </li>

                                        <li class="">
                                            <a data-toggle="tab" aria-expanded="false" onclick="cargar_formulario(5);">
                                                <span class="visible-xs"><i class="md md-school"></i></span>
                                                <span class="hidden-xs">Autorizados</span>
                                            </a>
                                        </li>
                                       
                                        <li class="">
                                            <a data-toggle="tab" aria-expanded="false" onclick="cargar_formulario(6);">
                                                <span class="visible-xs"><i class="md md-people"></i></span>
                                                <span class="hidden-xs">Rechazados</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" aria-expanded="false" onclick="cargar_formulario(7);">
                                                <span class="visible-xs"><i class="ion ion-clipboard"></i></span>
                                                <span class="hidden-xs">Verificados</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
                                    <div id="capa_modal" class="div_modal" style="display: none;"></div>
                                    <div id="capa_formularios" class="div_contenido" style="display: none;"></div>
                                    
                                    <!--<div class="tab-content">
                                        @include('rrhh.permisosvacaciones.indexsolicitados')
                                        @include('rrhh.permisosvacaciones.indexconfirmado')
                                        @include('rrhh.permisosvacaciones.indexrechazado')
                                        @include('rrhh.permisosvacaciones.indexautorizado')
                                 </div>
                                 -->
                            </div>
                        </div> <!-- end -->


   
    <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
    <div id="capa_modal" class="div_modal" style="display: none;"></div>
    <div id="capa_formularios" class="div_contenido" style="display: none;"></div>
@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('assets/js/perfil/solicitud.js')}}"></script>
    <script src="{{asset('assets/js/JefeInmediato/permisovacaciones.js')}}"></script>
    <script>cargar_formulario(4);</script>


@endsection