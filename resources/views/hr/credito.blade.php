<div class="tab-pane" id="creditos">
    <div class="panel-heading">
        <button class="btn btn-success" id="btnAgregarC"><i class="icon-user icon-white" ></i> Agregar crédito</button>
    </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
      <div class="card-box">
        <div class="table-responsive" id="tabla">
          <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsC">
            <thead>
              <th>Acreedor</th>
              <th>Amortización mensual</th>
              <th>Monto crédito</th>
              <th>Motivo del crédito</th>
              <th>Opciones</th>
            </thead>
            <tbody id="productsC" name="productsC">
              @if (isset($deuda))
                @for ($i=0;$i<count($deuda);$i++)
                  <tr class="even gradeA" id="deudas{{$deuda[$i]->idpdeudas}}">
                    <td>{{$deuda[$i]->acreedor}}</td>
                    <td>{{$deuda[$i]->amortizacionmensual}}</td>
                    <td>{{$deuda[$i]->montodeuda}}</td>
                    <td>{{$deuda[$i]->motivodeuda}}</td>
                    <td>
                      <button class="fa fa-pencil btn-editar-credito" value="{{$deuda[$i]->idpdeudas}}"></button>
                      <button class="fa fa-trash-o btn-delete-credito" value="{{$deuda[$i]->idpdeudas}}"></button>
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
    <div class="modal fade" id="formModalC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="inputTitleC"></h4>
          </div>
          <div class="modal-body">
             	<form role="form" id="formAgregarC">
                @if (isset($empleado))
                  <input type="hidden" id="idempleado" name="idempleado" value="{{$empleado->idempleado}}">
                  <input type="hidden" id="identificacion" name="identificacion" value="{{$empleado->identificacion}}">
                  
                @endif
                  <div class="form-group">
                      <label for="acreedor">Acreedor</label>
                      <input type="text" id="acreedor" name="acreedor" class="form-control" onkeypress="return validaL(event)">
                  </div>
                  <div class="form-group">
                  <label for="amortizacionmensual">Amortización mensual</label>
                  <div class="input-group">
                      <span class="input-group-addon">Q</i></span>
                      <input type="text" min="0" id="amortizacionmensual" name="amortizacionmensual" class="form-control" onkeypress="return valida(event)">
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="montodeuda">Monto crédito</label>
                    <div class="input-group">
                       <span class="input-group-addon">Q</i></span>
                      <input type="text" min="0" id="montodeuda" name="montodeuda" class="form-control" onkeypress="return valida(event)">
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="mdeuda">Motivo del crédito</label>
                      <input type="text" id="mdeuda" name="mdeuda" class="form-control" onkeypress="return validaL(event)">
                  </div>                    
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarC">Guardar</button>
            <input type="hidden" name="idco" id="idco" value="0"/>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="erroresModalC" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Errores</h4>
      </div>

      <div class="modal-body">
        <ul style="list-style-type:circle" id="erroresContentC"></ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('assets/js/credito.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>