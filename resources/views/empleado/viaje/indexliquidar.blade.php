<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Liquidaci&oacute;n viaje</h4>
    <hr style="border-color:black;" />

    <div><p><br></p></div>
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

    <!--  searchempleado-->

    <div class="panel-heading">
        <button class="btn btn-success btn-openviaje" title="Detalles"><i class="fa fa-plus-square"></i></button>
    </div>

   
    <div class="panel">
    	<div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="m-b-30">
                        <button id="addToTable" class="btn btn-primary waves-effect waves-light">Agregar <i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped" id="datatable-editable">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripci&oacute;n</th>
                            <th>#factura</th>
                            <th>Empleado</th>
                            <th>LOB L10</th>
                            <th>Donador L8</th>
                            <th>Proyecto L9</th>
                            <th>Funci&oacute;n L2</th>
                            <th>Monto</th>
                            <th>Saldo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr class="gradeX">
                                <td>13-07-2017</td>
                                <td>Internet
                                    Explorer 4.0
                                </td>
                                <td>101045-5</td>
                                <td>a</td>
                                <td>atr</td>
                                <td>adf</td>
                                <td>abc</td>
                                <td>br</td>
                                <td>pqrn</td>
                                <td>saldo</td>
                                <td class="actions">
                                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                    <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                    <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>

                             <tr class="gradeX">
                                <td>13-07-2017</td>
                                <td>Internet
                                    Explorer 4.0
                                </td>
                                <td>101045-5</td>
                                <td>a</td>
                                <td>atr</td>
                                <td>adf</td>
                                <td>abc</td>
                                <td>br</td>
                                <td>pqrn</td>
                                <td>saldo</td>
                                <td class="actions">
                                    <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                    <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                    <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                           
                                           
                                        
                    </tbody>
                </table>
            </div>
        </div><!-- end: page -->
    </div> <!-- end Panel -->

</div>

<script src="{{asset('assets/js/permiso.js')}}"></script>
<script type="text/javascript">
</script>

        <script src="{{asset('assets/js/Empleado/viajedt.js')}}"></script>
        <script>
     $('#datatable-editable').DataTable();
$(document).ready(function(){
    $('#datatable-editable').DataTable();
 
});
</script>

