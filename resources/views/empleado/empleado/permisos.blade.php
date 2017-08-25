<div class="card-box">
    <div class="panel-heading">
        <button class="btn btn-success" id="btnnuevoP"><i class="icon-user icon-white" ></i>Nueva solicitud de permiso</button>
    </div>
    <div><br></div>
    <div class="row">
       <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsPermiso"> 
                    <thead>
                        <th>Solicitud</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Hora inicio</th>
                        <th>Hora final</th>
                        <th>Tipo permiso</th>
                        <th>Autorizacion</th>
                    </thead>
                    @if (isset($ausencias))
                        @foreach ($ausencias as $aus)
                        <tr>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechasolicitud)->format('d-m-Y')}}</td>

                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechainicio)->format('d-m-Y')}}</td>
                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechafin)->format('d-m-Y')}}</td>
                            <td>{{$aus->horainicio}}</td>
                            <td>{{$aus->horafin}}</td>
                            <td>{{$aus->tipoausencia}}</td> 
                            <td>{{$aus->autorizacion}}</td>
                         </tr>
                        @endforeach
                    @endif
                </table>
            </div>
       </div>
    </div>
</div>   
     
<div class="col-lg-12">
    <div class="modal fade" id="formModalP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            @if (!empty($usuarios->idmunicipio))
                <input type="hidden" name="idmunicipio" value="{{$usuarios->idmunicipio}}" id="idmunicipio">
            @else
                <td><input type="hidden" name="" id="municipio" value=""></td>
            @endif

            @if (isset($usuarios))
                <input type="hidden" name="tdias" id="tdias">
                <input type="hidden" name="thoras" id="thoras">
                <input type="hidden" name="idempleado" id="idempleado" value="{{$usuarios->idempleado}}">
                <input type="hidden" name="name"  id="name" value="{{$usuarios->nombre}}"> 
            @endif()

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="inputTitleP"></h4>
            </div>
              
            <form role="form" id="formAgregarP">
                <div class="modal-header">
                    <label>Motivo ausencia</label>
                    <select name="idtipoausencia" id="idtipoausencia" class="form-control select2" data-live-search="true">
                    @if (isset($tausencia))
                    @foreach($tausencia as $tau)
                        <option value="{{$tau->idtipoausencia}}">{{$tau->ausencia}}</option>
                    @endforeach
                    @endif
                    </select>
                </div>

                <div class="modal-header" id="divJ">
                    <div><p><br></p></div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                    <label>Juzgado o Institución</label>
                    <input type="text" name="juzgadoinstitucion" id="Jusgado" class="form-control" placeholder="">
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">                 
                    <label for="nombre">Tipo caso</label>
                    <input type="text" name="tipocaso" class="form-control" placeholder="" id="tipocaso">
                    </div>                
                </div>

                <div class="modal-header">
                    <div><p><br></p></div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label">Fecha inicio</label>
                        <div class="input-group">
                            <input type="text" id="fecha_inicio" class="form-control" name="fechainicio">
                            <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                        </div> 
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label">Fecha final</label>
                        <div class="input-group">
                            <input type="text" id="fecha_final" class="form-control" name="fechafin">
                            <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="modal-header" id="divCHM">
                    <div><p><br></p></div>
                    

                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12">
                        <div><label>Recurrente</label></div>
                        <select name="concurrencia" class="form-control" id="concurrencia">
                            <option value="No">No</option>
                            <option value="Si">Si</option>
                        </select>
                       
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="horainicio">Hora inicio</label>
                            <select name="horainicio" id="hinicio" class="form-control">
                                <option value="00">00</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                            </select>
                        
                    </div>
      
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Minutos inicio</label>              
                            <select name="mini" class="form-control" id="mini">
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                    </div>                    
                </div>
                
                <div class="modal-header" id="divHMF">

                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12">
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label for="horainicio">Hora fin</label>
                            <select name="horafin" id="hfin" class="form-control" >
                                <option value="00">00</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                            </select>
                        
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            
                            <label>Minutos finales</label>
                            
                                <select name="mfin" class="form-control" id="mfin">
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                           
                    </div>
                </div>
              
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="divENF">
                    <div class="modal-header">
                        <br>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <button type="button" class="btn btn-success" id="btndatomarP">Calcular Días</button>
                        </div>
                                        
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <label for="numerodependientes">D&iacute;as</label>
                            <input id="datomarP" type="number" name="numerodependientes" min="0" class="form-control" onkeypress="return valida(event)">
                        </div>

                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <label for="horainicio">Hora</label>
                            <select name="hhoras" id="hhorasP" class="form-control">
                                <option value="00">0</option>
                                <option value="04">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-header">
                        <input type="checkbox" id="casillaP" value="1" onclick="desactivar1()"/>Activar campo Dias y Hora
                    </div> 
                </div>

                <div class="modal-header">
                    <div><p><br></p></div>
                    <div class="form-group">
                        <label>Justificación</label>
                        <textarea class="form-control" placeholder=".........." id="observaciones" rows="3" maxlength="100"></textarea>
                    </div>
                </div>
            </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnguardarP">Guardar</button>
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
        <h4 class="modal-title" id="inputErrorP"></h4>

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

	<script type="text/javascript">

        $(document).ready(function() {
            $(".select2").select2();
        });

		$('#btnnuevoP').click(function(e){      
	        $('#inputTitleP').html("Solicitud de permiso");
	        $('#formAgregarP').trigger("reset");
	        $('#formModalP').modal('show');
	        $('#datomarP').attr('disabled', 'disabled');
	        $('#hhorasP').attr('disabled', 'disabled');
	        $('#dacumulado').attr('disabled', 'disabled');
	        $('#btnguardarV').attr('disabled', 'disabled');           
	    });

	    function desactivar1() {
	        if($("#casillaP:checked").val()==1) {
	            $("#casillaP").attr('disabled', 'disabled');
	            $('#datomarP').removeAttr("disabled");
	            $('#hhorasP').removeAttr("disabled");
	        }
	    }

	    function mostrar() {
	        if($("#inlineRadio2:checked").val()=="Goce_temporal") {
	            $("#oculto").show();
	            $("#inlineRadio16").attr('disabled', 'disabled');
	            $("#inlineRadio1").attr('disabled', 'disabled');
	        }
	    }            
	</script>

    <script src="{{asset('assets/js/permisoU.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

   

