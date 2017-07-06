@extends ('layouts.index')
@section('estilos')
    @parent
    
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
@endsection
@section ('contenido')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="">
            <div class="">
                <ul class="nav nav-tabs navtab-custom">
                    <li class="active"> <a href="javascript:void(0);" onclick="cargarsolicitudes(1,1);">
                        <a href="#listadoSol" data-toggle="tab" aria-expanded="false" >
                            <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                            <span class="hidden-xs">Solicitantes</span>
                        </a>
                    </li>

                    <li class=""> <a href="javascript:void(0);" onclick="cargaracademico(1,1);">
                        <a href="#academicos" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="md md-school"></i></span>
                            <span class="hidden-xs">Pre-Entrevista</span>
                        </a>
                    </li>
                   
                    <li class=""> <a href="javascript:void(0);" onclick="cargarechazados(1,1);">
                        <a href="#rechazadosf" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="md md-people"></i></span>
                            <span class="hidden-xs">Pre-Calificados</span>
                        </a>
                    </li>

                    <li class=""> <a href="javascript:void(0);" onclick="cargarechazados(1,1);">
                        <a href="#rechazadosf" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="md md-people"></i></span>
                            <span class="hidden-xs">Resultados</span>
                        </a>
                    </li>

                    <li class=""> <a href="javascript:void(0);" onclick="cargarechazados(1,1);">
                        <a href="#rechazadosf" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="md md-people"></i></span>
                            <span class="hidden-xs">Entrevista</span>
                        </a>
                    </li>

                    <li class=""> <a href="javascript:void(0);" onclick="cargarreferencia(1,1);">
                        <a href="#referencias" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="ion ion-clipboard"></i></span>
                            <span class="hidden-xs">Nombramiento 1</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    @include('rrhh.reclutamiento.solicitud')
             </div>
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
        <script src="{{asset('assets/js/listadosrrhh.js')}}"></script>
    <!-- Listados -->
        <script>cargarsolicitudes(1);</script>
@endsection