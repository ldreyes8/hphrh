@extends ('layouts.index')
@section('estilos')
    @parent

        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />

        
@endsection
@section ('contenido')

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="">
            <div class="">
                <ul class="nav nav-tabs navtab-custom">

                   

                    <li class="active" data-toggle="tab" aria-expanded="false">
                        <a data-toggle="tab" aria-expanded="false" onclick="cargar_formulario(1);">
                            <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                            <span class="hidden-xs">Vacaciones</span>
                        </a>
                    </li>

                    <li class="">
                        <a data-toggle="tab" aria-expanded="false" onclick="cargar_formulario(2);">
                            <span class="visible-xs"><i class="md md-school"></i></span>
                            <span class="hidden-xs">Permisos</span>
                        </a>
                    </li>
                   
                    <li class="">
                        <a data-toggle="tab" aria-expanded="false" onclick="cargar_formulario(3);">
                            <span class="visible-xs"><i class="md md-people"></i></span>
                            <span class="hidden-xs">Constancias de Goce Vacaciones</span>
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
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
        <script>cargar_formulario(1);</script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".select2").select2();        
            });
        </script>
@endsection