@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />

@endsection
@section ('contenido')<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="">
                                <div class="">
                                    <ul class="nav nav-tabs navtab-custom">
                                        <li class="active" data-toggle="tab" aria-expanded="false">
                                            <a data-toggle="tab" aria-expanded="false" onclick="cargar_formularioRH(1);">
                                                <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                                                <span class="hidden-xs">Listado General</span>
                                            </a>
                                        </li>

                                        <li class="">
                                            <a data-toggle="tab" aria-expanded="false" onclick="cargar_formularioRH(2);">
                                                <span class="visible-xs"><i class="md md-school"></i></span>
                                                <span class="hidden-xs">Renuncias o Despidos</span>
                                            </a>
                                        </li>
                                       
                                        <li class="">
                                            <a data-toggle="tab" aria-expanded="false" onclick="cargar_formularioRH(3);">
                                                <span class="visible-xs"><i class="md md-people"></i></span>
                                                <span class="hidden-xs">Aspirantes rechazados</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" aria-expanded="false" onclick="cargar_formularioRH(4);">
                                                <span class="visible-xs"><i class="ion ion-clipboard"></i></span>
                                                <span class="hidden-xs">Nombramientos y/o asecensos</span>
                                            </a>
                                        </li>
                                    </ul>

                                    

                                    <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
                                    <div id="capa_modal" class="div_modal" style="display: none;"></div>
                                    <div id="capa_formularios" class="div_contenido" style="display: none;"></div>
                                </div>
                            </div> <!-- end -->
                        <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
                        <div id="capa_modal"></div>
                        <div id="capa_formularios"></div>
@endsection
@section('fin')
    @parent
        <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="{{asset('assets/js/RHjs/listados.js')}}"></script>
        <script src="{{asset('assets/js/RH.js')}}"></script>

        <script src="{{asset('assets/js/RHjs/busqueda.js')}}"></script>
        <script src="{{asset('assets/js/RHjs/nombramiento.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>


        <script>cargar_formularioRH(1);</script>
      
        <script type="text/javascript">

            function buscarsolicitud(){
                //var rol=$("#select").val();
                var dato=$("#searchText").val();
                /*if(dato == "")
                {
                var url="busqueda/"+rol+"";
                }
                else
                {*/
                    var url="busquedas/"+dato+"";
                //}
                $("#listadoSol").html($("#cargador_empresa").html());
                $.get(url,function(resul){
                    $("#listadoSol").html(resul);  
                })
            }

            function anular(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                return (tecla != 13);
            }
        </script>
@endsection