@extends ('layouts.index')
@section('estilos')
    @parent
    <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
    <style >
input[type=text] {

    background: transparent;
    width: 100%;
    border: 0px;outline:none;
    text-align: justify;
    text-justify:inter-word;
}
    </style>
@endsection
@section ('contenido')
<form  role="form" id="formUpdate" >
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <label >Nombre Completo</label>
        <div class="row">
          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <input type="text" id="nombre1" value="{{$persona->nombre1}}">
                <input type="text" id="apellido1" value="{{$persona->apellido1}}">
            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <input type="text" id="nombre2" value="{{$persona->nombre2}}">
                <input type="text" id="apellido2" value="{{$persona->apellido2}}">
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="form-group">
        <label >Identificación</label>
        <input type="text" id="identificacionup" value="{{$empleado->identificacion}}">
        <input type="hidden" id="idempleado" value="{{$empleado->idempleado}}">
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="form-group">
      <label>Nit</label>
        <input type="text" id="nit" value="{{$empleado->nit}}">
      </div>
    </div>
  </div>

    <div class="row">
      <div class="table-responsive">
            <table id="detalles" class="table table-striped m-b-0 table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Datos Personales</h2></p>
              <thead style="background-color:#A9D0F5">
                <th>Direccion </th>
                <th>Telefono</th>
                <th>Fecha Nacimiento</th>
                <th>Departamento</th>
                <th>Municipio</th>
                <th>Estado Civil</th>
                <th>Afiliado</th>
                <th>Puesto Aplicar</th>
                <th>IGSS</th>

                <th>Dependientes</th>
                <th>Aporte Mensual</th>
                <th>Vivienda</th>
                <th>Alquiler Mensual</th>
                <th>Otros Ingresos</th>
                <th>Pretension</th>
                <th>Fecha Solicitud</th>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" name="" id="barriocolonia" value="{{$persona->barriocolonia}} "></td>
                  <td><input type="text" name="" id="telefono" value="{{$persona->telefono}}"></td>
                  <td><input type="text" name="" id="fechanac" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $persona->fechanac)->format('d-m-Y')}}"></td>
                  @if (!empty($persona->departamento))
                    <td><input type="text" name="" id="departamento" value="{{$persona->departamento}}"></td>
                    <td><input type="text" name="" id="municipio" value="{{$persona->municipio}}"></td>
                  @else
                    <td><input type="text" name="" id="departamento" value=""></td>
                    <td><input type="text" name="" id="municipio" value=""></td>
                  @endif
                  <td><input type="text" name="" value="{{$empleado->estadocivil}}"></td>
                  <td><input type="text" name="" value="{{$persona->afiliado}}"></td>
                  <td><input type="text" name="" value="{{$persona->puesto}}"></td>
                  <td><input type="text" name="" id="iggs" value="{{$empleado->afiliacionigss}}"></td>

                  <td><input type="text" name="" id="dependientes" value="{{$empleado->numerodependientes}}"></td>
                  <td><input type="text" name="" id="aportemensual" value="{{$empleado->aportemensual}}"></td>
                  <td><input type="text" name="" id="vivienda" value="{{$empleado->vivienda}}"></td>
                  <td><input type="text" name="" id="alquilermensual" value="{{$empleado->alquilermensual}}"></td>
                  <td><input type="text" name="" id="otrosingresos" value="{{$empleado->otrosingresos}}"></td>
                  <td>{{$empleado->pretension}}</td>
                  <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$empleado->fechasolicitud)->format('d-m-Y')}}</td>
                </tr>
              </tbody>
            </table>
      </div>
      <div class="form-group">
          <label>Observacion</label>
          <textarea maxlength="300" class="form-control" id="observacionP" name=""></textarea>
      </div>
      <div class="table-responsive">  
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Datos Familiares</h2></p>
              <thead style="background-color:#A9D0F5">
                <th>Nombre</th>
                <th>Parentezco</th>
                <th>Telefono</th>
                <th>Ocupacion</th>
                <th>Edad</th>
              </thead>
     
              <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tfoot>
              <tbody>
              @foreach($familiares as $fam)
                <tr>
                  <td><input type="text" name="" value="{{$fam->nombref}}"></td>
                  <td><input type="text" name="" value="{{$fam->parentezco}}"></td>
                  <td><input type="text" name="" value="{{$fam->telefonof}}"></td>
                  <td><input type="text" name="" value="{{$fam->ocupacion}}"></td>
                  <td><input type="text" name="" value="{{$fam->edad}}"></td>
                </tr>
                @endforeach
              </tbody>
            </table>
      </div>
      <div class="form-group">
          <label>Observacion</label>
          <textarea maxlength="300" class="form-control" id="observacionF" name=""></textarea>
      </div>
            <!-- -->
      <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Datos Academicos</h2></p>
              <thead style="background-color:#A9D0F5">
                <th>Titulo</th>
                <th>Institucion</th>
                <th>Duracion</th>
                <th>Nivel</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
              </thead>
     
              <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tfoot>
              <tbody>
                @foreach($academicos as $aca)
                <tr>
                  <td><input type="text" name="" value="{{$aca->titulo}}"></td>
                  <td><input type="text" name="" value="{{$aca->establecimiento}}"></td>
                  <td><input type="text" name="" value="{{$aca->duracion}}"></td>
                  <td><input type="text" name="" value="{{$aca->nivel}}"></td>
                  <td><input type="text" name="" value="{{$aca->fingreso}}"></td>
                  <td><input type="text" name="" value="{{$aca->fsalida}}"></td>
                 </tr>
                 @endforeach
              </tbody>
              <thead style="background-color:#A9D0F5">
                <th>Idiomas Que Maneja</th>
                <th>Nivel</th>
                <tfoot>
                  <th></th>
                  <th></th>
                </tfoot>
                <tbody>
                  @foreach($idiomas as $idi)
                  <tr>
                   <td><input type="text" name="" value="{{$idi->idioma}}"></td>
                   <td><input type="text" name="" value="{{$idi->nivel}}"></td>                
                  </tr>
                  @endforeach              
                </tbody>
              </thead>
            </table>
      </div>
      <div class="form-group">
          <label>Observacion</label>
          <textarea maxlength="300" class="form-control" id="observacionaA" name=""></textarea>
      </div>
      <div class="table-responsive">      
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Referencia Personales Y Laborales</h2></p>
              <thead style="background-color:#A9D0F5">
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Profesion</th>
                <th>tiporeferencia</th>
              </thead>
     
              <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tfoot>
              <tbody>
              @foreach($referencias as $ref)
                <tr>
                  <td><input type="text" name="" value="{{$ref->nombrer}}"></td>
                  <td><input type="text" name="" value="{{$ref->telefonor}}"></td>
                  <td><input type="text" name="" value="{{$ref->profesion}}"></td>
                  <td><input type="text" name="" value="{{$ref->tiporeferencia}}"></td>
                </tr>
                @endforeach
              </tbody>
            </table>
      </div>
      <div class="form-group">
          <label>Observacion</label>
          <textarea maxlength="300" class="form-control" id="observacionR" name=""></textarea>
      </div>
      <div class="table-responsive">    
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Experiencia Laboral</h2></p>
              <thead style="background-color:#A9D0F5">
                <th>Empresa</th>
                <th>Puesto</th>
                <th>Jefe Inmediato</th>
                <th>Motivo Retiro</th>
                <th>Ultimo Salario</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
              </thead>
     
              <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tfoot>
              <tbody>
                @foreach($experiencias as $exp)
                <tr>
                  <td><input type="text" name="" value="{{$exp->empresa}}"></td>
                  <td><input type="text" name="" value="{{$exp->puesto}}"></td>
                  <td><input type="text" name="" value="{{$exp->jefeinmediato}}"></td>
                  <td><input type="text" name="" value="{{$exp->motivoretiro}}"></td>
                  <td><input type="text" name="" value="{{$exp->ultimosalario}}"></td>
                  <td><input type="text" name="" value="{{$exp->fingresoex}}"></td>
                  <td><input type="text" name="" value="{{$exp->fsalidaex}}"></td>
                 </tr>
                 @endforeach
              </tbody>
            </table>
      </div>
      <div class="form-group">
          <label>Observacion</label>
          <textarea maxlength="300" class="form-control" id="observacionE" name=""></textarea>
      </div>
      <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Deudas</h2></p>
              <thead style="background-color:#A9D0F5">
                <th>Acreedor</th>
                <th>amortizacion mensual</th>
                <th>Monto Deuda</th>
              </thead>
     
              <tfoot>
                <th></th>
                <th></th>
              </tfoot>
              <tbody>
                @foreach($deudas as $deu)
                <tr>
                  <td><input type="text" name="" value="{{$deu->acreedor}}"></td>
                  <td><input type="text" name="" value="{{$deu->pago}}"></td>
                  <td><input type="text" name="" value="{{$deu->montodeuda}}"></td>
                 </tr>
                 @endforeach
              </tbody>
            </table>
      </div>
      <div class="form-group">
          <label>Observacion</label>
          <textarea maxlength="300" class="form-control" id="observacionD" name=""></textarea>
      </div>
      <div class="table-responsive">
            <table id="detallesPad" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Padecimeintos</h2></p>
              <thead style="background-color:#A9D0F5">
                <th style="width: 1%">Id</th>
                <th>Padecimientos</th>
              </thead>
              <tbody>
                @foreach($padecimientos as $pad)
                <tr class="filaTable">
                  <td><input type="text" class="idpad" value="{{$pad->idppadecimientos}}"></td>
                  <td><input type="text" class="nombrepa" value="{{$pad->nombre}}"></td>
                </tr>
                 @endforeach
              </tbody>
            </table>
      </div>
      <div class="form-group">
          <label>Observacion</label>
          <textarea maxlength="300" class="form-control" id="observacionPad" name=""></textarea>
      </div>
      <div class="table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
          <p><h2 ALIGN=center>Experiencia en el extranjero</h2></p>
            <thead style="background-color:#A9D0F5">
              <th>Nombre</th>
              <th>Forma en la que trabajo</th>
              <th>Motivo de finalizacion</th>
              <th>País</th>
            </thead>
     
            <tfoot>
              <th></th>
            </tfoot>
            <tbody>
              @foreach($pais as $pas)
                <tr>
                  <td><input type="text" name="" value="{{$pas->trabajoext}}"></td>
                  <td><input type="text" name="" value="{{$pas->forma}}"></td>
                  <td><input type="text" name="" value="{{$pas->motivofin}}"></td>
                  <td><input type="text" name="" value="{{$pas->nombre}}"></td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
      <div class="form-group">
          <label>Observacion</label>
          <textarea maxlength="300" class="form-control" id="observacionEE" name=""></textarea>
      </div>
      <div class="table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
          <p><h2 ALIGN=center>Pariente Politio</h2></p>
            <thead style="background-color:#A9D0F5">
              <th>Nombre</th>
              <th>Puesto</th>
              <th>Dependencia</th>
            </thead>
            <tfoot>
              <th></th>
            </tfoot>
            <tbody>
              @foreach($pariente as $par)
                <tr>
                  <td><input type="text" name="" value="{{$par->nombre}}"></td>
                  <td><input type="text" name="" value="{{$par->puesto}}"></td>
                  <td><input type="text" name="" value="{{$par->dependencia}}"></td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
      <div class="form-group">
          <label>Observacion</label>
          <textarea maxlength="300" class="form-control" id="observacionPP" name=""></textarea>
      </div>
      <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Observaciones</h2></p>
              <thead style="background-color:#A9D0F5">
                <th>Observación</th>
              </thead>
     
              <tfoot>
                <th></th>
              </tfoot>
              <tbody>
                <tr>
                  <td>{{$empleado->observacion}}</td>
                 </tr>
              </tbody>
            </table>
      </div>
    </div>
      <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <button class="btn btn-info" type="button" id="btncomentario" >Agregar una observación</button>
                  </div>
                  <button id="btnupsolicitud" type="button" class="btn btn-primary" >Guardar cambios</button>
      </div>
</form>
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
    <script src="{{asset('assets/js/updsolicitud.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#btncomentario').click(function(){
      $('#inputTitle').html("Agregar observacion del solicitante");
      $('#formAgregar').trigger("reset");
      $('#formModal').modal('show');
  });

  $("#btnGuardar").click(function(e){
        var miurl="upt";

        var formData = {
            observacion: $("#observacion").val(),
            idempleado: $("#idempleado").val(),
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: miurl,
            data: formData,
            dataType: 'json',

            success: function (data) {
    
                $('#formModal').modal('hide');
                
            },
            error: function (data) {
                $('#loading').modal('hide');
                var errHTML="";
                if((typeof data.responseJSON != 'undefined')){
                    for( var er in data.responseJSON){
                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                    }
                }else{
                    errHTML+='<li>Error al borrar el &aacute;rea de atenci&oacute;n.</li>';
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });
    });
  
});
</script>


@endsection