@extends ('layouts.index')
@section('estilos')
    @parent
    
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />

@endsection
@section ('contenido')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="">
            <div class="">
                <ul class="nav nav-tabs navtab-custom">

                   

                    <li class="active" data-toggle="tab" aria-expanded="false">
                        <a data-toggle="tab" aria-expanded="false" onclick="cargar_formularioRH(1);">
                            <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                            <span class="hidden-xs">Solicitados</span>
                        </a>
                    </li>

                    <li class="">
                        <a data-toggle="tab" aria-expanded="false" onclick="cargar_formularioRH(2);">
                            <span class="visible-xs"><i class="md md-school"></i></span>
                            <span class="hidden-xs">Aceptados</span>
                        </a>
                    </li>
                   
                    <li class="">
                        <a data-toggle="tab" aria-expanded="false" onclick="cargar_formularioRH(3);">
                            <span class="visible-xs"><i class="md md-people"></i></span>
                            <span class="hidden-xs">Rechazados</span>
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" aria-expanded="false" onclick="cargar_formularioRH(4);">
                            <span class="visible-xs"><i class="ion ion-clipboard"></i></span>
                            <span class="hidden-xs">En Vacaciones</span>
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

@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
    <!-- Script -->    
        <script src="{{asset('assets/js/RH.js')}}"></script>
        <script src="{{asset('assets/js/RHjs/ListadoVP.js')}}"></script>

          <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>




    <!-- Listados -->
        <script>cargar_formularioRH(1);</script>

@endsection