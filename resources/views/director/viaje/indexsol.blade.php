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
                <tr>
                    <td>Luis Reyes</td>
                    <td>Caja Chica</td>
                    <td>5000</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    	<a href="#"><button class="btn btn-success btn-md" id="btnconfirma" title="Aceptar"><i class="ion-checkmark-circled"></i></button></a>
                    	<a href="#"><button class="btn btn-danger btn-md" id="btnrechazo" title="Rechazar"><i class="ion-close-circled"></i></button></a>
                    </td>
                </tr>
                <tr>
                    <td>Luis Reyes</td>
                    <td>Viaje</td>
                    <td>500</td>
                    <td>Casas Verdes</td>
                    <td>12/02/2018</td>
                    <td>15/02/2018</td>
                    <td>
                    	<a href="#"><button class="btn btn-success btn-md" id="btnconfirma1" title="Aceptar"><i class="ion-checkmark-circled"></i></button></a>
                    	<a href="#"><button class="btn btn-danger btn-md" id="btnrechazo1" title="Rechazar"><i class="ion-close-circled"></i></button></a>
                    </td>
                </tr>    
            </table>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/permiso.js')}}"></script>
<script src="{{asset('assets/js/JefeInmediato/viajejf.js')}}"></script>