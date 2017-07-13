<div class="tab-pane" id="pvaceptados">
    @if (isset($permisos))
        <div class="row">
        	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h3>Vacaciones y/o perimisos autorizados</h3>
        	</div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover table-responsive" >
                        <thead>
                            <th style="width: 8%">Solicitud</th>
                            <th style="width: 8%">Identificaci&oacute;n</th>
                            <th style="width: 8%">Fecha inicio</th>
                            <th style="width: 8%">Fecha final</th>
                            <th style="width: 8%">D&iacute;as solicitados</th>
                            <th style="width: 8%">Horas solicitados</th>
                            <th style="width: 8%">Tipo permiso</th>
                            <th style="width: 8%">Solicitante</th>
                            <th style="width: 8%">Autorizado</th>
                            <th style="width: 15%">Observaciones</th>
                        </thead>
                        @foreach ($permisos as $per)
                        <tr>
                            <td style="width: 8%"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $per->fechasolicitud)->format('d-m-Y')}}</td>
                            <td style="width: 8%"> {{$per->identificacion}}</td>
                            <td style="width: 8%"> {{$per->fechainicio}}</td>
                            <td style="width: 8%"> {{$per->fechafin}}</td>
                            <td style="width: 8%"> {{$per->totaldias.' '.'D&iacute;as'}}</td>
                            <td style="width: 8%"> {{$per->totalhoras}}</td>
                            <td style="width: 8%">{{$per->ausencia}}</td>
                            <td style="width: 8%"> {{$per->nombre}}</td>
                            <td style="width: 8%"> {{$per->name}}</td> 
                            <td style="width: 15%"> {{$per->observaciones}}</td>      
                        </tr>                
                        @endforeach
                     </table>
                 </div>
                 
           </div>
        </div>
    @endif
</div>