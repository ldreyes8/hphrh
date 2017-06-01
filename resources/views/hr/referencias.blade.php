<div class="tab-pane" id="referencias">
    <div class="panel-heading">
        <button class="btn btn-success" id="btnAgregarR"><i class="icon-user icon-white" ></i> Agregar referencias</button>
    </div>
  <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
    <div class="table-responsive" id="tabla">
      <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsR">
        <thead>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Profesión</th>
          <th>Tipo de referencia</th>
          <th>Opciones</th>

        </thead>
        <tbody id="products-list" name="products-list">
          @if (isset($referencia))
            @for ($i=0;$i<count($referencia);$i++)
              <tr class="even gradeA" id="referencia{{$referencia[$i]->idpreferencia}}">
                
                <td>{{$referencia[$i]->nombrer}}</td>
                <td>{{$referencia[$i]->telefonor}}</td>
                <td>{{$referencia[$i]->profesion}}</td>
                <td>{{$referencia[$i]->tiporeferencia}}</td>
                <td>
                  <button class="fa fa-pencil btn-editar-referencia" value="{{$referencia[$i]->idpreferencia}}"></button>
                  <button class="fa fa-trash-o btn-danger"></button>
                </td>
              </tr>
            @endfor
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
  <div class="col-lg-12">
    <div class="modal fade" id="formModalR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="inputTitleR"></h4>
          </div>
          <div class="modal-body">
             	<form role="form" id="formAgregarR">
                @if (isset($empleado))
                  <input type="hidden" id="idempleado" name="idempleado" value="{{$empleado->idempleado}}">
                  <input type="hidden" id="identificacion" name="identificacion" value="{{$empleado->identificacion}}">
                  
                @endif

                	<div class="form-group">
                    	<label for="nombrer">Nombre completo *</label>
                        <input type="text" id="nombre" name="nombre" maxlength="70" class="form-control" onkeypress="return validaL(event)">
                    </div>
                                                    
                    <div class="form-group">
                        <label for="telefonor">Teléfono *</label>
                        <div class="input-group">
                            <span class="input-group-addon">502</i></span>
                            <input type="text" id="telefono"  maxlength="8" name="telefono" class="form-control" onkeypress="return valida(event)">
                        </div>
                    </div>
                         <div class="form-group">
                            <label for="profesion">Profesión</label>
                            <input type="text" id="profesion" name="profesion" maxlength="100" class="form-control" onkeypress="return validaL(event)">
                        </div>
                        <div class="form-group">
                            <label>Tipo de referencia *</label>
                            <select name="tiporeferencia" id="tiporeferencia" class="form-control">
                                <option value="Personal">Personal</option>
                                <option value="Laboral">Laboral</option>
                            </select>
                        </div>
                    
              	</form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarR">Guardar</button>
            <input type="hidden" name="idref" id="idref" value="0"/>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="erroresModalR" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Errores</h4>
      </div>

      <div class="modal-body">
        <ul style="list-style-type:circle" id="erroresContentR"></ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('assets/js/referencia.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>