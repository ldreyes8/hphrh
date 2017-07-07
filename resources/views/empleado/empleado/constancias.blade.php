<div class="tab-pane" id="consta">

	<div class="row"> 
	    {!!Form::open(array('url'=>'empleado/Gpdf','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
	    {{Form::token()}}

		    @if (isset($usuario))
		        <input type="hidden" name="idempleado" value="{{$usuario->idempleado}}" id="idempleado">
		    @endif 
	        <div class="col-lg-3 col-md-4">
	            <div class="box box-primary">                        
	                 
	                <div class="card-box"> 
	                    <h4 class="text-center">Reporte</h4>
	                    <div class="member-card">
	                        <div class="form-group">
	                      
	                            <label class="control-label text-center">Fecha inicio</label>
	                            
	                            <div class="form-group">
	                                <input type="text" id="fecha_inicioG" class="form-control" name="fini" required="Este campo es requerido">
	                            </div>
	                       
	                            <label class="control-label">Fecha final</label>
	                            <div class="form-group">
	                                <input type="text" id="fecha_finalG" class="form-control" name="ffin" required="Este campo es requerido">
	                            </div>
	                        </div>
	                                      
	                        <div class="box-footer">
	                            <button type="button" id="btngoce" class="btn btn-primary btn-sm w-sm waves-effect m-t-10 waves-light">Guardar</button>
	                        </div>
	                    </div>
	                </div> 
	            </div>
	            
	            <div class="card-box">
	                <h4 class="m-t-0 m-b-20 header-title">opciones</h4>
	                <button type="submit" class="btn btn-primary" id="btndescargar">Descargar</button> 
	            </div>
	        </div>
	    {{Form::close()}}                

	    <div class="col-md-8 col-lg-9">
	        <div class="tab-content"> 
	            @if (isset($usuario))

	            <div class="row">
	            	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	                  <h3 class="text-center">Constancia de vacaciones</h3>
	                    <h4>Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$usuario->nombre1.' '.$usuario->nombre2.' '.$usuario->nombre3.' '.$usuario->apellido1.' '.$usuario->apellido2}}</h4>
	                    <h4>Puesto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$usuario->puesto}}</h4>
	                    <h4>Ubicaci&oacute;n:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$usuario->afiliado}}</h4>
	                    <h4>Fecha de ingreso a la fundaci&oacute;n:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{\Carbon\Carbon::createFromFormat('Y-m-d',$usuario->fechaingreso)->format('d/m/Y')}}</h4>
	                    <h4>Fecha de emision de la constancia:&nbsp;&nbsp;&nbsp;{{$year}}</h4>
	                    <p>Se hace constar que el colaborador (a) gozó de su período vacacional como se detalla a continuaci&oacute;n</p>
	            	</div>
	            </div>
	            @endif 

	            <div class="row">
	               <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	                    <div class="table-responsive">
	                        <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItemsCon">
	                            <thead>
	                                <th>FECHA DE SOLICITUD</th>
	                                <th>DÍAS TOMADOS</th>
	                                <th>TOTAL DE DIAS</th>
	                                <th>PERÌODO VACACIONAL</th>
	                            </thead>
	                        </table>
	                    </div>
	               </div>
	            </div>

	            <h5 class="text-center">TOTAL DE DIAS &nbsp;&nbsp;&nbsp;&nbsp; <label id="dtomado"></label></h5>

	            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIRMAS DE CONFORMIDAD:</p>

	            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            _______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________
	            </p>
	            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            Jefe inmediato Superior&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Colaborador (a)
	            </p>

	            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________</p>
	            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vº Bº Depto. de Recursos Humanos
	            <br>
	            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(firma y sello)
	            </p>
	        </div>
	    </div>
	</div>
</div>

<div class="modal fade" id="erroresModalC" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	     	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	        	<h4 class="modal-title">Errores</h4>
	      	</div>

	      	<div class="modal-body">
	     		<ul style="list-style-type:circle" id="erroresContentC"></ul>
	      	</div>

	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      	</div>
	    </div>
	</div>
</div>

<script>
    $("#btndescargar").hide();
</script>

<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
<script src="{{asset('assets/js/gocevacaciones.js')}}"></script>
        
