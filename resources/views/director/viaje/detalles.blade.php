<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Detalles de gastos</h4>
    <h4 class="text-center">Nombre: Luis Reyes</h4>
    <h4 class="text-center">Caso: Caja Chica</h4>
    <a onclick="cargar_formularioviaje(21);"><button class="btn btn-md btn-success waves-effect waves-light" title="Regresar"><i class="ion-arrow-left-a"></i></button></a>
    <hr style="border-color:black;" />

    <div><p><br></p></div>
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
    <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Descripción</th> 
                    <th># Factura</th>
                    <th>Empleado</th>
                    <th>LOB L10</th>
                    <th>Donador L8</th>                               
                    <th>Proyecto L9</th>
                    <th>Función L2</th>
                    <th>Monto </th>                               
                    <th>Saldo </th>
                </thead>
                <tr>
                    <td>12/02/2018</td>
                    <td>Compra desayuno</td>
                    <td>00077</td>
                    <td>Luis Reyes</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>40</td>
                    <td></td>
                </tr>
                <tr>
                    <td>12/02/2018</td>
                    <td>Compra desayuno</td>
                    <td>00077</td>
                    <td>Abner Calvac</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>40</td>
                    <td></td>
                </tr>
                <tr>
                	<td>Total</td>
                	<td></td>
                	<td></td>
                	<td></td>
                	<td></td>
                	<td></td>
                	<td></td>
                	<td></td>
                	<td>80</td>
                	<td></td>
                </tr>    
            </table>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/permiso.js')}}"></script>