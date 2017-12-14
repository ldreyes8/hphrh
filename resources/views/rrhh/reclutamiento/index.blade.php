@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
@endsection
@section ('contenido')

<div class="row">
    
@role('jfreclutamiento')
    <h3>Reclutamiento</h3>
    <div class="col-sm-4 col-xs-12">
                                <div class="card m-b-2 card-inverse" style="background-color: #333; border-color: #333;">
                                    <div class="card-box" style="background-color: #333; border-color: #333;">
                                        <h3 class="mt-0" style="color:#FFFFFF" >Solicitudes de empleo</h3>
                                        <a href="{{url('/empleado/solicitudesjf')}}" class="btn btn-primary">Ir</a>
                                    </div>
                                </div>
                            </div>
    <div class="col-sm-4 col-xs-12">
                                <div class="card m-b-2 card-inverse" style="background-color: #0275d8; border-color: #0275d8;">
                                    <div class="card-box" style="background-color: #0275d8; border-color: #0275d8;">
                                        <h3 class="mt-0" style="color:#FFFFFF" >Pre Entrevista</h3>
                                        <a href="{{url('/empleado/pre_entrevistadoji')}}" class="btn btn-primary">Ir</a>
                                    </div>
                                </div>
                            </div>
    <div class="col-sm-4 col-xs-12">
                                <div class="card m-b-2 card-inverse" style="background-color: #5cb85c; border-color: #5cb85c;">
                                    <div class="card-box" style="background-color: #5cb85c; border-color: #5cb85c;">
                                        <h3 class="mt-0" style="color:#FFFFFF" >Pre Calificados</h3>
                                        <a href="{{url('/empleado/pre_calificadosjf')}}" class="btn btn-primary">Ir</a>
                                    </div>
                                </div>
                            </div>
@endrole

@role('rhreclutamiento')
    <h3>Reclutamiento de personal Nacional</h3>
    <div class="col-sm-4 col-xs-12">
                                <div class="card m-b-2 card-inverse" style="background-color: #333; border-color: #333;">
                                    <div class="card-box" style="background-color: #333; border-color: #333;">
                                        <h3 class="mt-0" style="color:#FFFFFF" >Solicitudes de empleo</h3>
                                        <a href="{{url('/empleado/solicitudes')}}" class="btn btn-primary">Ir</a>
                                    </div>
                                </div>
                            </div>
    <div class="col-sm-4 col-xs-12">
                                <div class="card m-b-2 card-inverse" style="background-color: #0275d8; border-color: #0275d8;">
                                    <div class="card-box" style="background-color: #0275d8; border-color: #0275d8;">
                                        <h3 class="mt-0" style="color:#FFFFFF" >Pre Entrevista</h3>
                                        <a href="{{url('/empleado/pre_entrevistado')}}" class="btn btn-primary">Ir</a>
                                    </div>
                                </div>
                            </div>
    <div class="col-sm-4 col-xs-12">
                                <div class="card m-b-2 card-inverse" style="background-color: #5cb85c; border-color: #5cb85c;">
                                    <div class="card-box" style="background-color: #5cb85c; border-color: #5cb85c;">
                                        <h3 class="mt-0" style="color:#FFFFFF" >Pre Calificados</h3>
                                        <a href="{{url('/empleado/pre_calificados')}}" class="btn btn-primary">Ir</a>
                                    </div>
                                </div>
                            </div>
    <div class="col-sm-4 col-xs-12">
                                <div class="card m-b-2 card-inverse" style="background-color: #5bc0de; border-color: #5bc0de;">
                                    <div class="card-box" style="background-color: #5bc0de; border-color: #5bc0de;">
                                        <h3 class="mt-0" style="color:#FFFFFF" >Resultado de evaluaciones</h3>
                                        <a href="{{url('/empleado/resultadosev')}}" class="btn btn-inverse">Ir</a>
                                    </div>
                                </div>
                            </div>
    <div class="col-sm-4 col-xs-12">
                                <div class="card m-b-2 card-inverse" style="background-color: #f0ad4e; border-color: #f0ad4e;">
                                    <div class="card-box" style="background-color: #f0ad4e; border-color: #f0ad4e;">
                                        <h3 class="mt-0" style="color:#FFFFFF" >Proceso de entrevista</h3>
                                        <a href="{{url('/empleado/listadoen')}}" class="btn btn-primary">Ir</a>
                                    </div>
                                </div>
                            </div>
    <div class="col-sm-4 col-xs-12">
                                <div class="card m-b-2 card-inverse" style="background-color: #d9534f; border-color: #d9534f;">
                                    <div class="card-box" style="background-color: #d9534f; border-color: #d9534f;">
                                        <h3 class="mt-0" style="color:#FFFFFF" >Nombramiento</h3>
                                        <a href="{{url('/empleado/listadon1')}}" class="btn btn-primary">Ir</a>
                                    </div>
                                </div>
                            </div>

@endrole  
@role('evaluador')
    <h3>Asignar notas a personal aspirante a un puesto</h3>
    <div class="col-sm-4 col-xs-12">
        <div class="card m-b-2 card-inverse" style="background-color: #5bc0de; border-color: #5bc0de;">
            <div class="card-box" style="background-color: #5bc0de; border-color: #5bc0de;">
                <h3 class="mt-0" style="color:#FFFFFF" >Asignar notas</h3>
                <a href="{{url('/empleado/resultados')}}" class="btn btn-inverse">Ir</a>
            </div>
        </div>
    </div>
@endrole  
</div>

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