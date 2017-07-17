@extends ('layouts.index')
@section('estilos')
    @parent

        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        
@endsection
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Solicitudes</h3>
        </div>   
    </div>
    <div class="div_contenido">
        <div class="margin" id="botones_control"> 
            <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(1);"> Vacaciones</a> 
            <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(2);" >Permisos</a>
            <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(3);" >Constancias de Goce Vacaciones</a>
        </div>
        <div><br></div>
    </div>

    <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
    <div id="capa_modal" class="div_modal" style="display: none;"></div>
    <div id="capa_formularios" class="div_contenido" style="display: none;"></div>
@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('assets/js/perfil/solicitud.js')}}"></script>
    <script>cargar_formulario(1);</script>


@endsection