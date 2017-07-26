<div class="card-box" id="pvsolicitados">
@if (isset($vacaciones))
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Vacaciones confirmadas </h3>
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
                        <th style="width: 8%">Solicitante</th>
                        <th style="width: 8%">Autorizado</th>
                        <th style="width: 15%">observaciones</th>

                        
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
                            <td style="width: 8%">{{$vac->name}}</td>
                            <td style="width: 15%"> {{$vac->observaciones}}</td>                       
                         </tr>
                    @endforeach
                 </table>
             </div>
            {{$vacaciones->render()}}

       </div>
    </div>
@endif
</div>