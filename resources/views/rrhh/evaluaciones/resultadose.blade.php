@extends ('layouts.index')
@section('estilos')
    @parent
    <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section ('contenido')
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <label >Nombre Completo</label>
        <div class="row">
          <div class="form-group">
            <label>{{$persona->nombre1.' '.$persona->nombre2.' '.$persona->apellido1.' '.$persona->apellido2}}</label>
          </div> 
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="form-group">
        <label >Identificación</label>
          <div class="row">
            <div class="form-group">
              <label>{{$persona->identificacion}}</label>
            </div> 
          </div>
        <input type="hidden" id="idempleado" value="{{$persona->idempleado}}">
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="form-group">
      <label>Puesto</label>
        <div class="row">
          <div class="form-group">
            <label>{{$persona->puesto}}</label>
          </div> 
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="form-group">
      <label>Afiliado</label>
        <div class="row">
          <div class="form-group">
            <label>{{$persona->afiliado}}</label>
          </div> 
        </div>
      </div>
    </div>
  </div>


  <div class="table-responsive">  
    <table id="detallesF" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
      <p><h2 ALIGN=center>Resultados</h2></p>
      <thead style="background-color:#A9D0F5">
        <th>Nombre evaluador</th>
        <th>Area</th>
        <th>Nota</th>
        <th>Observación</th>
      </thead>
      <tbody>
        @foreach($resultados as $res)
          <tr class="filaTableF">
            <td>{{$res->nombre1.' '.$res->nombre2.' '.$res->apellido1.' '.$res->apellido2}}</td>
            <td>{{$res->unidadadmin}}</td>
            <td>{{$res->nota}}</td>
            <td>{{$res->observacion}}</td>
          </tr>
        @endforeach
        <td>Promedio 
          <td></td>
          @if (!empty($promedio->promed))
            <td>{{$promedio->promed}}</td>
          @else
            <td>No tiene notas ingresadas</td>
          @endif
        </td>
      </tbody>
    </table>
  </div>

  <div class="row">
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
                      window.location.href="{{url("empleado/rechazoe",array("id"=>$persona->idempleado,"ids"=>$persona->idstatus))}}";
                      //window.location.href="{{url("empleado/resultadosev")}}";
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
        <a><button type="button" class="btn btn-primary" 
                  onclick='
                    swal({
                      title: "¿Entrevistar?",
                      text: "Esta seguro de entrevistar a este usuario",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "¡Si!",
                      cancelButtonText: "No",
                      closeOnConfirm: false,
                      closeOnCancel: false 
                      },
                      function(isConfirm){
                        if (isConfirm) 
                        {
                          swal(
                            {
                              title: "¡Hecho!",
                              text: "Ahora podra entrevistar al usuario!!!",
                              type: "success"
                            },
                            function()
                            {
                              location.href=("{{URL::action("RHEntrevista@entrevista",$persona->idempleado)}}");
                            }
                          ); 
                        }

                        else 
                        {
                          swal("¡Cancelado!",
                          "No se ha realizado cambios...",
                          "error");
                        }
                      });
                    ' 

      >Enviar a entrevista</button></a>
    </div>
@endsection
@section('fin')
    @parent

    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection