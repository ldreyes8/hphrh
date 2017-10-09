<style type="text/css">
 
#tabla{ border: solid 1px #333; width: 300px; }
#tabla tbody tr{ background: #999; }
.fila-base{ display: none; } /* fila base oculta */
.eliminar{ cursor: pointer; color: #000; }
input[type="text"]{ width: 80px; } /* ancho a los elementos input="text" */
 
</style>
<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Liquidaci&oacute;n viaje</h4>
    <hr style="border-color:black;" />

    <div><p><br></p></div>
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

    <!--  searchempleado-->
       <div class="col-6 col-md-6">
                <select id="abc" class="form-control"></select>
            </div>
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

     

        
<select class="form-control select2" id="empleado"></select>
            <div class="table-responsive">
                <table class="table table-striped" id="tabprueba">
                    <thead>
                        <tr>
                            <th style="width: 6%">Fecha</th>
                            <th>Descripci&oacute;n</th>
                            <th># Factura</th>
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
                    <!--
                    <tr class="fila-base">
                        <td><input type="text" autofocus class="form-control" data-mask="99/99/9999" value="" input-block placeholder="dd/mm/yyyy"></td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" name=""></td>
                        <td><select class="form-control select2" id="empleado"></select></td>
                        <td><select class="form-control"><option>l10</option></select></td>
                        <td><select class="form-control"><option>L8</option></select></td>
                        <td><select class="form-control"><option>L9</option></select></td>
                        <td><select class="form-control select2"><option>funcion</option></select></td>
                        <td><input type="text" class="form-control" name=""></td>
                        <td><input type="text" class="form-control" name="" disabled></td>
                        <td class="actions">
                            <a href="#" class="on-editing save-row"><i class="fa fa-save"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    -->
                           
                    @foreach($liquidaciones as $liq)
                        <tr>
                        <td>{{$liq->fecha}}</td>
                        <td></td>
                        <td>{{$liq->factura}}</td>
                        <td>{{$liq->empleado}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="actions">
                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                        </td>
                        </tr>

                    @endforeach                                           
                                        
                    </tbody>
                </table>
            </div>
        </div><!-- end: page -->
    </div> <!-- end Panel -->

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

