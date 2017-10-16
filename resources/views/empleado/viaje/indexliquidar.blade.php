<style type="text/css">
 
#tabla{ border: solid 1px #333; width: 300px; }
#tabla tbody tr{ background: #999; }
.fila-base{ display: none; } /* fila base oculta */
.eliminar{ cursor: pointer; color: #000; }
input[type="text"]{ width: 40px; } /* ancho a los elementos input="text" */
 
</style>
<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Liquidaci&oacute;n viaje</h4>
    <hr style="border-color:black;" />

    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>" />

   
                                                

    <div class="panel">

        <div class="form-group">
            <label class="col-md-2 control-label">Monto solicitado</label>
            <div class="col-md-4">
                <label>5000</label>            
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Tipo Proyecto</label>
            <div class="col-md-4">
                <label>5000</label>            
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Fecha inicio</label>
            <div class="col-md-4">
                <label>13-04-2017</label>            
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Fecha final</label>
            <div class="col-md-4">
                <label>17-04-2017</label>            
            </div>
        </div>


        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="m-b-30">
                        <button id="addToTable" class="btn btn-primary waves-effect waves-light">Agregar <i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        
            <div class="table-responsive">
                <table class="table table-striped" id="tabprueba">
                    <thead>
                        <tr>
                            <th style="width: 6%">Fecha</th>
                            <th>Descripci&oacute;n</th>
                            <th># Factura</th>
                            <th>Empleado</th>
                            <th>Cuenta</th>
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
                    
                        <tr class="fila-base" id="rowtable">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="actions">                            
                            </td>
                        </tr>
                        <tr>
                            <td>10/05/2017</td>
                            <td>fwefw</td>
                            <td>10</td>
                            <td>Luis</td>
                            <td>Alimentacion</td>
                            <td>ff</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
                            <td>10</td>
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
    </div> 

</div>

<script src="{{asset('assets/js/permiso.js')}}"></script>
<script type="text/javascript">
</script>
<script src="{{asset('assets/js/Empleado/liquidar.js')}}"></script>
<!--
<script type="text/javascript">
    $('#datatable-editable').DataTable({
        order:[[1,'desc']],
        columns:[
        {
             identifier: [0, 'id'],
        editable: [[1, 'nickname'], [2, 'firstname'], [3, 'lastname'],[4,'gender','{"1"}: "Lki-Lki"'],
                  [4, 'lastname'],[5, 'lastname'],[6, 'lastname'],[7, 'lastname'],[8, 'lastname'],[9, 'lastname'],[10, 'lastname']]           
        }]
    });
</script>

-->

