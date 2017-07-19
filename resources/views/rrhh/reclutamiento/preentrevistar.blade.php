@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />

        <link href="{{asset('assets/css/components1.css')}}" rel="stylesheet" type="text/css">
        <!-- Datapicker Files  -->
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />
        <style >
            input[type=textt] {

                background: transparent;
                width: 1000px; /*ancho*/
                border: 0px;outline:none;
                text-align: justify;
                text-justify:inter-word;
            }
        </style>
@endsection
@section ('contenido')
<div class="col-md-10 col-md-12 col-sm-12 col-xs-12">
    <h3 class="text-center">Informe entrevista de profundidad</h3>  
    <h3 class="text-center">Información General</h3>    
</div>              
<form role="form" method="POST">
    <div class="row">
        <input type="hidden" id="idempleado" value="{{$persona->idempleado}}">
        <input type="hidden" id="identificacion" value="{{$persona->identificacion}}">
        <input type="hidden" id="idcivl" value="{{$persona->idcivil}}">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" >
                        <thead>
                            <tr>
                                <th style="width: 20%">Nombre Completo:</th><td>&nbsp;&nbsp;<input type="textt" name="" value="{{$persona->nombre1.' '.$persona->nombre2.' '.$persona->nombre3.' '.$persona->apellido1.' '.$persona->apellido2}}"></td>
                            </tr>
                            <tr>
                                <th>Fecha de la Entrevista: </th><td>&nbsp;&nbsp;<input type="textt" id="fechaentre"  maxlength="50" value="{{$date}}" disabled="disabled"></td>
                            </tr>
                            <tr>
                                <th>Dirección:</th><td>&nbsp;&nbsp;<input type="textt" id="lugar" name="lugar" maxlength="50" value="{{$entre->lugar}}"></td>
                            </tr>
                            <tr>
                                <th>Edad:</th><td>&nbsp;&nbsp;{{$fnac}}&nbsp;años</td>
                            </tr>
                            <tr>
                                <th>Estado civil:</th><td>&nbsp;&nbsp;{{$persona->ecivil}}</td>
                            </tr>
                            <tr>
                                <th>Teléfono:</th><td>&nbsp;&nbsp;<input type="textt" name="" maxlength="8" value="{{$persona->telefono}}"></td>
                            </tr>
                            <tr>
                                <th>Celular:</th><td>&nbsp;&nbsp;<input type="textt" name="" maxlength="8" value="{{$persona->celular}}"></td>
                            </tr>
                            <tr>
                                @if (!empty($academico->titulo))
                                    <th>Profesión:</th><td>&nbsp;&nbsp;{{$academico->titulo}}</td>
                                @else
                                    <th>Profesión:</th><td>&nbsp;&nbsp;No ingreso Datos</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Tiene Licencia de Conducir:</th>
                                <td>&nbsp;&nbsp;
                                    @foreach($licencias as $lic)
                                        <input type="textt" name="" maxlength="1" value="{{$lic->tipolicencia}},">
                                    @endforeach
                                </td>
                            </tr>              
                            <tr>
                                <th>Puesto al que aplica:</th><td>&nbsp;&nbsp;{{$persona->puesto}}</td>                   
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>I. Antecedentes personales y familiares</h5>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover" >
                                <thead>
                                    @if($persona->idcivil==1)
                                        <tr>
                                            <th style="width: 20%">¿Con quien vive?</th><td>&nbsp;&nbsp;<input type="textt" id="vivecompania" maxlength="100"></td>
                                        </tr>
                                        <tr>
                                            <th>Tipo de residencia</th><td>&nbsp;&nbsp;{{$persona->vivienda}}</td>
                                        </tr>
                                        <tr>
                                            <th>¿A que se dedica sus padres?</th><td>&nbsp;&nbsp;<input type="textt" id="dedicanpadres" maxlength="100"></td>
                                        </tr>
                                        <tr>
                                            <th>Cantidad de hermanos</th>
                                            @foreach($hermanos as $pers)
                                                @if($pers->identificacion == $persona->identificacion)
                                                    <td>{{$pers->hermano}}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>¿Quienes aportan para el sustento económico de la familia?</th><td>&nbsp;&nbsp;<input type="textt" id="aportefamilia" maxlength="100"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>Casado</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 20%">Tipo de residencia</th><td>{{$persona->vivienda}}</td>
                                        </tr>
                                        <tr>
                                            <th>¿A qué se dedica su esposa?</th><td>{{$esposa->ocupacion}}</td>
                                        </tr>
                                        <tr>
                                        <th>¿Cuántos hijos tiene?</th>
                                            @foreach($hijo as $pers)
                                                @if($pers->identificacion == $persona->identificacion)
                                                    <td>{{$pers->hijos}}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endif
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>II. Antecedentes Académicos </h5>
                <h5>Agregar información adicional a la que se encuentra en CV. <button type="button" id="btnAgregar" class="btn btn-success">Add.</button></h5>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <div class="card-box">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover" >
                                    <thead>
                                      <th>Título</th>
                                      <th>Institución</th>
                                      <th>Duración</th>
                                      <th>Nivel</th>
                                      <th>Fecha Ingreso</th>
                                      <th>Fecha Salida</th>
                                    </thead>
                                    <tbody id="productsA" name="productsA">
                                      @if (isset($academicoIns))
                                        @for ($i=0;$i<count($academicoIns);$i++)
                                          <tr class="even gradeA" id="academicos{{$academicoIns[$i]->idpacademico}}">
                                            <td>{{$academicoIns[$i]->titulo}}</td>
                                            <td>{{$academicoIns[$i]->establecimiento}}</td>
                                            <td>{{$academicoIns[$i]->duracion.': '.$academicoIns[$i]->periodo}}</td>
                                            <td>{{$academicoIns[$i]->nombrena}}</td>
                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$academicoIns[$i]->fingreso)->format('d/m/Y')}}</td>
                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$academicoIns[$i]->fsalida)->format('d/m/Y')}}</td>
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
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>III. Antecedentes laborales</h5>
                <h5>Agregar información adicional a la que se tiene en CV.<button id="btnAgregarE" type="button" class="btn btn-success">Add.</button></h5>
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
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>IV. Metas (académicas, personales, laborales, entre otras)</h5>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover" >
                                <thead>
                                    <tr>
                                        <th style="width: 20%">Meta a corto plazo:</th><td>&nbsp;&nbsp;<input type="textt" id="mcorto" maxlength="100"></td>
                                    </tr>
                                    <tr>
                                        <th>Meta a mediano plazo:</th><td>&nbsp;&nbsp;<input type="textt" id="mmediano" maxlength="100"></td>
                                    </tr>
                                    <tr>
                                        <th>Meta a largo plazo:</th><td>&nbsp;&nbsp;<input type="textt" id="mlargo" maxlength="100"></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>V. Preguntas importantes</h5>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover" >
                                <thead>
                                    <tr>
                                        <th style="width: 20%">¿Cómo se describe así mismo?</th><td>&nbsp;&nbsp;<input type="textt" id="descpersonal" maxlength="300"></td>
                                    </tr>
                                    <tr>
                                        <th>¿Le gusta trabajar en equipo?</th><td>&nbsp;&nbsp;<input type="textt" id="trabajoequipo" maxlength="150"></td>
                                    </tr>
                                    <tr>
                                        <th>¿Mantiene un equilibrio bajo la presión del trabajo?</th><td>&nbsp;&nbsp;<input type="textt" id="bajopresion" maxlength="150"></td>
                                    </tr>
                                    <tr>
                                        <th>¿Le gusta la atención al público?</th><td>&nbsp;&nbsp;<input type="textt" id="atencionpublico" maxlength="100"></td>
                                    </tr>
                                    <tr>
                                        <th>Es ordenado.</th><td>&nbsp;&nbsp;<input type="textt" id="ordenado" maxlength="2"></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>VI. Comentarios, observaciones y recomendaciones</h5>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover" >
                                <thead>
                                    <tr>
                                        <th style="width: 25%">Se presentó en el horario citado:</th><td>&nbsp;&nbsp;<input type="textt" id="puntual" maxlength="100"></td>                            
                                    </tr>
                                    <tr>
                                        <th>Comó es su presentación personal:</th><td>&nbsp;&nbsp;<input type="textt" id="presentacion" maxlength="300"></td>
                                    </tr>
                                    <tr>
                                        <th>Tiene disponibilidad inmediata: </th><td>&nbsp;&nbsp;
                                        <input type="checkbox" id="disponibilidad" value="Si">Si
                                        <input type="checkbox" id="disponibilidad" value="No">No</td>
                                    </tr>
                                    <tr>
                                        <th>Tiene disponibilidad de horario incluso en fines de semana cuando así se requiera:</th><td>&nbsp;&nbsp;
                                        <input type="checkbox" id="dispfinsemana" value="Si">Si
                                        <input type="checkbox" id="dispfinsemana" value="No">No</td>
                                    </tr>
                                    <tr>
                                        <th>Se sabe comunicar:</th><td>&nbsp;&nbsp;<input type="textt" id="comunicar" maxlength="100"></td>
                                    </tr>
                                    <tr>
                                        <th>Tiene disponibilidad para viajar:</th><td>&nbsp;&nbsp;
                                        <input type="checkbox" id="dispoviajar" value="Si">Si
                                        <input type="checkbox" id="dispoviajar" value="No">No
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>¿Está dispuesto(a) a trabajar bajo presión?</th><td>&nbsp;&nbsp;<input type="textt" id="bajopresion" maxlength="150"></td>
                                    </tr>
                                    <tr>
                                        <th>¿Cuál es su pretensión salarial mínima?</th><td>&nbsp;&nbsp;<input type="textt" id="pretensionminima" maxlength="10"></td>
                                    </tr>
                                    <tr>
                                        <th>Recomendaciones o observaciones que se consideren</th><td></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>Nombres de las personas que entrevistaron</h5>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover" >
                                <tbody>
                                    <tr>
                                        <th style="width: 5%">&nbsp;&nbsp;&nbsp;&nbsp;-</th><td>&nbsp;&nbsp;<input type="textt" id="entrevistadores" maxlength="200"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <button type="button" id="btnprecalguardar" class="btn btn-primary">Guardar</button>
        <button type="button" id="btndescargar" class="btn btn-primary">Descargar</button>
    </div>
</form>




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
                <input type="hidden" id="idempleado" value="{{$persona->idempleado}}">
                <input type="hidden" id="identificacion" value="{{$persona->identificacion}}">

                  <div class="form-group">
                      <label>Título</label>
                      <input class="form-control" id="titulo" name="titulo">
                  </div>                                          
                                                
                  <div class="form-group">
                      <label>Establecimiento</label>
                      <input class="form-control" id="establecimiento" name="establecimiento"/>
                  </div>                                                           
                  <div class="col-lg-6 ">
                  <label for="duracion">Duración</label>
                      <div class="form-group">
                        
                        <div class="col-lg-6 col-md-3 col-sm-3 col-xs-3">
                          <input id="duracion" class="form-control" onkeypress="return valida(event)">
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
                  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-6">
                    <div class="form-group ">
                      <label >Fecha de ingreso</label>
                      <input type="text" id="fechaingreso" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-6">
                    <div class="form-group ">
                      <label for="fsalida">Fecha de salida</label>
                      <input type="text" id="fechasalida" class="form-control">
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
    <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
        <script src="{{asset('assets/js/RHjs/preentrevista.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>
        <script src="{{asset('assets/js/RHjs/RHPEacad.js')}}"></script>
        <script src="{{asset('assets/js/RHjs/RHPEexp.js')}}"></script>



        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>
@endsection