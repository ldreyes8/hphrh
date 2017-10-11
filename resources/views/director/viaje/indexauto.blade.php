<link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Gastos autorizados</h4>
    <hr style="border-color:black;" />

    <div><p><br></p></div>
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
    <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Solicitante</th>
                    <th>Caso</th> 
                    <th>Monto solicitado</th>
                    <th>Proyecto</th>
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
                    	<a onclick="cargar_formularioviaje(22);"><button class="btn btn-primary btn-md" title="Detalles"><i class="ion-clipboard"></i></button></a>
                    </td>
                </tr>
                @endforeach    
            </table>
        </div>
    </div>
</div>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
<script src="{{asset('assets/js/permiso.js')}}"></script>