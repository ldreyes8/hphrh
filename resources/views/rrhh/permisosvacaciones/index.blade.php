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
                    <li class="active"> <a href="javascript:void(0);" onclick="cargarpvsolicitudes(1,1);">
                    
                        <a href="#pvsolicitados" data-toggle="tab" aria-expanded="false" >
                            <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                            <span class="hidden-xs">Solicitados</span>
                        </a>
                    </li>
                    <li class=""> <a href="javascript:void(0);" onclick="cargarpvaceptados(1,1);">
                    
                        <a href="#pvaceptados" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="md md-school"></i></span>
                            <span class="hidden-xs">Aceptados</span>
                        </a>
                    </li>
                   
                    <li class=""> <a href="javascript:void(0);" onclick="cargarpvrechazados(1,1);">

                        <a href="#pvrechazados" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="md md-people"></i></span>
                            <span class="hidden-xs">Rechazados</span>
                        </a>
                    </li>
                    <li class=""> <a href="javascript:void(0);" onclick="cargarpvconfirmados(1,1);">

                        <a href="#pvconfirmados" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="ion ion-clipboard"></i></span>
                            <span class="hidden-xs">En Vacaciones</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    @include('rrhh.permisosvacaciones.indexsolicitados')
                    @include('rrhh.permisosvacaciones.indexconfirmado')
                    @include('rrhh.permisosvacaciones.indexrechazado')
                    @include('rrhh.permisosvacaciones.indexautorizado')
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
        <script src="{{asset('assets/js/RH.js')}}"></script>
        <script src="{{asset('assets/js/listadorrhh1.js')}}"></script>
    <!-- Listados -->
        <script>cargarpvsolicitudes(1);</script>
        <script>cargarpvaceptados(1);</script>
        <script>cargarpvrechazados(1);</script>
        <script>cargarpvconfirmados(1);</script>
@endsection