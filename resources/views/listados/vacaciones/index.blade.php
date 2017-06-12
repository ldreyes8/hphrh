@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de solicitudes de vacaciones</h3>
	</div>
</div>
<div><p><br></p></div>
                <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

<div class="row">
   <div class=class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover table-responsive" >
                <thead>
                    <th style="width: 8%">Solicitud</th>
                    <th style="width: 8%">Identificaci&oacute;n</th>
                    <th style="width: 8%">Fecha inicio</th>
                    <th style="width: 8%">Fecha final</th>
                    <th style="width: 8%">D&iacute;as solicitados</th>
                    <th style="width: 8%">Horas solicitados</th>
                    <th style="width: 8%">Solicitante</th>
                    
                </thead>
                @foreach ($vacaciones as $vac)
                    <tr>
                        <td style="width: 8%">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $vac->fechasolicitud)->format('d-m-Y')}}</td>
                        <td style="width: 8%">{{$vac->identificacion}}</td>
                        <td style="width: 8%">{{$vac->fechainicio}}</td>
                        <td style="width: 8%">{{$vac->fechafin}}</td>
                        <td style="width: 8%">{{$vac->totaldias.' '.'D&iacute;as'}}</td>
                        <td style="width: 8%">{{$vac->totalhoras}}</td>
                        <td style="width: 8%">{{$vac->nombre}}</td>
                     </tr>
                @endforeach
             </table>
         </div>
         {{$vacaciones->render()}}
   </div>
</div>




@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('assets/js/permiso.js')}}"></script>

@endsection