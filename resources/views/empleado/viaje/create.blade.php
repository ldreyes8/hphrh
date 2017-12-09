<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Solicitar viaje</h4>
    <hr style="border-color:black;" />    
    <input type="hidden" name="" id="idafiliado" value="">

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
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
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
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label">Deposito</label>
                    <div class="form-group">
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
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
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
            <div id="vehoculto" class="col-lg-1 col-md-12 col-sm-12 col-xs-12">
                <br>
                <a href="javascript:void(0);" onclick="cargarbusqueda(1);">                
                    <button type="button" class="btn btn-success btn-buscarveh" title="Buscar Vehiculo" ><i class="fa fa-search"></i></button>
                </a>
            </div>

            <div id="taboculto" class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div><br></div>
                    <table id="table-veh" class="table table-striped table-bordered table-hover">
                        <thead style="background-color:#A9D0F5">
                            <tr>
                                <th>Opciones</th>
                                <th>Vehiculo</th>
                                <th>Kilometraje</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
            </div>
        </div>
        <div class="modal-header">
            <div class="form-group">
                <label>Motivo</label>
                <textarea class="form-control" placeholder=".........." id="motivo" rows="3" maxlength="150"></textarea>
            </div>
        </div>  
    </form>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-cancelviaje" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-addviaje" id="btnGuardarAvance" value="movi">Guardar</button>
        <input type="hidden" name="idE" id="idE" value="0"/>
    </div>
</div>

<div class="modal fade" id="erroresModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="inputError"></h4>
            </div>

            <div class="modal-body">
                <ul style="list-style-type:circle" id="erroresContent"></ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
<script src="{{asset('assets/js/Empleado/viaje.js')}}"></script>
<script src="{{asset('assets/js/modal.js')}}"></script>
<script type="text/javascript">
    $("#vehoculto").hide();
    $("#taboculto").hide();
    $(".select2").select2();
    function eliminar(index){
        console.log(index);
        $("#veh" + index).remove();
        //evaluar();
    }

    $(document).ready(function() {
        var montoini = $("#MSinicial").val();
        $("#monto").val(montoini);
        document.getElementById("fecha_inicio").focus();
    });

        $("#vehoculto").hide();

        function mostrar() {
            if($("#solvehiculo:checked").val()=="Si") {
                $("#vehoculto").show();
                $("#taboculto").show();
            }
            if($("#solvehiculo:checked").val()=="No") {
                $("#vehoculto").hide();
                $("#taboculto").hide();
            }
        }
            function valida(e){
                tecla = e.keyCode || e.which;
                tecla_final = String.fromCharCode(tecla);
                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8 || tecla==37 || tecla==39 ||tecla==46 ||tecla==9)
                    {
                        return true;
                    } 
                // Patron de entrada, en este caso solo acepta numeros
                patron =/[0-9]/;
                //patron =/^\d{9}$/;
                return patron.test(tecla_final);

            }
            //Se utiliza para que el campo de texto solo acepte letras
            function validaL(e) {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toString();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ63";//Se define todo el abecedario que se quiere que se muestre.
                especiales = [8, 37, 39, 46, 9]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.
                tecla_especial = false
                for(var i in especiales) {
                    if(key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }
                if(letras.indexOf(tecla) == -1 && !tecla_especial){
                    //alert('Tecla no aceptada');
                    return false;
                  }
            }
</script>

