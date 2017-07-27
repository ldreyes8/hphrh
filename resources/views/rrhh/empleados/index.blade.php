@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />

@endsection
@section ('contenido')
    
                        <div class="div_contenido">
                            <div class="margin" id="botones_control">
                                <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formularioRH(1);">  Listado General</a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formularioRH(2);" >Renuncias o Despidos</a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formularioRH(3);" >Aspirantes rechazados</a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formularioRH(4);" >Nombramientos y/o asecensos</a>
                            </div>
                            <div><br></div>
                        </div>

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



    <script>cargar_formularioRH(1);</script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();        
        });
    </script>
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