<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Liquidaci&oacute;n viaje</h4>
    <hr style="border-color:black;" />

    <div><p><br></p></div>
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

    <!--  searchempleado-->

    <div class="panel-heading">
        <button class="btn btn-success btn-openviaje" title="Detalles"><i class="fa fa-plus-square"></i></button>
    </div>

    <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Solicitud</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Monto solicitado</th>
                    <th>Tipo proyecto</th>
                    <th>Autorizaci&oacute;n</th>                                
                    <th>Opciones</th>
                </thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="#"><button class="btn btn-primary">Ver</button></a></td>
                </tr>    
            </table>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="inputTitleViaje"></h4>
                    </div>

                    <form role="form" id="formAgregarViaje">
                        <div class="modal-header">
                            <label class="control-label">Proyecto</label>
                            <select class="form-control select2">
                                <option>Proyecto1</option>
                                <option>Proyecto2</option>
                                <option>Proyecto3</option>
                            </select>
                        </div>

                        <div class="modal-header">
                            <label class="control-label">Vehiculo</label>
                            <select class="form-control select2">
                                <option>Vehiculo 1</option>
                                <option>Vehiculo 2</option>
                                <option>Vehiculo 3</option>
                            </select>
                        </div>

                        <div class="modal-header">
                            <label class="control-label">Monto solicitado</label>
                            <select class="form-control select2">
                                <option>0</option>
                                <option>1000</option>
                                <option>2000</option>
                                <option>3000</option>
                            </select>
                        </div>

                        <div class="modal-header">
                            <div><p><br></p></div>

                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Fecha inicio</label>
                                <div class="input-group">
                                    <input type="text" id="fecha_inicio" class="form-control" name="fechainicio">
                                    <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Fecha final</label>
                                <div class="input-group">
                                    <input type="text" id="fecha_final" class="form-control" name="fechafin">
                                    <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary btn-addviaje" id="btnGuardarViaje">Guardar</button>
                        <input type="hidden" name="idE" id="idE" value="0"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/permiso.js')}}"></script>
<script type="text/javascript">


</script>


