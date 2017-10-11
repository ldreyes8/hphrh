<div class="card-box" id="lisadoEmp">
    @if (isset($empleado))      
        @include('rrhh.empleados.search')
        <div class="row">

           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="table-responsive">
                     <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                             <th>Id</th>
                             <th>Identificación</th>
                             <th>Nit</th>
                             <th>Nombre</th>
                             <th>Afiliado</th>
                             <th>Puesto</th>
                             <th>Status</th>
                             <th style="width: 20%">Opciones</th>
                        </thead>
                         @foreach ($empleado as $em)
                        <tr>
                            <td>{{$em->idempleado}}</td>
                            <td>{{$em->identificacion}}</td>
                            <td>{{$em->nit}}</td>
                            <td>{{$em->persona->nombre1.' '.$em->persona->nombre2.' '.$em->persona->apellido1.' '.$em->persona->apellido2}}</td>
                            <td>{{$em->afiliado}}</td>
                            <td>{{$em->puesto}}</td>
                            <td>{{$em->statusn}}</td>
                            
                            <td>
                                <a href="{{URL::action('ListadoController@show',$em->identificacion)}}"><button class="btn btn-primary" title="Detalles"><i class="glyphicon glyphicon-zoom-in"></i></button></a>
                                <a href="{{URL::action('ListadoController@laboral',$em->idempleado)}}"><button class="btn btn-primary" title="Historial laboral"><i class="fa fa-stack-overflow"></i></button></a>
                                @if($em->statusn=='Activo')
                                <button class="btn btn-primary btn-vacacionesE" value="{{$em->idempleado}}" title="Vacaciones"><i class="fa fa-camera-retro fa-xs"></i></button>
                                @else
                                <button class="btn btn-success btn-evaluaprueba" id="btnsaldo" value="{{$em->idempleado}}" title="Evaluacion de periodo Prueba"><i class="md md-border-color"></i></button>
                                @endif
                                <button class="btn btn-danger btn-despedir" id="FWEF" value="{{$em->idempleado}}" title="Despedir" ><i class="fa fa-remove"></i></button>
                            </td>

                        </tr>

                         @endforeach
                     </table>
                 </div>
                 {{$empleado->render()}}
           </div>
        </div>
    @endif

    <div class="col-lg-12">
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <input type="hidden" name="tdias" id="tdias">
                    <input type="hidden" name="thoras" id="thoras">

                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="inputTitle"></h4>
                    </div>
                    <form role="form" id="formAgregar">
                        <div class="modal-header">
                        <br>                           
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Días acumulados</label>
                                <input id="dacumulado" type="text" class="form-control" name="dias">   
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
      <div class="modal fade" id="formModalDespedir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <input type="hidden" name="idemple" id="idemple">
                  <input type="hidden" name="identifica" id="identifica">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="inputTitleDespedir"></h4>
                  </div>

                  <form role="form" id="formDespedir">
                      <div class="modal-header">
                          <br>                           
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label class="control-label">Nombre</label>
                              <input id="nombreC" type="text" class="form-control" name="dias" aria-describedby="basic-addon1">   
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label class="control-label">Fecha despido</label>
                              <input type="text" id="fecha_inicio" class="form-control" name="fechainicio">
                          </div>
                          <label>Tipo de baja</label>
                          <select name="idstatus" id="idstatus" class="form-control select2" data-live-search="true">
                          @if (isset($status))
                              @foreach($status as $sta)
                              <option value="{{$sta->idstatus}}">{{$sta->statusemp}}</option>
                              @endforeach
                          @endif
                          </select>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <label>Motivo</label>
                              <textarea class="form-control" placeholder=".........." id="observaciones" rows="3" maxlength="300"></textarea>
                          </div>
                      </div> 
                  </form>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary btn-adddespedir" id="btnGuardarBaja">Guardar</button>
                      <input type="hidden" name="idE" id="idE" value="0"/>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>
<div class="col-lg-12">
  <div class="modal fade" id="formModalpp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="inputTitlepp"></h4>
        </div>
        <input type="hidden" name="idemple" id="idemple" >
        <form role="form" id="formAgregarpp">
          <div class="modal-header">
          <br>                           
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <button type="button" class="btn btn-primary btn-satisfac" id="btnGuardarBaja">Satisfactorio</button>  
              <button type="button" class="btn btn-danger btn-insatisfac" id="btnGuardarBaja">In-Satisfactorio</button>  
              <button type="button" class="btn btn-success btn-pprueba" id="btnGuardarBaja">Seguir en periodo de prueba</button>   
            </div>
          </div>
        </form>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <input type="hidden" name="idE" id="idEmp" value="0"/>
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


<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>

<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".select2").select2();        
  });
</script>