<link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
<div class="card-box" id="VPJF">
    @if($liquidar == 1)
    <h4 class="box-title" align="center">Liquidaci&oacute;n caja chica</h4>
    <hr style="border-color:black;" />
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>" />
    <input type="hidden" id="idempleado" value="{{$proyecto->idempleado}}">
    <input type="hidden" id="idgastocabeza" value="{{$proyecto->idgastocabeza}}">
    <input type="hidden" id="idgastoviaje" value="{{$proyecto->idgastoviaje}}">
    <div class="panel">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="navbar-form navbar-left pull-left">
                <div class="row">
                    <div class="col-sm-3">
                        <button class="btn btn-success waves-effect waves-light btn-EnviarL" id="btnEnviarL">Enviar Reporte liquidacion</button>
                    </div>
                </div>
            </div>
            <div class="navbar-form navbar-left pull-right">
                <div class="form-group col-lg-6">
                    <label>Monto solicitado</label>
                    <label>{{$proyecto->monto}}</label>            
                </div>
                <div class="form-group col-lg-6">
                    <label>Tipo Proyecto</label>
                    <label>{{$proyecto->nombreproyecto}}</label>            
                </div>
                <div class="form-group col-lg-6">
                    <label>Fecha inicio</label>
                    <label>{{$proyecto->fechainicio}}</label>
                </div>
                <div class="form-group col-lg-6">
                    <label>Fecha final</label>
                    <label>{{$proyecto->fechafin}}</label>
                </div>
            </div>
        </div>

        <div class="pull-right">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover" id="detallefondo">
                        <tr>
                            <th><p style="color:green;" align="center">Fondo Efectivo</p></th>
                            <td id="montot">{{$proyecto->monto}}</td>
                        </tr>
                        <tr>
                            <th bgcolor="#BCF5A9"><p style="color:green;" align="center">Liquidación</p></th><td bgcolor="#BCF5A9" id="liquidacion"><strong>{{$liquidacion->liquidacion}}</strong></td>
                        </tr>
                        <tr>
                            <th><p style="color:green;" align="center">Disponible</p></th>
                            <td id="disponible">{{$proyecto->monto - $liquidacion->liquidacion}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="tabprueba">
                        <thead>
                            <tr>
                                <th style="width: 2%">Id</th>
                                <th style="width: 4%">Fecha</th>
                                <th style="width: 14%">Descripci&oacute;n</th>
                                <th style="width: 10%"># Factura</th>
                                <th style="width: 12%">Empleado</th>
                                <th style="width: 12%">Cuenta</th>
                                <th>Eventos</th>
                                <th style="width: 8%">Línea de presupuesto</th>
                                <th style="width: 10%">Proyecto L9</th>
                                <th style="width: 8%">Funci&oacute;n L2</th>
                                <th style="width: 6%">Monto</th>
                                <th style="width: 4%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gastoviajeemp as $gvi)
                            <tr>
                                <td>{{$gvi->idgastoempleado}}</td>
                                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$gvi->fecha)->format('d/m/Y')}}</td>
                                <td>{{$gvi->descripcion}}</td>
                                <td>{{$gvi->factura}}</td>
                                <td>{{$gvi->nombre1.' '.$gvi->nombre2.' '.$gvi->nombre3.' '.$gvi->apellido1.' '.$gvi->apellido2.' '.$gvi->apellido3}}</td>
                                <td>{{$gvi->cuenta}}</td>
                                <td>Even</td>
                                <td>ff</td>
                                <td>{{$gvi->proyecto}}</td>
                                <td>10</td>
                                <td>{{$gvi->monto}}</td>
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
            </div>
        </div>
    </div>
    @else
        <br/><div class='rechazado' align="center"><label style='color:#FA206A'>...No se ha encontrado ninguna liquidacion...</label></div> 
    @endif
</div>

<div class="col-lg-12 col-md-12" id="modales">
    <div class="modal fade" id="formModalLiquidar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" align="center" id="inputTitleLiquidar"></h4>
                </div>
                <div id="modaliq"></div>
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div><br></div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="Glempleado" class="btn btn-primary waves-effect waves-light">Guardar</button>
                        <input type="hidden" id="idgastoemp" value="0"/>
                    </div>
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

<meta name="_token" content="{!! csrf_token() !!}" />
<script src="{{asset('assets/js/valida.js')}}"></script>
<script src="{{asset('assets/js/Asistente/liquidar.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        /*$('#tabprueba tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        });*/

        var table = $('#tabprueba').DataTable();

        $('#tabprueba tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
               table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
    });

    $(document).on('click','.btn-NuevoLC',function(e){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl = urlraiz+"/empleado/viaje/liquidar/add";
        $.get(miurl,function(data){
            $("#modaliq").html(data);
            $('#inputTitleLiquidar').html("Agregar registro liquidación");
            $('#formAgregarLiquidar').trigger("reset");
            $('#formModalLiquidar').modal('show');
            $('#Glempleado').val('add');
        });
    });
</script>