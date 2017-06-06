@extends ('layouts.index')
@section('estilos')
    @parent
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
  <form role="form" id="formUpdate">  
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <p>{{$persona->nombre1.' '.$persona->nombre2.' '.$persona->apellido1.' '.$persona->apellido2}}</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="form-group">
            <label for="serie_comprobante">Identificacion</label>
            <p id="identificacionup" >{{$empleado->identificacion}}</p>
            <input type="hidden" id="identificacion" value="{{$empleado->identificacion}}">
            <input type="hidden" id="idempleado" value="{{$empleado->idempleado}}">
            <p style="display: none;">{{$empleado->idempleado}}</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="form-group">
          <label for="serie_comprobante">Nit</label>
            <p>{{$empleado->nit}}</p>
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
     
              <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tfoot>
              <tbody>
                <tr>
               

                @if($persona->avenida != '' and $persona->calle =='')
                  <td><input type="text" name="" value="{{'av'.' '.$persona->avenida.' '.$persona->nomenclatura.' '.'Zona'.' '.$persona->zona.' '.$persona->barriocolonia}} ">             
                  </td>
                @endif

                @if($persona->calle != '' and $persona->avenida == '')
                  <td><input type="text" name="" value="{{'calle'.' '.$persona->calle.' '.$persona->nomenclatura.' '.'Zona'.' '.$persona->zona.' '.$persona->barriocolonia}}">              
                  </td>
                @endif

                @if($persona->calle != '' and $persona->avenida != '')
                  <td><input type="text" name="" value="{{'calle'.' '.$persona->calle.' '.'av'.' '.$persona->avenida.' '.$persona->nomenclatura.' '.'Zona'.' '.$persona->zona.' '.$persona->barriocolonia}}">              
                  </td>
                @endif
     

                @if($persona->calle == '' and $persona->avenida == '' and $persona->zona == '' and $persona->nomenclatura == '' and $persona->barriocolonia != '')
                  <td><input type="text" MAXLENGTH=7 name="" value="{{$persona->barriocolonia}}">              
                  </td>
                @endif

                @if($persona->calle == '' and $persona->avenida == '' and $persona->zona == '' and $persona->nomenclatura == '' and $persona->barriocolonia == '')
                  <td>              
                                   
                  </td>
                @endif


                  <td><input type="text" name="" value="{{$persona->telefono}}"></td>
                  <td><input type="text" name="" value="{{$persona->fechanac}}"></td>
                  <td><input type="text" name="" value="{{$persona->departamento}}"></td>
                  <td><input type="text" name="" value="{{$persona->municipio}}"></td>
                  <td><input type="text" name="" value="{{$empleado->estadocivil}}"></td>
                  <td><input type="text" name="" value="{{$persona->afiliado}}"></td>
                  <td><input type="text" name="" value="{{$persona->puesto}}"></td>
                  <td><input type="text" name="" value="{{$empleado->afiliacionigss}}"></td>

                  <td><input type="text" name="" value="{{$empleado->numerodependientes}}"></td>
                  <td><input type="text" name="" value="{{$empleado->aportemensual}}"></td>
                  <td><input type="text" name="" value="{{$empleado->vivienda}}"></td>
                  <td><input type="text" name="" value="{{$empleado->alquilermensual}}"></td>
                  <td><input type="text" name="" value="{{$empleado->otrosingresos}}"></td>
                  <td><input type="text" name="" value="{{$empleado->pretension}}"></td>
                  <td><input type="text" name="" value="{{$empleado->fechasolicitud}}"></td>
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
                <th style="width: 0.5%">Id</th>
                <th>Padecimientos</th>
              </thead>
              <tbody>
                @foreach($padecimientos as $pad)
                <tr class="filaTable">
                  <td><input type="text" id="uppadid" class="padRid" name="" value="{{$pad->idppadecimientos}}"></td>
                  <td><input type="text" id="uppadn" class="padRn" name="" value="{{$pad->nombre}}"></td>
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
                  <button id="btnupsolicitud" type="button" class="btn btn-primary">Guardar cambios</button>
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
  $("#btnupsolicitud").click(function()
  {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    //alert('update');
    var miurl="upsolicitud";

        /*var formData = {
            observacion: $("#observacion").val(),
            idempleado: $("#idempleado").val(),
        };
        */

  });
});
</script>


@endsection