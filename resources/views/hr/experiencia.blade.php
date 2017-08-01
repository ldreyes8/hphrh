<div class="tab-pane" id="experiencias">
  <div class="panel-heading">
    <button class="btn btn-success" id="btnAgregarE"><i class="icon-user icon-white" ></i> Agregar Experiencia</button>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
      <div class="card-box">
        <div class="table-responsive" id="tabla">
          <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsE">
            <thead>
              <th>Empresa</th>
              <th>Puesto</th>
              <th>Jefe inmediato</th>
              <th>Motivo retiro</th>
              <th>Ultimo salario</th>
              <th>Año de ingreso</th>
              <th>Año de salida</th>
              <th>Opciones</th>
            </thead>
            <tbody id="products" name="products">
              @if (isset($experiencia))
                @for ($i=0;$i<count($experiencia);$i++)
                  <tr class="even gradeA" id="experiencia{{$experiencia[$i]->idpexperiencia}}">
                    <td>{{$experiencia[$i]->empresa}}</td>
                    <td>{{$experiencia[$i]->puesto}}</td>
                    <td>{{$experiencia[$i]->jefeinmediato}}</td>
                    <td>{{$experiencia[$i]->motivoretiro}}</td>
                    <td>{{$experiencia[$i]->ultimosalario}}</td>
                    <td>{{$experiencia[$i]->fingresoex}}</td>
                    <td>{{$experiencia[$i]->fsalidaex}}</td>
                    <td>
                      <button class="fa fa-pencil btn-editar-experiencia" value="{{$experiencia[$i]->idpexperiencia}}"></button>
                      <button class="fa fa-trash-o btn-delete-experiencia" value="{{$experiencia[$i]->idpexperiencia}}"></button>
                    </td>
                  </tr>
                @endfor
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="col-lg-12">
    <div class="modal fade" id="formModalE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="inputTitleE"></h4>
          </div>
          <div class="modal-body">
             	<form role="form" id="formAgregarE">
                @if (isset($empleado))
                  <input type="hidden" id="idempleado" name="idempleado" value="{{$empleado->idempleado}}">
                  <input type="hidden" id="identificacion" name="identificacion" value="{{$empleado->identificacion}}">
                @endif
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="empresa">Empresa</label>
                        <input type="text" id="empresa" name="empresa" maxlength="100" class="form-control" onkeypress="return validaL(event)">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">               
                    <div class="form-group">
                      <label for="puesto">Puesto</label>
                      <input type="text" id="puesto" name="puesto" maxlength="50" class="form-control" onkeypress="return validaL(event)">
                    </div>
                  </div>
                

                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                   
                    <div class="form-group">
                      <label for="jefeinmediato">Jefe inmediato</label>
                      <input type="text" id="jefeinmediato" name="jefeinmediato" maxlength="50" class="form-control" onkeypress="return validaL(event)">
                    </div>
                  </div>
                                                    
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label for="motivoretiro">Motivo de retiro</label>
                      <input type="text" id="motivoretiro" name="motivoretiro" maxlength="40" class="form-control" onkeypress="return validaL(event)">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label for="ultimosalario">Ultimo salario</label>
                    <div class="input-group">
                      <span class="input-group-addon">Q</i></span>
                      <input type="text" id="ultimosalario" name="ultimosalario" class="form-control" onkeypress="return valida(event)">
                      <span class="input-group-addon">.00</span>
                    </div>
                  </div>
                
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group">
                          <label for="fingresoex">Año de ingreso</label>
                          <input id="año_ingreso" type="text" maxlength="4" class="form-control" name="año_ingreso" onkeypress="return valida(event)">
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group">
                          <label for="fsalidaex">Año de salida</label>
                          <input id="año_salida" maxlength="4" type="text" class="form-control" name="año_salida" onkeypress="return valida(event)">
                      </div>
                  </div>
                                                           
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarE">Guardar</button>
            <input type="hidden" name="idex" id="idex" value="0"/>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="erroresModalE" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Errores</h4>
      </div>

      <div class="modal-body">
        <ul style="list-style-type:circle" id="erroresContentE"></ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('assets/js/experiencia.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>