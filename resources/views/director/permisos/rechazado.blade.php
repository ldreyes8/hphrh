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
            		<h2 class="text-center">Listados de permisos rechazados</h2>
            		<h4 class="text-center">Nombre: {{$empleado->nombre}}</h4>
            		<h4 class="text-center">Identificación: {{$empleado->identificacion}}</h4>
            	</div>
          	</div>
        </div>
    </div>
<div><br></div>

<div class="row">
    <input type="hidden" name="idausencia" id="idausencia"  value="{{$empleado->idausencia}}">
    <input type="hidden" class="form-control" name="name" id="name" value="{{Auth::user()->email}}">
	<div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
	 		<tbody>
			
			<tr>
				<th>Fecha solicitud</th><td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fechasolicitud)->format('d-m-Y')}}</td>
				<th>Tipo permiso</th><td>{{$empleado->ausencia}}</td>
				<th>Concurrente</th><td>{{$empleado->concurrencia}}</td>
			</tr>
			<tr>
				<th>Fecha inicio</th><td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fechainicio)->format('d-m-Y')}}</td>
				<th>Fecha final</th><td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $empleado->fechafin)->format('d-m-Y')}}</td>
				<th>Total días</th>	
			</tr>

			<tr>
				<th>Hora inicio</th><td>{{$empleado->horainicio}}</td>
				<th>Hora final</th><td>{{$empleado->horafin}}</td>
				<th>Total horas</th><td>{{$empleado->totalhoras}}</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>



	
@endsection

@section('fin')
    @parent
        <script src="{{asset('assets/plugins/summernote/dist/summernote.min.js')}}"></script>
        <script src="{{asset('assets/js/permiso.js')}}"></script>
            <meta name="_token" content="{!! csrf_token() !!}" />


		<script>
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