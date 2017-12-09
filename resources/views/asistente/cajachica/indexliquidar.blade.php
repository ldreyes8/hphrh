<!--
<style type="text/css">
 
#tabla{ border: solid 1px #333; width: 300px; }
#tabla tbody tr{ background: #999; }
.fila-base{ display: none; } /* fila base oculta */
.eliminar{ cursor: pointer; color: #000; }
input[type="text"]{ width: 40px; } /* ancho a los elementos input="text" */
 
</style>
-->
<link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />

<div class="card-box" id="VPJF">

    @if($liquidar == 1)

    <h4 class="box-title" align="center">Liquidaci&oacute;n viaje</h4>
    <hr style="border-color:black;" />

    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>" />
    <input type="hidden" id="idempleado" value="{{$proyecto->idempleado}}">
    <input type="hidden" id="idgastocabeza" value="{{$proyecto->idgastocabeza}}">
    <input type="hidden" id="idgastoviaje" value="{{$proyecto->idgastoviaje}}">
    <div class="panel">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="navbar-form navbar-left pull-left">
                <div class="row">
                    <div class="col-sm-5">
                        <button class="btn btn-info waves-effect waves-light btn-NuevoL">Agregar <i class="fa fa-plus"></i></button>
                    </div>
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

        <div class="panel-body">
            <div class="row">
            </div>

            @if(isset($vehiculo))
            @if(count($vehiculo) > 0)
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="table-responsive" id="vehiculos">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 2%">id</th>
                                <th style="width: 50%">vehiculo</th>
                                <th style="width: 24%">kilometraje inicial</th>
                                <th style="width: 24%">kilometraje final</th>
                                <th style="width: 5%">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehiculo as $veh)
                            <tr>
                                <td>{{$veh->idviajevehiculo}}</td>
                                <td>{{$veh->marca.' '.$veh->color.' '.$veh->modelo}}</td>
                                <td>{{$veh->kilometrajeini}}</td>
                                <td>{{$veh->kilometrajefin}}</td>
                                <td><a href="#"><i class="fa fa-pencil"></i></a></td>                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @endif

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="tabprueba">
                        <thead>
                            <tr>
                                <th style="width: 2%">id</th>
                                <th style="width: 4%">Fecha</th>
                                <th style="width: 14%">Descripci&oacute;n</th>
                                <th style="width: 10%"># Factura</th>
                                <th style="width: 12%">Empleado</th>
                                <th style="width: 12%">Cuenta</th>
                                <th style="width: 6%">LOB L10</th>
                                <th style="width: 8%">Donador L8</th>
                                <th style="width: 10%">Proyecto L9</th>
                                <th style="width: 8%">Funci&oacute;n L2</th>
                                <th style="width: 6%">Monto</th>
                                <th style="width: 6%">Saldo</th>
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
                                <td>{{$gvi->nombre1.' '.$gvi->nombre2}}</td>
                                <td>{{$gvi->cuenta}}</td>
                                <td>ff</td>
                                <td>10</td>
                                <td>{{$gvi->proyecto}}</td>
                                <td>10</td>
                                <td>{{$gvi->monto}}</td>
                                <td>10</td>
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
        </div><!-- end: page -->
    </div> 

    @else
        <br/><div class='rechazado' align="center"><label style='color:#FA206A'>...No se ha encontrado ninguna liquidacion...</label>  </div> 
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
                         <button id="Glempleado" class="btn btn-primary waves-effect waves-light">Guardar</i></button>
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
<script src="{{asset('assets/js/Empleado/liquidar.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}"></script>

<script type="text/javascript">

    

    $(document).on('click','.btn-NuevoL',function(e){
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

