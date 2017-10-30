<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Solicitud de viaje</h4>
    <h4 class="text-center">Nombre: {{$empleado->nombre}}</h4>
    <input type="hidden" id="idge" value="{{$empleado->idgastocabeza}}">
    <a onclick="cargar_formularioviaje(20);"><button class="btn btn-md btn-success waves-effect waves-light" title="Regresar"><i class="ion-arrow-left-a"></i></button></a>
    <hr style="border-color:black;" />

    <div><p><br></p></div>
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
    <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    	<h4 class="text-center">Detalles de solicitud</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th style="width: 11%">Monto Solicitado</th> 
                    <th style="width: 11%">Forma de pago</th>
                    <th style="width: 9%">Fecha Inico</th>
                    <th style="width: 9%">Fecha Fin</th>                               
                    <th style="width: 20%">Proyecto</th>
                    <th style="width: 27%">Motivo viaje</th>
                </thead>
                <tbody>
                @foreach($viaje as $v)
	                <tr>
	                    <td>{{$v->moneda.' '.$v->montosolicitado}}</td>
	                    <td>{{$v->chequetransfe}}</td>
	                    <td>{{$v->fechainicio}}</td>
                    	<td>{{$v->fechafin}}</td>
	                    <td>{{$v->nombreproyecto}}</td>
	                    <td>{{$v->motivo}}</td>
	                </tr>
	            @endforeach
                </tbody>  
            </table>
        </div>
    </div>
    @if (isset($vehiculo))
    @if (count($vehiculo) > 0)
    <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    	<h4 class="text-center">Vehiculo solicitado</h4>
        <div class="table-responsive">
            <table id="tablavh" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                	<th>Opciones</th>
                    <th>Marca</th> 
                    <th>Placa</th>
                    <th>Color</th>
                    <th>Kilometraje</th>                               
                    <th>Status vehiculo</th>
                </thead>
                <tbody>
                	@for ($i=0;$i<count($vehiculo);$i++)
	                <tr class="even gradeA" id="vc{{$vehiculo[$i]->idviajevehiculo}}">
	                	<td style="width: 9%">
	                		<button class="btn btn-danger quitar" id="quitar" value="{{$vehiculo[$i]->idviajevehiculo}}" title="Eliminar">
	                			<i class="fa fa-remove"></i>
	                		</button>
	                	</td>
	                    <td>{{$vehiculo[$i]->marca}}<input type="hidden" class="idvehiculo" value="{{$vehiculo[$i]->idvehiculo}}"></td>
	                    <td>{{$vehiculo[$i]->placa}}</td>
	                    <td>{{$vehiculo[$i]->color}}</td>
                    	<td>{{$vehiculo[$i]->kilacumulado}}</td>
	                    <td>{{$vehiculo[$i]->statusvehiculo}}</td>
	                </tr>
	            	@endfor
                </tbody>  
            </table>
        </div>
    </div>
    @endif
   	@endif
   	<!--
    <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    	<h4 class="text-center">Asistente</h4>
        <div class="table-responsive">
            <table id="tablavh" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                	<th>Opciones</th>
                    <th>Nombre</th> 
                    <th>Apellido</th>
                    <th>Afiliado</th>
                    <th>Puesto</th>                               
                    <th>Status</th>
                </thead>
                <tbody>
                @foreach($asistente as $asi)
	                <tr>
	                	<td style="width: 9%">
	                		<button class="btn btn-danger quitar" id="quitar"  title="Eliminar">
	                			<i class="fa fa-remove"></i>
	                		</button>
	                	</td>
	                    <td>{{$asi->nombre1}}</td>
	                    <td>{{$asi->apellido1}}</td>
	                    <td>{{$asi->afiliado}}</td>
                    	<td>{{$asi->puesto}}</td>
	                    <td>{{$asi->statusemp}}</td>
	                </tr>
	            @endforeach
                </tbody>  
            </table>
        </div>
    </div>
    -->
    <div class="row" id="conte">
        <div class="panel panel-primary">
       	    <div class="panel-body">
       			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                		    <label class="radio-inline"><input type="radio" name="rconfirma" id="rconfirma" value="Autorizado" checked>Autorizar</label>
                        	<label class="radio-inline"><input type="radio" name="rconfirma" id="rconfirma" value="Rechazado" >Rechazar</label>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="card-box m-t-20">
                            	<div class="p-20">
                                  <form role="form">
    		                          <div class="form-group">
    		                              <input type="email" class="form-control" name="receptor" id="receptor" value="{{$empleado->email}}">
    		                          </div>

                                  <div class="form-group">
                                      <textarea class="form-control" placeholder=".........." id="observacion" rows="3" maxlength="100"></textarea>
    		                          </div>  
    		                          </form>
                       			  </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-purple waves-effect waves-light" id="btngastoviaje"  <span>Enviar</span> <i class="fa fa-send m-l-10"></i> </button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </div>
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
<script src="{{asset('assets/js/JefeInmediato/viajejf.js')}}"></script>