@extends ('layouts.index')
@section('estilos')
    @parent
    
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
@endsection
@section ('contenido')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="col-sm-6 col-lg-4">
        <div class="card-box m-t-0 m-b-30">
            <a href="{{url('/empleado/solicitudes')}}"><button>Solicitud</button></a>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card-box m-t-0 m-b-30">
            <a href=""><button>Pre-Entrevista</button></a>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card-box m-t-0 m-b-30">
            <a href=""><button>Pre-Calificados</button></a>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card-box m-t-0 m-b-30">
            <button>Resultados</button>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card-box m-t-0 m-b-30">
            <button>Entrevista</button>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card-box m-t-0 m-b-30">
            <button>Nombramiento 1</button>
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