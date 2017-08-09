@extends ('layouts.index')
@section('estilos')
    @parent
    <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
@endsection
@section ('contenido')
    @include('rrhh.reclutamiento.indexb')
@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
         <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

@endsection