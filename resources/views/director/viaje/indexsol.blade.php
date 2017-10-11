<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Solicitud de gastos</h4>
    <hr style="border-color:black;" />

    <div><p><br></p></div>
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
    <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Solicitante</th>
                    <th>Tipo de caso</th> 
                    <th>Monto solicitado</th>
                    <th>Tipo proyecto</th>
                    <th>Inicio</th>
                    <th>Fin</th>                               
                    <th>Opciones</th>
                </thead>
                @foreach($viaje as $v)
                <tr>
                    <td>{{$v->nombre}}</td>
                    <td>{{$v->tipogasto}}</td>
                    <td>{{$v->montosolicitado}}</td>
                    <td>{{$v->nombreproyecto}}</td>
                    <td>{{$v-fechainicio}}</td>
                    <td>{{$v-fechafin}}</td>
                    <td>
                        @if($v->tipogasto=='Caja Chica')
                            <a href="#"><button class="btn btn-success btn-md" id="btnconfirmac" title="Aceptar"><i class="ion-checkmark-circled"></i></button></a>
                            <a href="#"><button class="btn btn-danger btn-md" id="btnrechazoc" title="Rechazar"><i class="ion-close-circled"></i></button></a>
                        @else
                            <a href="#"><button class="btn btn-success btn-md" id="btnconfirmav" title="Detalles"><i class="ion-checkmark-circled"></i></button></a>
                            <a href="#"><button class="btn btn-danger btn-md" id="btnrechazov" title="Rechazar"><i class="ion-close-circled"></i></button></a>
                        @endif
                    </td>
                </tr>
                @endforeach   
            </table>
        </div>
        {{$viaje->render()}}
    </div>
</div>
<script src="{{asset('assets/js/permiso.js')}}"></script>
<script src="{{asset('assets/js/JefeInmediato/viajejf.js')}}"></script>