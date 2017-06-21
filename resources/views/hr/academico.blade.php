<div class="tab-pane" id="academicos">
    <div class="panel-heading">
        <button class="btn btn-success" id="btnAgregar"><i class="icon-user icon-white" ></i> Agregar estudios</button>
    </div>
  <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
    <div class="table-responsive" id="tabla">
      <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItems">
        <thead>
          <th>Título</th>
          <th>Institución</th>
          <th>Duración</th>
          <th>Nivel</th>
          <th>Fecha Ingreso</th>
          <th>Fecha Salida</th>
          <th>Opciones</th>
        </thead>
        <tbody id="productsA" name="productsA">
          @if (isset($academico))
            @for ($i=0;$i<count($academico);$i++)
              <tr class="even gradeA" id="academico{{$academico[$i]->idpacademico}}">
                <td>{{$academico[$i]->titulo}}</td>
                <td>{{$academico[$i]->establecimiento}}</td>
                <td>{{$academico[$i]->duracion.': '.$academico[$i]->periodo}}</td>
                <td>{{$academico[$i]->nombrena}}</td>
                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$academico[$i]->fingreso)->format('d/m/Y')}}</td>
                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$academico[$i]->fsalida)->format('d/m/Y')}}</td>
                <td>
                  <button class="fa fa-pencil btn-editar-academico" value="{{$academico[$i]->idpacademico}}"></button>
                  <button class="fa fa-trash-o btn-delete-academico" value="{{$academico[$i]->idpacademico}}"></button>
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
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="inputTitle"></h4>
          </div>
          <div class="modal-body">
              <form role="form" id="formAgregar">
                @if (isset($empleado))
                  @foreach ($empleado as $emp)
                  <input type="hidden" id="idempleado" name="idempleado" value="{{$emp->idempleado}}">
                  <input type="hidden" id="identificacion" name="identificacion" value="{{$emp->identificacion}}">
                  @endforeach
                @endif

                  <div class="form-group">
                      <label>Título</label>
                      <input class="form-control" id="titulo" name="titulo">
                  </div>                                          
                                                
                  <div class="form-group">
                      <label>Establecimiento</label>
                      <input class="form-control" id="establecimiento" name="establecimiento"/>
                  </div>                                                           
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label for="duracion">Duración</label>
                      <div class="form-group">
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="duracion" id="duracion" class="form-control" onkeypress="return valida(event)">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <select id="periodo" name="periodo" class="form-control">
                            <option value="Dia">Día</option>
                            <option value="Mes">Mes</option>
                            <option value="Año">Año</option>
                          </select>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                    <label for="nivel">Nivel</label>
                    <div class="form-group">
                      <select name="idnivel" id="idnivel" class="form-control selectpicker" data-live-search="true" data-style="btn-info">
                      @if (isset($nivelacademico))
                        @foreach($nivelacademico as $depa)
                        <option value="{{$depa->idnivel}}">{{$depa->nombrena}}</option>
                        @endforeach
                      @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group ">
                      <label >Fecha de ingreso</label>
                      <input type="text" id="fechaingreso" class="form-control" name="fecha_ingreso">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group ">
                      <label for="fsalida">Fecha de salida</label>
                      <input type="text" id="fechasalida" name="fecha_salida" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>País de origen </label>
                    <div class="form-group">
                      <select id="idpaisPA" class="form-control selectpicker" data-live-search="true">
                        <option value="" hidden>Seleccione</option>
                        @if (isset($pais))
                          @foreach($pais as $p)
                              <option value="{{$p->idpais}}">{{$p->nombre}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>                                                
                  </div> 
                  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label>Departamento</label>
                      <select name="iddepartamento" id="iddepartamento1" class="form-control selectpicker" data-live-search="true" data-style="btn-info">
                      @if (isset($departamento))
                        @foreach($departamento as $depa)
                          <option value="{{$depa->iddepartamento}}">{{$depa->nombre}}</option>
                        @endforeach
                      @endif  
                      </select>
                    </div>                                                
                  </div>      
                  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                      <div class="form-group">
                          <label>Municipio</label>
                              {!! Form::select('pidmunicipio',['placeholder'=>'Selecciona'],null,['id'=>'pidmunicipio','class'=>'form-control']) !!}
                      </div>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
            <input type="hidden" name="idacad" id="idacad" value="0"/>
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

<script src="{{asset('assets/js/academico.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>