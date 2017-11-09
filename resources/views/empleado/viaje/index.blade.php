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
                        <ul>
                            <li>
                                <a onclick="cargar_formularioviaje(1);"><img src="{{asset('assets/images/viaje.jpg')}}"/></a>
                                <span>Apertura Viaje</span>
                            </li>
                            <li>
                                <!--<a onclick="cargar_formularioviaje(2);"><img src="{{asset('assets/images/laravel.png')}}"/></a>-->
                                <a><img src="{{asset('assets/images/liquidar.jpg')}}"/></a>
                                <span>Caja chica</span>
                            </li>
                            <li>
                                <span>Aperturar caja chica</span>
                                <a href="#"><img src="{{asset('assets/images/chrome.png')}}"/></a>
                            </li>
                            <li>
                                <span>Liquidación caja chica</span>
                                <a href="#"><img src="{{asset('assets/images/danger.png')}}"/></a>
                            </li>
                            <!--Funciones de la encargada de caja chica -->
                            <li>
                                <span>Solicitar caja chica</span>
                            </li>
                        </ul>
                    </div>
                </div>

               <!--
                <ul class="nav nav-tabs navtab-custom">
                    <li class="active" data-toggle="tab" aria-expanded="false">
                    <a data-toggle="tab" aria-expanded="false" onclick="cargar_formulario(1);">
                            <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                            <span class="hidden-xs">Apertura Viaje</span>
                        </a>
                    </li>
                    <li class="">
                    <a data-toggle="tab" aria-expanded="false" onclick="cargar_formulario(2);">
                            <span class="visible-xs"><i class="md md-school"></i></span>
                            <span class="hidden-xs">Liquidaci&oacute;n</span>
                        </a>
                    </li>
                </ul>
                -->

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
        <script src="{{asset('assets/js/Empleado/cargarmodal.js')}}"></script>
           <!-- Examples -->
        <script src="{{asset('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>

        <script src="{{asset('assets/plugins/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
        <script src="{{asset('assets/plugins/tiny-editable/mindmup-editabletable.js')}}"></script>

          <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>



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
                //$('#formModificar').trigger("reset");
                $('#formAgregarViaje').trigger('reset');
                $('#formModal').modal('show');
            }); 
        </script>

 
@endsection