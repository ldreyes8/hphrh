<div class="tab-pane" id="padecimientos">
    <div class="panel-heading">
        <button class="btn btn-success" id="btnAgregarP"><i class="icon-user icon-white" ></i> Agregar padecimiento</button>
    </div>
  <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
    <div class="table-responsive" id="tabla">
      <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsP">
        <thead>
          <th>padecimiento</th>
          <th style="width: 10%">Opciones</th>
        </thead>
        <tbody id="productsP" name="productsP">
          @if (isset($padecimiento))
            @for ($i=0;$i<count($padecimiento);$i++)
              <tr class="even gradeA" id="pad{{$padecimiento[$i]->idppadecimientos}}">
                <td>{{$padecimiento[$i]->nombre}}</td>
                <td>
                  <button value="{{$padecimiento[$i]->idppadecimientos}}" class="fa fa-pencil btn-editar-padecimiento "></button>
                  <button value="{{$padecimiento[$i]->idppadecimientos}}" class="fa fa-trash-o btn-danger "></button>
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
    <div class="modal fade" id="formModalP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="inputTitleP"></h4>
          </div>
          <div class="modal-body">
             	<form role="form" id="formAgregarP">
                @if (isset($empleado))
                  <input type="hidden" id="idempleado" name="idempleado" value="{{$empleado->idempleado}}">
                  <input type="hidden" id="identificacion" name="identificacion" value="{{$empleado->identificacion}}">
                  
                @endif
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group ">
                    <h6>Ingrese los padecimientos que tenga o haya tenido en los últimos 6 meses.</h6>
                  </div>
                </div>
                  <div class="form-group">
                    <label for="nombr">Padecimiento</label>
                    <input type="text" id="nombrep" name="nombrep" maxlength="40" class="form-control" onkeypress="return validaL(event)">
                  
                </div>           
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarP">Guardar</button>
            <input type="hidden" id="idpad" name="idpad" value="0"/>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="erroresModalP" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Errores</h4>
      </div>

      <div class="modal-body">
        <ul style="list-style-type:circle" id="erroresContentP"></ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('assets/js/padecimiento.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>