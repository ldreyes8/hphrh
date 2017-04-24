<div class="tab-pane" id="academicos">
    <div class="panel-heading">
        <button class="btn btn-success" id="btnAgregar"><i class="icon-user icon-white" ></i> Agregar estudios</button>
    </div>
  <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <th>Titulo</th>
          <th>Institucion</th>
          <th>Duracion</th>
          <th>Nivel</th>
          <th>Fecha Ingreso</th>
          <th>Fecha Salida</th>
        </thead>
        <tbody>
          @if (isset($academico))
            @foreach($academico as $aca)
              <tr>
                <td>{{$aca->titulo}}</td>
                <td>{{$aca->establecimiento}}</td>
                <td>{{$aca->duracion}}</td>
                <td>{{$aca->nivel}}</td>
                <td>{{$aca->fingreso}}</td>
                <td>{{$aca->fsalida}}</td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
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
                      <label>Titulo</label>
                      <input class="form-control" id="inNombres" required="true">
                  </div>                                          
                                                
                  <div class="form-group">
                      <label>Establecimiento</label>
                      <input class="form-control" id="inApellidos" required="true"/>
                  </div>                                                           
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                          <label for="duracion">Duracion</label>
                          <input type="text" name="duracion" id="duracion" class="form-control" onkeypress="return valida(event)">
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
                      <input type="text" id="dato2" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group ">
                      <label for="fsalida">Fecha de salida</label>
                      <input type="text" id="dato3" name="fsalida" class="form-control">
                    </div>
                  </div> 
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('assets/js/academico.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>