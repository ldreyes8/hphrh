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
                <th>Dirección </th>
                <th style="width: 4%">Teléfono</th>
                <th style="width: 6%">Fecha Nacimiento</th>
                <th>Departamento</th>
                <th>Municipio</th>
                <th style="width: 6%">Estado Civil</th>
                <th style="width: 7%">Afiliado</th>
                <th>Puesto Aplicar</th>
                <th style="width: 7%">IGSS</th>
                <th style="width: 6%">Dependientes</th>
                <th style="width: 5%">Aporte Mensual</th>
                <th style="width: 6%">Vivienda</th>
                <th style="width: 5%">Alquiler Mensual</th>
                <th style="width: 5%">Otros Ingresos</th>
                <th>Pretensión</th>
                <th style="width: 5%">Fecha de solicitud</th>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" id="barriocolonia" value="{{$persona->barriocolonia}} "></td>
                  <td><input type="text" id="telefono" maxlength="8" value="{{$persona->telefono}}"></td>
                  <td><input type="text" id="fechanac" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $persona->fechanac)->format('d-m-Y')}}"></td>
                  @if (!empty($persona->departamento))
                    <td>{{$persona->departamento}}</td>
                    <td>{{$persona->municipio}}</td>
                  @else
                    <td>Extranjero</td>
                    <td>Extranjero</td>
                  @endif
                  <td>
                    <select class="form-control selectpicker1">
                      
                      @foreach($estadocivil as $cat)
                        @if($cat->idcivil == $empleado->idcivil)
                          <option value="{{$cat->idcivil}}" selected>{{$cat->estado}}</option>
                        @else
                          <option value="{{$cat->idcivil}}">{{$cat->estado}}</option>
                        @endif
                      @endforeach
                    </select>
                  </td>
                  <td>{{$persona->afiliado}}</td>
                  <td>{{$persona->puesto}}</td>
                  <td><input type="text" maxlength="13" id="iggs" value="{{$empleado->afiliacionigss}}"></td>
                  <td><input type="text" id="dependientes" value="{{$empleado->numerodependientes}}"></td>
                  <td><input type="text" id="aportemensual" value="{{$empleado->aportemensual}}"></td>
                  <td><input type="text" id="vivienda" value="{{$empleado->vivienda}}"></td>
                  <td><input type="text" id="alquilermensual" value="{{$empleado->alquilermensual}}"></td>
                  <td><input type="text" id="otrosingresos" value="{{$empleado->otrosingresos}}"></td>
                  <td>{{$empleado->pretension}}</td>
                  <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$empleado->fechasolicitud)->format('d-m-Y')}}</td>
                </tr>
              </tbody>
            </table>
      </div>

      <div class="table-responsive">  
            <table id="detallesF" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Datos Familiares</h2></p>
              <thead style="background-color:#A9D0F5">
                <th style="width:0%"></th>
                <th>Nombre</th>
                <th>Parentezco</th>
                <th>Teléfono</th>
                <th>Ocupación</th>
                <th>Edad</th>
                <th>Emergencia</th>
              </thead>
              <tbody>
              @foreach($familiares as $fam)
                <tr class="filaTableF">
                  <td><input type="hidden" class="idpfamilia" value="{{$fam->idpfamilia}}"></td>
                  <td><input type="text" class="nombref" value="{{$fam->nombref}}"></td>
                  <td><input type="text" class="parentezco" value="{{$fam->parentezco}}"></td>
                  <td><input type="text" class="telefonof" value="{{$fam->telefonof}}"></td>
                  <td><input type="text" class="ocupacion" value="{{$fam->ocupacion}}"></td>
                  <td><input type="text" class="edad" value="{{$fam->edad}}"></td>
                  <td>{{$fam->emergencia}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
      </div>

      <div class="form-group">
          <label>Observación</label>
          <textarea maxlength="300" class="form-control" id="observacionF">{{$observaciones->obpf}}</textarea>
      </div>

            <!-- -->
      <div class="table-responsive">
            <table id="detallesA" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Datos Académicos</h2></p>
              <thead style="background-color:#A9D0F5">
                <th style="width: 1%"></th>
                <th>Título</th>
                <th>Institución</th>
                <th>Duración</th>
                <th>Nivel</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
              </thead>
              <tbody>
                @foreach($academicos as $aca)
                <tr class="filaTableA">
                  <td><input type="hidden" class="idpacademico" value="{{$aca->idpacademico}}"></td>
                  <td><input type="text" class="titulo" value="{{$aca->titulo}}"></td>
                  <td><input type="text" class="establecimiento" value="{{$aca->establecimiento}}"></td>
                  <td><input type="text" class="duracion" value="{{$aca->duracion}}"></td>
                  <td>
                    <select  class="form-control selectpicker" >
                        <option value="{{$aca->idnivel}}">{{$aca->nivel}}</option>
                        @foreach($nivelacademico as $ac)
                        <option value="{{$ac->idnivel}}">{{$ac->nombrena}}</option>
                        @endforeach
                    </select>
                  </td>
                  <td><input type="text" class="fingreso" value="{{$aca->fingreso}}"></td>
                  <td><input type="text" class="fsalida" value="{{$aca->fsalida}}"></td>
                 </tr>
                 @endforeach
              </tbody>
              <thead style="background-color:#A9D0F5">
                <th></th>
                <th>Idiomas Que Maneja</th>
                <th>Nivel</th>
              </thead>
                <tfoot>
                  <th></th>
                  <th></th>
                </tfoot>
                <tbody>
                  @foreach($idiomas as $idi)
                  <tr>
                  <td></td>
                   <td><input type="text" class="" value="{{$idi->idioma}}"></td>
                   <td><input type="text" class="" value="{{$idi->nivel}}"></td>                
                  </tr>
                  @endforeach              
                </tbody>
            </table>
      </div>

      <div class="form-group">
          <label>Observación</label>
          <textarea maxlength="100" class="form-control" id="observacionA" >{{$observaciones->obpa}}</textarea>
      </div>

      <div class="table-responsive">      
            <table id="detallesR" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Referencia Personales Y Laborales</h2></p>
              <thead style="background-color:#A9D0F5">
                <th style="width:0%"></th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Profesión</th>
                <th>Tipo de referencia</th>
              </thead>
              <tbody>
              @foreach($referencias as $ref)
                <tr class="filaTableR">
                  <td><input type="hidden" class="idpreferencia" value="{{$ref->idpreferencia}}"></td>
                  <td><input type="text" class="nombrer" value="{{$ref->nombrer}}"></td>
                  <td><input type="text" class="telefonor" " value="{{$ref->telefonor}}"></td>
                  <td><input type="text" class="profesion" value="{{$ref->profesion}}"></td>
                  <td><input type="text" class="tiporeferencia" value="{{$ref->tiporeferencia}}"></td>
                </tr>
                @endforeach
              </tbody>
            </table>
      </div>

      <div class="form-group">
          <label>Observación</label>
          <textarea maxlength="100" class="form-control" id="observacionR" >{{$observaciones->obpr}}</textarea>
      </div>

      <div class="table-responsive">    
            <table id="detallesEL" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Experiencia Laboral</h2></p>
              <thead style="background-color:#A9D0F5">
                <th style="width: 0%"></th>
                <th>Empresa</th>
                <th>Puesto</th>
                <th>Jefe Inmediato</th>
                <th>Motivo Retiro</th>
                <th>Ultimo Salario</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
              </thead>
              <tbody>
                @foreach($experiencias as $exp)
                <tr class="filaTableEL">
                  <td><input type="hidden" class="idpexperiencia" value="{{$exp->idpexperiencia}}"></td>
                  <td><input type="text" class="empresa" value="{{$exp->empresa}}"></td>
                  <td><input type="text" class="puesto" value="{{$exp->puesto}}"></td>
                  <td><input type="text" class="jefeinmediato" value="{{$exp->jefeinmediato}}"></td>
                  <td><input type="text" class="motivoretiro" value="{{$exp->motivoretiro}}"></td>
                  <td><input type="text" class="ultimosalario" value="{{$exp->ultimosalario}}"></td>
                  <td><input type="text" class="fingresoex" value="{{$exp->fingresoex}}"></td>
                  <td><input type="text" class="fsalidaex" value="{{$exp->fsalidaex}}"></td>
                 </tr>
                 @endforeach
              </tbody>
            </table>
      </div>

      <div class="form-group">
        <label>Observación</label>
        <textarea maxlength="100" class="form-control" id="observacionEL" >{{$observaciones->obpe}}</textarea>
      </div>

      <div class="table-responsive">
            <table id="detallesD" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Deudas</h2></p>
              <thead style="background-color:#A9D0F5">
                <th style="width: 0%"></th>
                <th>Acreedor</th>
                <th>Amortización mensual</th>
                <th>Monto crédito</th>
                <th>Motivo de crédito</th>
              </thead>
              <tbody>
                @foreach($deudas as $deu)
                <tr class="filaTableD">
                  <td><input type="hidden" class="idpdeudas" value="{{$deu->idpdeudas}}"></td>
                  <td><input type="text" class="acreedor" value="{{$deu->acreedor}}"></td>
                  <td><input type="text" class="pago" value="{{$deu->pago}}"></td>
                  <td><input type="text" class="montodeuda" value="{{$deu->montodeuda}}"></td>
                  <td><input type="text" class="motivodeuda" value="{{$deu->motivodeuda}}"></td>
                 </tr>
                 @endforeach
              </tbody>
            </table>
      </div>

      <div class="table-responsive">
            <table id="detallesPad" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Padecimientos</h2></p>
              <thead style="background-color:#A9D0F5">
                <th style="width: 0.01%"></th>
                <th>Padecimientos</th>
              </thead>
              <tbody>
                @foreach($padecimientos as $pad)
                <tr class="filaTable">
                  <td><input type="hidden" class="idpad" value="{{$pad->idppadecimientos}}"></td>
                  <td><input type="text" class="nombrepa" value="{{$pad->nombre}}"></td>
                </tr>
                 @endforeach
              </tbody>
            </table>
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

      <div class="table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
          <p><h2 ALIGN=center>Pariente Político</h2></p>
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

      <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
            <p><h2 ALIGN=center>Observaciones</h2></p>
              <thead style="background-color:#A9D0F5">
                <th>Observación</th>
              </thead>
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