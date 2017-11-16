<div class=class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<div class="navbar-form navbar-left pull-left">
				<button class="btn btn-success btn-md" onclick="rh_reportes(0);"><i class="fa fa-reply-all"></i></button>
			</div>
			<h4 class="box-title" align="center">Historial de permisos del año {{$year}}</h4>
			<hr style="border-color:black;" />
	</div>
	<div class="row">
	</div>
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
   

