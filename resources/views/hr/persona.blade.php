<div class="tab-pane active" id="profile">
  <div class="panel-heading">      
    <button class="btn btn-success" id="btnAgregarPer"><i class="icon-user icon-white" ></i>Agregar o editar datos</button>
  

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
        <div class="table-responsive" id="tabla">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsPer">
                <thead>
                    <th>Identificación</th>
                    <th>Nit</th>
                    <th>Nombre</th>
                    <th>Estado civil</th>
                    <th>Afilaci&oacute;n iggs</th>
                    <th>Genero</th>
                    <th>Direcci&oacute;n</th>
                    <th>Fecha Nacimiento</th>
                    <th>Numero dependientes</th>
                    <th>Aporte Mensual</th>
                    <th>Vivienda</th>
                    <th>Alquiler mensual</th>
                    <th>Otros ingresos</th>
                </thead>
                <tbody>
                    @if(isset($empleado))
                            <tr class="even gradeA" id="empleadoRH">
                                <td>{{$empleado->identificacion}}</td>
                                <td>{{$empleado->nit}}</td>
                                <td>{{$empleado->nombre1.' '.$empleado->nombre2.' '.$empleado->nombre3.' '.$empleado->apellido1.' '.$empleado->apellido2.' '.$empleado->apellido3}}</td>
                                <td>{{$empleado->estadocivil}}</td>
                                <td>{{$empleado->afiliacionigss}}</td>
                                    @if ($empleado->genero == "M")
                                        <td>Masculino</td>
                                    @elseif ($empleado->genero == "F")
                                        <td>Femenino</td>
                                    @else
                                        <td></td>
                                    @endif

                                <td>{{$empleado->barriocolonia}}</td>
                                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$empleado->fechanac)->format('d/m/Y')}}</td> 

                                <td>{{$empleado->numerodependientes}}</td>
                                <td>{{$empleado->aportemensual}}</td>
                                <td>{{$empleado->vivienda}}</td>
                                <td>{{$empleado->alquilermensual}}</td>
                                <td>{{$empleado->otrosingresos}}</td>
                    
                            </tr>                        
                    @endif
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>

<div class="col-lg-12">
    
    <input type="hidden" name="idper" id="idper">
    <div class="modal fade" id="formModalPer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="inputTitlePer"></h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="formAgregarPer">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label for="identificacion">Identicación *</label>
                            <div class="form-group">
                                <input type="text" id="identificacio" maxlength="13" class="form-control" onkeypress="return valida(event)" value="011000">
                               
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="nit">Nit </label>
                                <input type="text" name="nit" id="nit" class="form-control" maxlength="9">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="nit">Afilación iggs</label>
                                <input type="text" name="afiliacionigss" id="afiliacionigss" class="form-control" maxlength="9">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre1</label>
                                <input class="form-control" id="nombre1" name="nombre1">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre2</label>
                                <input class="form-control" id="nombre2" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre3</label>
                                <input class="form-control" id="nombre3" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Apellido1</label>
                                <input class="form-control" id="apellido1" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Apellido2</label>
                                <input class="form-control" id="apellido2" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Apellido3</label>
                                <input class="form-control" id="apellido3" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <label for="fechanac">Fecha de nacimiento *</label>
                            <div class="input-group">
                                <input id="fechanac" type="date" class="form-control" name="fechanac">
                                <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>


                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Estado civil</label>
                                <select name="idcivil" class="form-control" id="idcivil" data-live-search="true">
                                    @if (isset($estadocivil))
                                      @foreach($estadocivil as $cat)
                                          @if($cat->idcivil == $empleado->idcivil)                 
                                              <option value="{{$cat->idcivil}}" selected>{{$cat->estado}}</option>
                                          @else
                                              <option value="{{$cat->idcivil}}">{{$cat->estado}}</option>
                                          @endif                                        
                                      @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>   

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <label>Genero</label>
                            <div class="form-group">
                                <label ><input type="radio" name="genero" value="M" id="genero">Masculino</label>
                                <label ><input type="radio" name="genero" value="F" id="genero">Femenino</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="numerodependientes">Dependientes</label>
                                <input type="number" name="numerodependientes" id="dependientes" min="0" class="form-control" onkeypress="return valida(event)">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="aportemensual">Aporte mensual</label>
                                <input type="number" name="aportemensual" id="apmensual" min="0" class="form-control" onkeypress="return valida(event)">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Vivienda</label>
                                <select name="vivienda" id="vivienda" class="form-control">
                                    <option value="casa propia">casa propia</option>
                                    <option value="vive con familiares">vive con familiares</option>
                                    <option value="Alquila">Alquila</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <label for="alquilermensual">Alquiler mensual</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i>Q</i></span>
                                <input type="text" min="0" name="alquilermensual" id="alquilermensual" class="form-control" onkeypress="return valida(event)">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <label for="otrosingresos">Otros ingresos</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i>Q</i></span>
                                <input type="text" min="0" name="otrosingresos" id="otrosingresos" class="form-control" onkeypress="return valida(event)">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="barriocolonia">Dirección completa *</label>
                                <input type="text-area" maxlength="100" name="barriocolonia" id="barriocolonia" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarPer">Guardar</button>
                    <input type="hidden" name="iddg" id="iddg" value="0"/>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="erroresModalPer" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Errores</h4>
      </div>

      <div class="modal-body">
        <ul style="list-style-type:circle" id="erroresContentPer"></ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('assets/js/persona.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>