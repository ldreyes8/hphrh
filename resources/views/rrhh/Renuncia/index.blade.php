<div class="col-lg-12" id="renuncia">
    <div class="modal fade" id="formModalRenuncia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <input type="hidden" name="idemple" id="idemple">
                <input type="hidden" name="identifica" id="identifica">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="inputTitleDespedir"></h4>
                </div>

                <form role="form" id="formRenuncia">
                    <div class="modal-header">
                        <br>                           
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Nombre</label>
                            <input id="nombreC" type="text" class="form-control" name="dias" aria-describedby="basic-addon1">   
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Fecha Renuncia</label>
                            <input type="text" id="fecha_inicio" class="form-control" name="fechainicio">
                        </div>
                        
                        <label>Tipo de baja</label>
                        <select name="idstatus" id="idstatus" class="form-control selectpicker" data-live-search="true">
                        @if (isset($status))
                            @foreach($status as $sta)
                            <option value="{{$sta->idstatus}}">{{$sta->statusemp}}</option>
                            @endforeach
                        @endif
                        </select>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Motivo</label>
                            <textarea class="form-control" placeholder=".........." id="observaciones" rows="3" maxlength="300"></textarea>
                        </div>
                    </div> 
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-adddespedir" id="btnGuardarRenuncia">Guardar</button>
                    <input type="hidden" name="idE" id="idE" value="0"/>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="erroresModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Errores</h4>
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