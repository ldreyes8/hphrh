<div class="card-box" id="profile">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Vacaciones y/o Permisos que requieren su autorizaci&oacute;n</h3>
        </div>
    </div>
    <div><p><br></p></div>

    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

    @if (isset($permisos))
        <div class="row">
           <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Solicitud</th>
                            <th>Identificacion</th>
                            <th>Solicitante</th>
                            <th>Fecha inicio</th>
                            <th>Fecha final</th>
                            <th>Tipo caso</th>
                            <th>Opciones</th>
                        </thead>

                        @foreach ($permisos as $per)

                        <tr>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $per->fechasolicitud)->format('d-m-Y')}}</td>
                            <td>{{$per->identificacion}}</td>
                            <td>{{$per->nombre}}</td>
                            <td>{{$per->fechainicio}}</td>
                            <td>{{$per->fechafin}}</td>
                            <td>{{$per->ausencia}}</td>
                            @if($per->ausencia == "Vacaciones")
                             <td><a href="{{URL::action('VacacionesController@verificar',$per->idausencia)}}"><button class="btn btn-primary">Ver</button></a></td>
                            @else
                            <td><a href="{{URL::action('JIPermiso@verificar',$per->idausencia)}}"><button class="btn btn-primary">Ver</button></a></td>
                            @endif
                            
                         </tr>
                        
                        @endforeach
                    </table>
                </div>
           </div>
        </div>
    @endif
</div>

<script src="{{asset('assets/js/permiso.js')}}"></script>

