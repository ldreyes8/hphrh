 @section('estilos')
    @parent
    <link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote.css')}}">
@endsection

@extends ('layouts.index')
@section ('contenido')

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<div class="form-group">
          		 <!--
              <div class="col-md-2 col-md-12 col-sm-12 col-xs-12">
                @include('hr.foto')
              </div>-->
          		<div class="col-md-10 col-md-12 col-sm-12 col-xs-12">
            		<h3 class="text-center">SOLICITUD DE CONFIRMACIÓN</h3>
            		<h4 class="text-center">Nombre: {{$empleado->nombre}}</h4>
            		<h4 class="text-center">Identificación: {{$empleado->identificacion}}</h4>
                <h4 class="text-center">Status vacaciones: {{$dias->goce}}</h4>
            	</div>
          	</div>
        </div>
    </div>
<div><br></div>

<div class="row">
    <input type="hidden" name="idausencia" id="idausencia"  value="{{$empleado->idausencia}}">
    <input type="hidden" class="form-control" name="name" id="name" value="{{Auth::user()->email}}">
    <input type="hidden" name="idempleado" id="idempleado" value="{{$empleado->idempleado}}">
    <input type="hidden" name="hatomar" id="hatomar" value="{{$empleado->totalhoras}}">
    <input type="hidden" name="datomar" id="datomar" value="{{$empleado->totaldias}}">
    <input type="hidden" name="idvacadetalle" id="idvacadetalle" value="{{$dias->idvacadetalle}}">
    <input type="hidden" name="goces" id="goce" value="{{$dias->goce}}">

    
	<div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
  	 		<tbody>
          
    			<tr>
    				<th>Fecha solicitud</th><td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fechasolicitud)->format('d-m-Y')}}</td>
    				<th>Tipo permiso</th><td>{{$empleado->ausencia}}</td>  		
    			</tr>
    			<tr>
    		    <th>Fecha inicio</th><td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fechainicio)->format('d-m-Y')}}</td>
    				<th>Fecha final</th><td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fechafin)->format('d-m-Y')}}</td>
    			</tr>
    			<tr>
            <th>Días solicitados</th><td>{{$empleado->totaldias}} dias</td>
    		    <th>Horas solictadas</th><td>{{$empleado->totalhoras}} horas</td>
    			</tr>
          <tr>
            <th>Días no tomados</th><td>{{$dias->soldias}} dias</td>
            <th>Horas no tomadas</th><td>{{$dias->solhoras}} horas</td>
          </tr>
  			</tbody>
  		</table>
  	</div>
  </div>
</div>
<div class="row" id="edit">
	<div class="panel panel-primary">
   		<div class="panel-body">
   			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="form-group">
            <label class="radio-inline"><input type="radio" checked="" name="autorizacion" value="Confirmado" id="rconfirmar">Confirmar</label>
          </div>
          <button type="button" class="btn btn-success" id="btneditar">Editar dias tomados</button>
          <div class="row" id="oculto">
            <div class="col-sm-10">
              <div class="card-box m-t-20">
                <div class="p-20">
                  <form role="form">
                    <div class="modal-header" >                
                      <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <label for="dnotomado">Dias</label>
                        <input id="dnotomado" type="number" name="dnotomado" min="0" class="form-control" onkeypress="return valida(event)" value="{{$dias->soldias}}">
                      </div>

                      <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <label for="horainicio">Hora</label>
                        <select name="hhoras" id="hhoras" class="form-control">
                          <option value="{{$dias->solhoras}}">{{$dias->solhoras}}</option>
                          <option value="00">00</option>
                          <option value="04">04</option>
                        </select>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
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
                      <textarea class="form-control" placeholder=".........." id="observaciones" rows="3" maxlength="100"></textarea>
		                </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
            	
          <div class="form-group" id="botones">
            <button class="btn btn-purple waves-effect waves-light" id="btnconfirmarv" <span>Enviar</span> <i class="fa fa-send m-l-10"></i> </button>
        		<button class="btn btn-danger" type="reset">Cancelar</button>
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
        <script src="{{asset('assets/plugins/summernote/dist/summernote.min.js')}}"></script>
        <script src="{{asset('assets/js/permiso.js')}}"></script>
        <meta name="_token" content="{!! csrf_token() !!}" />


		<script>
       $("#oculto").hide();
       nivel = $("#goce").val();
       if(nivel == '')
       {
        $("#botones").hide();
        $("#edit").hide();        
       }

            jQuery(document).ready(function () {
         

                $('.summernote').summernote({
                    height: 350,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
            });
        </script>
@endsection