@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/minimalista.css')}}" rel="stylesheet" />

        <link rel="stylesheet" href="{{asset('assets/plugins/magnific-popup/dist/magnific-popup.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatables-editable/datatables.css')}}" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        
@endsection
@section ('contenido')


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="dock-container" class="">
            <div class="panel-body">
                <ul><!--
                    <li>
                        <a onclick="cargar_formularioasistente(1);"><img src="{{asset('assets/images/viaje.png')}}"/></a>
                        <span>Apertura caja chica</span>
                    </li>-->
                    <li>
                        <a onclick="cargar_formularioviaje(2);"><img src="{{asset('assets/images/liquidar.png')}}"/></a>
                        <span>Enviar reporte</span>
                    </li>
                    <li>
                        <a onclick="cargar_formularioviaje(4);"><img src="{{asset('assets/images/historial.png')}}"/></a>
                        <span>Historial</span>
                    </li>
                </ul>
            </div>
        </div>

        <div id="capa_formularios" class="div_modal">
            @include('empleado.viaje.retornaindex')
        </div>

        <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
    </div>
</div>
@endsection
@section('fin')
    @parent
        <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="{{asset('assets/js/perfil/solicitud.js')}}"></script>
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />


        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
        <script src="{{asset('assets/js/Empleado/cargaravance.js')}}"></script>
           <!-- Examples -->
        <script src="{{asset('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>

        <script src="{{asset('assets/plugins/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
        <script src="{{asset('assets/plugins/tiny-editable/mindmup-editabletable.js')}}"></script>

          <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
        <script src="{{asset('assets/js/valida.js')}}"></script>



        <script type="text/javascript">
            $(document).ready(function() {
                $(".select2").select2();        
        
                var hdrht = ($(window).height()) - ($("#site-header").height());
                $(".wrapper").height(hdrht);
            });
        </script>
@endsection