@if (isset($historialvacaciones))
    <div class=class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<div class="navbar-form navbar-left pull-left">
				<button class="btn btn-success btn-md" onclick="rh_reportes(0);"><i class="fa fa-reply-all"></i></button>
			</div>
			<h4 class="box-title" align="center">Historial de vacaciones del año {{$year}}</h4> 
			<hr style="border-color:black;" />
		</div>
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4>Días disponibles a la fecha: {{$calculo[1].' días con '.$calculo[0].' horas'}}</h4>
            </div>
	    </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItems">
                <thead>
                    <th>Solicitud</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Días tomados</th>
                    <th>Horas tomadas</th>
                    <th>Autorizacion</th>
                </thead>
                @foreach ($historialvacaciones as $aus)
                <tr>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechasolicitud)->format('d-m-Y')}}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechainicio)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechafin)->format('d-m-Y')}}</td>             
                    @if(($aus->htomado/10000) == -4)
                        <td>{{$aus->diastomados - 1}}</td>
                        <td>{{abs($aus->htomado)/10000}}</td>
                    @elseif($aus->autorizacion == 'Rechazado' || $aus->autorizacion == 'solicitado')
                        <td>0</td>
                        <td>0</td>
                    @else
                        <td>{{$aus->diastomados}}</td>
                        <td>{{$aus->htomado / 10000}}</td>
                    @endif
                        <td>{{$aus->autorizacion}}</td>
                </tr>                
                @endforeach
            </table>
        </div>
    </div>
@endif