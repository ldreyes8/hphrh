@extends ('layouts.index')
@section('estilos')
    @parent
         <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
         <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css')}}" rel="stylesheet" type="text/css" media="screen">


@endsection
@section ('contenido')

<div class="row"> 
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="">
            <ul class="nav nav-tabs navtab-custom">
                
                <li class="active"><a href="javascript:void(0);" onclick="cargarvacaciones(1,1);">
                    <a href="#profile" data-toggle="tab" aria-expanded="true" >
                        <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                        <span class="hidden-xs">Vacaciones</span>
                    </a>
                </li>

                <li class=""><a href="javascript:void(0);" onclick="cargarpermisos(1,1);">
                    <a href="#permiso" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="md md-school"></i></span>
                        <span class="hidden-xs">Permisos</span>
                    </a>
                </li>

                <li class="">
                    <a href="javascript:void(0);" onclick="cargarconstancia(1,1);">
                    <a href="#consta" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="md md-people"></i></span>
                        <span class="hidden-xs">Constancias de Goce Vacaciones</span>
                    </a>
                </li>
            </ul>
        
            <div class="tab-content">
                @include('empleado.empleado.vacaciones')
                @include('empleado.empleado.permisos')
                @include('empleado.empleado.constancias')
            </div>
        </div>
    </div>
</div>
@endsection

@section('fin')
    @parent

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
    <script src="{{asset('assets/js/fecha.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>

    <script src="{{asset('assets/js/listadoautorizacionesVP.js')}}"></script>
    <script>cargarvacaciones(1);</script>
    <script>cargarpermisos(1);</script>
    <script>cargarconstancia(1);</script> 

@endsection