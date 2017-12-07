@extends ('layouts.index')
@section('estilos')
    @parent
    <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
    <style >
input[type=textt] {

    background: transparent;
    width: 100%;
    border: 0px;outline:none;
    text-align: justify;
    text-justify:inter-word;
    background-color: #ffff90;
}
    </style>
@endsection
@section ('contenido')
@include('rrhh.show')
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
      <button id="btnupsolicitud" type="button" class="btn btn-primary" >Guardar cambios</button>
      <a href="{{URL::action('RHPrecalificado@precali',$empleado->idempleado)}}"><button type="button" class="btn btn-primary" >Pre-calificar</button></a>
      <a> 
          <button type="button" id="btnrechazo" 
            onclick='
            swal({
                title: "¿Está seguro de Rechazar la solicitud?",
                text: "Usted rechazara la solicitud de empleo",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "¡Si!",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false },

                function(isConfirm){
                if (isConfirm) 
                {
                  swal(
                    {
                      title: "¡Hecho!",
                      text: "Solicitud rechazada con éxito!!!",
                      type: "success"
                    },
                    function()
                    {
                      window.location.href="{{url("empleado/rechazopc",array("id"=>$empleado->idempleado,"ids"=>$empleado->idstatus))}}";
                      //window.location.href="{{url("empleado/pre_calificados")}}";
                    }
                  ); 
                }

                else {
                swal("¡Cancelado!",
                "No se ha realizado algún cambio...",
                "error");
                }
                });
            ' 
          class="btn btn-primary btnrechazo">Rechazar</button>
      </a>
      <a href="{{url('empleado/pre_calificados')}}"><button type="button" class="btn btn-primary">Regresar</button></a>
    </div>

     <div class="col-lg-12">
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="inputTitle"></h4>
              </div>
              <div class="modal-body">
              <form role="form" id="formAgregar">
                      <div class="form-group">
                          <label>Observacion</label>
                          <textarea maxlength="300" class="form-control" id="observacion" name="observacion"></textarea>
                      </div>  
              </form>                                                                       

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="erroresModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Errores</h4>
          </div>

          <div class="modal-body">
            <ul style="list-style-type:circle" id="erroresContent"></ul>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('fin')
    @parent

    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('assets/js/RHjs/updsolicitud.js')}}"></script>
    <script src="{{asset('assets/js/RHjs/comentariosRH.js')}}"></script>
@endsection