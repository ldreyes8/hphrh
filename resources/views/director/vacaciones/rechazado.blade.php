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