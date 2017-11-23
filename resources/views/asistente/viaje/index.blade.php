@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/minimalista.css')}}" rel="stylesheet" />   
@endsection
@section ('contenido')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="dock-container" class="">
            <div class="panel-body">
                <ul>
                    <li>
                        <a onclick="cargar_formularioviaje(25);"><img src="{{asset('assets/images/autorizados.png')}}"/></a>
                        <span>Solicitados</span>
                    </li>
                    <li>
                        <a onclick="cargar_formularioviaje(23);"><img src="{{asset('assets/images/revisados.png')}}"/></a>
                        <span>Autorizados</span>
                    </li>
                </ul>
            </div>
        </div>
        <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
        <div id="capa_modal" class="div_modal" style="display: none;"></div>
        <div id="capa_formularios" class="div_contenido" style="display: none;"></div>
    </div>
</div>
@endsection
@section('fin')
    @parent
        <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="{{asset('assets/js/perfil/solicitud.js')}}"></script>
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
        <script src="{{asset('assets/js/Empleado/cargaravance.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".select2").select2();        
            });
        </script>
        <script>
            $(document).ready(function(){
                var hdrht = ($(window).height()) - ($("#site-header").height());
                $(".wrapper").height(hdrht);
            });
        </script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-68852337-1', 'auto');
            ga('send', 'pageview');
        </script>
        <script type="text/javascript">
            $(document).on('click','.btn-openviaje',function(e){
                $('#inputTitleViaje').html("Nuevo viaje");
                $('#formAgregarViaje').trigger('reset');
                $('#formModal').modal('show');
            }); 
        </script>
@endsection