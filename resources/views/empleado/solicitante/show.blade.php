@extends ('layouts.index')
@section ('contenido')

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
      <p>{{$empleado->identificacion}}</p>
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
  
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
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
              <td>              
                 {{'av'.' '.$persona->avenida.' '.$persona->nomenclatura.' '.'Zona'.' '.$persona->zona.' '.$persona->barriocolonia}}              
              </td>
            @endif

            @if($persona->calle != '' and $persona->avenida == '')
              <td>              
                 {{'calle'.' '.$persona->calle.' '.$persona->nomenclatura.' '.'Zona'.' '.$persona->zona.' '.$persona->barriocolonia}}              
              </td>
            @endif

            @if($persona->calle != '' and $persona->avenida != '')
              <td>              
                 {{'calle'.' '.$persona->calle.' '.'av'.' '.$persona->avenida.' '.$persona->nomenclatura.' '.'Zona'.' '.$persona->zona.' '.$persona->barriocolonia}}              
              </td>
            @endif
 

            @if($persona->calle == '' and $persona->avenida == '' and $persona->zona == '' and $persona->nomenclatura == '' and $persona->barriocolonia != '')
              <td>              
                 {{$persona->barriocolonia}}              
              </td>
            @endif

            @if($persona->calle == '' and $persona->avenida == '' and $persona->zona == '' and $persona->nomenclatura == '' and $persona->barriocolonia == '')
              <td>              
                               
              </td>
            @endif


              <td>{{$persona->telefono}}</td>
              <td>{{$persona->fechanac}}</td>
              <td>{{$persona->departamento}}</td>
              <td>{{$persona->municipio}}</td>
              <td>{{$empleado->estadocivil}}</td>
              <td>{{$persona->afiliado}}</td>
              <td>{{$persona->puesto}}</td>
              <td>{{$empleado->afiliacionigss}}</td>

              <td>{{$empleado->numerodependientes}}</td>
              <td>{{$empleado->aportemensual}}</td>
              <td>{{$empleado->vivienda}}</td>
              <td>{{$empleado->alquilermensual}}</td>
              <td>{{$empleado->otrosingresos}}</td>
              <td>{{$empleado->pretension}}</td>
              <td>{{$empleado->fechasolicitud}}</td>
            </tr>
          </tbody>
        </table>
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
              <td>{{$fam->nombref}}</td>
              <td>{{$fam->parentezco}}</td>
              <td>{{$fam->telefonof}}</td>
              <td>{{$fam->ocupacion}}</td>
              <td>{{$fam->edad}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
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
              <td>{{$aca->titulo}}</td>
              <td>{{$aca->establecimiento}}</td>
              <td>{{$aca->duracion}}</td>
              <td>{{$aca->nivel}}</td>
              <td>{{$aca->fingreso}}</td>
              <td>{{$aca->fsalida}}</td>
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
               <td>{{$idi->idioma}}</td>
               <td>{{$idi->nivel}}</td>                
              </tr>
              @endforeach              
            </tbody>
          </thead>
        </table>
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
              <td>{{$ref->nombrer}}</td>
              <td>{{$ref->telefonor}}</td>
              <td>{{$ref->profesion}}</td>
              <td>{{$ref->tiporeferencia}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
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
              <td>{{$exp->empresa}}</td>
              <td>{{$exp->puesto}}</td>
              <td>{{$exp->jefeinmediato}}</td>
              <td>{{$exp->motivoretiro}}</td>
              <td>{{$exp->ultimosalario}}</td>
              <td>{{$exp->fingresoex}}</td>
              <td>{{$exp->fsalidaex}}</td>
             </tr>
             @endforeach
          </tbody>
        </table>
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
              <td>{{$deu->acreedor}}</td>
              <td>{{$deu->pago}}</td>
              <td>{{$deu->montodeuda}}</td>
             </tr>
             @endforeach
          </tbody>
        </table>
  </div>
  <div class="table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive" >
        <p><h2 ALIGN=center>Padecimeintos</h2></p>
          <thead style="background-color:#A9D0F5">
            <th>Padecimientos</th>
          </thead>
 
          <tfoot>
            <th></th>
          </tfoot>
          <tbody>
            @foreach($padecimientos as $pad)
            <tr>
              <td>{{$pad->nombre}}</td>
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
              <td>{{$pas->trabajoext}}</td>
              <td>{{$pas->forma}}</td>
              <td>{{$pas->motivofin}}</td>
              <td>{{$pas->nombre}}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
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
              <td>{{$par->nombre}}</td>
              <td>{{$par->puesto}}</td>
              <td>{{$par->dependencia}}</td>
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
    <meta name="_token" content="{!! csrf_token() !!}" />
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