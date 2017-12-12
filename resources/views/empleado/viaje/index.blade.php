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
                                <a onclick="openmodal();"><img src="{{asset('assets/images/viaje.png')}}"/></a>
                                <span>Apertura avance</span>
                    </li>
                    <li>
                                <!--<a onclick="cargar_formularioviaje(2);"><img src="{{asset('assets/images/laravel.png')}}"/></a>-->
                                <a onclick="cargar_formularioviaje(2);"><img src="{{asset('assets/images/liquidar.png')}}"/></a>
                                <span>Liquidar</span>
                    </li>
                    <li>
                                <span>Historial</span>
                                <a onclick="cargar_formularioviaje(4);"><img src="{{asset('assets/images/historial.png')}}"/></a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="capa_formularios" class="div_modal">
            @include('empleado.viaje.retornaindex')
        </div>

        <div class="col-lg-12 col-md-12" id="modalMS">
                    <div class="modal fade" id="formModalMS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" align="center" id="inputTitleMS"></h4>
                                </div>

                                <form role="form" id="formMS">
                                    <div class="modal-header">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Monto a solicitar</label>
                                            <input id="MSinicial" type="number" min="0" value="0" class="form-control"  onkeypress="return validadecimal(event,this)">
                                        </div>
                                    </div>
                                </form>

                                <div class="modal-footer">
                                    <div class="col-md-12">
                                        <div><br></div>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="button" id="MontoIni" class="btn btn-primary waves-effect waves-light btn-Montos">Enviar</i></button>
                                        <input type="hidden" id="idmontos" value="0"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

            function openmodal(){

            $('#inputTitleMS').html("Monto a solicitar");
            $('#formMS').trigger("reset");
            $('#formModalMS').modal('show');
            //cargar_formularioviaje(1);
            }

            $('#MontoIni').click(function(e) {
                var minicial = $("#MSinicial").val();

                if(minicial > 0)
                {
                    $('#formModalMS').modal('hide');
                    if(minicial >  500)
                    {
                        cargar_formularioviaje(1);
                    }
                    else{
                        cargar_formularioviaje(5);
                        //alert("actualmente no se cuenta con este formulario esperamos que regrese pronto gracias :) ");
                    }
   
                }
                else{
                    alert("debe de ingresar un monto inical razonable");
                }

            });
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