<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Solicitar viaje</h4>
    <hr style="border-color:black;" />    

                    <form role="form" id="formAgregarViaje">
                        <div class="modal-header">
                            <label class="control-label">Proyecto</label>
                            <select class="form-control select2" id="idproyecto">
                                @if (isset($proyectos))
                                @foreach($proyectos as $pro)
                                <option value="{{$pro->idproyecto}}">{{$pro->proyecto}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="modal-header">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Monto solicitado</label>
                                <input id="monto" type="number" min="0" class="form-control" onkeypress="return valida(event)" value="0">
                            </div>

                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Tipo moneda</label>
                                <select class="form-control" id="moneda">
                                    <option>GTQ</option>
                                    <option>USD</option>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">                   

                                <label class="control-label">Deposito</label>
                                <div class="input-group">
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="deposito" value="cheque" name="deposito" checked>
                                        <label for="inlineRadio2">Cheque</label><!--No se tomo a su totalidad los dias solicitados-->
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="deposito" value="transferencia" name="deposito" checked>
                                        <label for="inlineRadio16">Transferencia</label> <!-- Se tomo todos los dias solicitados -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-header">
                        <br>

                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Fecha inicio</label>
                                <div class="input-group">
                                    <input type="text" id="fecha_inicio" class="form-control" name="fechainicio">
                                    <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Fecha final</label>
                                <div class="input-group">
                                    <input type="text" id="fecha_final" class="form-control" name="fechafin">
                                    <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Solicitar vehiculo</label>
                                <div class="input-group">
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="solvehiculo" value="Si" name="hvehiculo" checked onclick="mostrar()">
                                        <label for="inlineRadio2">Si</label><!--No se tomo a su totalidad los dias solicitados-->
                                    </div>
                                    <div class="radio radio-danger radio-inline">
                                        <input type="radio" id="solvehiculo" value="No" name="hvehiculo" checked onclick="mostrar()">
                                        <label for="inlineRadio1">No</label> <!-- Se tomo todos los dias solicitados -->
                                    </div>
                                </div>
                            </div>
                        </div>

               

                        <div class="modal-header" id="vehoculto">
                            <label class="control-label">Vehiculo</label>
                            <select class="form-control select2" id="idvehiculo">
                                @if (isset($vehiculos))
                                @foreach($vehiculos as $veh)
                                <option value="{{$veh->idvehiculo}}">{{$veh->marca.'-'.$veh->modelo.'-'.$veh->color}}</option>
                                @endforeach
                                @endif
                            </select>

                           
                        </div>

                        <div class="modal-header">
                            <div><p><br></p></div>
                            <div class="form-group">
                                <label>Motivo</label>
                                <textarea class="form-control" placeholder=".........." id="motivo" rows="3" maxlength="150"></textarea>
                            </div>
                        </div>  
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary btn-addviaje" id="btnGuardarViaje">Guardar</button>
                        <input type="hidden" name="idE" id="idE" value="0"/>
                    </div>
              
</div>
                      <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>

    <script type="text/javascript">
        $("#vehoculto").hide();
    </script>