<div class="tab-pane" id="otros">
    <div class="panel-heading">
        <!--button class="btn btn-success" id="btnAgregarI"><i class="icon-user icon-white" ></i> Agregar un idioma</button-->
    </div>
  <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
    <div class="table-responsive" id="tabla">
      <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsO">
        <thead>
          <th style="width: 20%">Cel. institucional</th>
          <th>Talla</th>
          <th>Altura</th>
          <th>Peso</th>
          <th style="width: 10%">Otros</th>
        </thead>
        <tbody>
          @if (isset($empleado))
              <tr class="even gradeA" id="idem{{$empleado->idempleado}}">
                <td>{{$empleado->celcorporativo}}</td>
                <td>{{$empleado->talla}}</td>
                <td>{{$empleado->altura}}&nbsp;Metros</td>
                <td>{{$empleado->peso}}&nbsp;Libras</td>
                <td>
                  <button class="fa fa-pencil btn-editar-cel" value="{{$empleado->idempleado}}"></button>
                </td>
              </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
  <div class="col-lg-12">
    <div class="modal fade" id="formModalO" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="inputTitleO"></h4>
          </div>
          <div class="modal-body">
             	<form role="form" id="formAgregarO">
                @if (isset($empleado))
                  <input type="hidden" id="idempleado" name="idempleado" value="{{$empleado->idempleado}}">                 
                @endif
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  	<div class="form-group">
                      	<label for="celcorporativo">Celular institucional *</label>
                        <div class="input-group">
                            <span class="input-group-addon">502</i></span>
                            <input type="text" id="celcorporativo"  maxlength="8" name="celcorporativo" class="form-control" onkeypress="return valida(event)">
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >                                    
                      <div class="form-group">
                          <label for="talla">Talla </label>
                          <div class="input-group">
                            <input type="text" placeholder="M" id="talla" name="talla" maxlength="4" class="form-control" onkeypress="return validaL(event)">
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                    <label for="altura">Altura</label>
                      <div class="input-group">
                        <input type="text" id="altura" placeholder="Metros" name="altura" maxlength="15" class="form-control">
                        <span class="input-group-addon">Mts.</i></span>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                    <label for="profesion">Peso</label>
                      <div class="input-group">
                        <input type="text" id="peso" placeholder="Libras" name="peso" maxlength="15" class="form-control">
                        <span class="input-group-addon">Lbs.</i></span>
                      </div>
                  </div>                    
              	</form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarO">Guardar</button>
            <input type="hidden" id="idem" name="idem" value="0"/>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="erroresModalO" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Errores</h4>
      </div>

      <div class="modal-body">
        <ul style="list-style-type:circle" id="erroresContentO"></ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('assets/js/otros.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>
<script type="text/javascript">
  function valida(e){
                tecla = e.keyCode || e.which;
                tecla_final = String.fromCharCode(tecla);
                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8 || tecla==37 || tecla==39 ||tecla==46 ||tecla==9)
                    {
                        return true;
                    } 
                // Patron de entrada, en este caso solo acepta numeros
                patron =/[0-9]/;
                //patron =/^\d{9}$/;
                return patron.test(tecla_final);

            }
            //Se utiliza para que el campo de texto solo acepte letras
            function validaL(e) {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toString();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ63";//Se define todo el abecedario que se quiere que se muestre.
                especiales = [8, 37, 39, 46, 9]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.
                tecla_especial = false
                for(var i in especiales) {
                    if(key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }
                if(letras.indexOf(tecla) == -1 && !tecla_especial){
                    //alert('Tecla no aceptada');
                    return false;
                  }
            }
</script>