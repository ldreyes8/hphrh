<div class="tab-pane" id="otros">
  <div class="panel-heading">
        <button class="btn btn-success" id="btnAgregarL"><i class="icon-user icon-white" ></i> Agregar Licencia de conducir</button>
        <button class="btn btn-success" id="btnAgregarI"><i class="icon-user icon-white" ></i> Agregar un idioma</button>
        <button class="btn btn-success" id="btnAgregarPAF"><i class="icon-user icon-white" ></i> Aplicar a un puesto</button>
  </div>
  <div class="Card-box">
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
  
  <div class="col-lg-6 col-md-6col-sm-8 col-xs-12" >
      <div class="table-responsive" id="tabla">
        <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsI">
          <thead>
            <th>Idioma</th>
            <th>Nivel</th>
            <th>Opciones</th>
          </thead>
          <tbody id="productsI" name="productsI">
            @if (isset($emidioma))
              @for ($i=0;$i<count($emidioma);$i++)
                <tr class="even gradeA" id="idpi{{$emidioma[$i]->idpidioma}}">
                  <td>{{$emidioma[$i]->idiomash}}</td>
                  <td>{{$emidioma[$i]->nivel}}</td>
                  <td>
                    <button class="fa fa-pencil btn-editar-idioma" value="{{$emidioma[$i]->idpidioma}}"></button>
                    <button class="fa fa-trash-o btn-delete-idioma" value="{{$emidioma[$i]->idpidioma}}"></button>
                  </td>
                </tr>
              @endfor
            @endif
          </tbody>
        </table>
      </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" >
      <div class="table-responsive" id="tabla">
        <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsL">
          <thead>
            <th>Típo licencia</th>
            <th>Vigencia</th>
            <th>Opciones</th>
          </thead>
          <tbody id="productsL" >
            @if (isset($emlicencia))
              @for ($i=0;$i<count($emlicencia);$i++)
                <tr class="even gradeA" id="idlic{{$emlicencia[$i]->idplicencia}}">
                  <td>{{$emlicencia[$i]->tipolicencia}}</td>
                  <td>{{$emlicencia[$i]->vigencia}}</td>
                  <td>
                    <button class="fa fa-pencil btn-editar-licencia" value="{{$emlicencia[$i]->idplicencia}}"></button>
                    <button class="fa fa-trash-o btn-delete-licencia" value="{{$emlicencia[$i]->idplicencia}}"></button>
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

<div class="col-lg-12">
    <div class="modal fade" id="formModalI" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="inputTitleI"></h4>
          </div>
          <div class="modal-body">
              <form role="form" id="formAgregarI">
  
                  @if (isset($empleado))
                    <input type="hidden" id="idempleadoI"  value="{{$empleado->idempleado}}">                 
                  @endif
                
                  <div class="form-group">
                    <label>Idioma</label>
                    <select id="ididioma" class="form-control select2" data-live-search="true" >
                      @if (isset($idiomas))
                        @foreach($idiomas as $cat)
                            <option value="{{$cat->ididioma}}">{{$cat->nombre}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Nivel</label>
                    <select  id="niveli" class="form-control">
                      <option value="Principiante">Principiante</option>
                      <option value="Intermedio">Intermedio</option>
                      <option value="Avanzado">Avanzado</option>
                    </select>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarI">Guardar</button>
            <input type="hidden" id="idpi" value="0"/>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="modal fade" id="formModalL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="inputTitleL"></h4>
          </div>
          <div class="modal-body">
              <form role="form" id="formAgregarL">
                  @if (isset($empleado))
                    <input type="hidden" id="identificacionl" value="{{$empleado->identificacion}}">                 
                  @endif
                    <div class="form-group">
                        <label>Tipo licencia</label>
                        <select  id="licenciaid" class="form-control selectpicker" data-live-search="true" >
                          @if (isset($licencia))
                            @foreach($licencia as $cat)
                                 <option value="{{$cat->idlicencia}}">{{$cat->tipolicencia}}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>
                  
                    <div class="form-group">
                        <label >Vigencia</label>
                        <input type="text" id="vigencia"  maxlength="4" onkeypress="return valida(event)" class="form-control">
                    </div>
                  
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarL">Guardar</button>
            <input type="hidden" id="idlic" value="0"/>
          </div>
        </div>
      </div>
    </div>
</div>
<!--Modal de puesto a aplicar-->
<div class="col-lg-12">
    <div class="modal fade" id="formModalPAF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="inputTitlePAF"></h4>
          </div>
          <div class="modal-body">
              <form role="form" id="formAgregarPAF">
                  @if (isset($empleado))
                    <input type="hidden" id="idempleadoPAF" value="{{$empleado->idempleado}}">
                    <input type="hidden" id="identificacionPAF" value="{{$empleado->identificacion}}">                 
                  @endif
                    <div class="form-group">
                        <label>Puesto </label>
                        <select  id="idpuesto" class="form-control selectpicker" data-live-search="true">
                          @if (isset($puestos))
                            @foreach($puestos as $pts)
                              <option value="{{$pts->idpuesto}}">{{$pts->nombre}}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Afiliado</label>
                        <select  id="idafiliado" class="form-control selectpicker" data-live-search="true">
                          @if (isset($afiliados))
                            @foreach($afiliados as $afs)
                              <option value="{{$afs->idafiliado}}">{{$afs->nombre}}</option>
                            @endforeach
                          @endif
                        </select>
                    </div>                  
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarPAF">Guardar</button>
            <input type="hidden" id="idlic" value="0"/>
          </div>
        </div>
      </div>
    </div>
</div>
<!--Modal de error-->
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