<div class="card-box" id="VPJF">

    @if($liquidar == 1)

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="navbar-form navbar-left pull-left">
            <button class="btn btn-success btn-md"onclick="cargar_formularioviaje(4);"><i class="fa fa-reply-all"></i></button>
        </div>
        <h4 class="box-title" align="center">Detalle avance</h4>
        <hr style="border-color:black;" />
    </div>

    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>" />
    <div class="panel">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                    <label>{{\Carbon\Carbon::createFromFormat('Y-m-d',$proyecto->fechainicio)->format('d/m/Y')}}</label>
                </div>
                <div class="form-group col-lg-6">
                    <label>Fecha final</label>
                    <label>{{\Carbon\Carbon::createFromFormat('Y-m-d',$proyecto->fechafin)->format('d/m/Y')}}</label>
                </div>
            </div>            
        </div>

        <div class="panel-body">
            <div class="row">
            </div>

            @if(isset($vehiculo))
            @if(count($vehiculo) > 0)
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 2%">id</th>
                                <th style="width: 50%">vehiculo</th>
                                <th style="width: 24%">kilometraje inicial</th>
                                <th style="width: 24%">kilometraje final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehiculo as $veh)
                            <tr id="vehiculos{{$veh->idviajevehiculo}}">
                                <td>{{$veh->idviajevehiculo}}</td>
                                <td>{{$veh->marca.' '.$veh->color.' '.$veh->modelo}}</td>
                                <td>{{$veh->kilometrajeini}}</td>
                                <td>{{$veh->kilometrajefin}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @endif

            <div class="pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th><p style="color:green;" align="center">Fondo Efectivo</p></th><td id="montot">{{$proyecto->monto}}</td>
                        </tr>
                        <tr>
                            <th bgcolor="#BCF5A9"><p style="color:green;" align="center">Liquidación</p></th><td bgcolor="#BCF5A9" id="liquidacion"><strong>{{$liquidacion->liquidacion}}</strong></td>
                        </tr>
                        <tr>
                            <th><p style="color:green;" align="center">Disponible</p></th><td id="disponible">{{$proyecto->monto - $liquidacion->liquidacion}}</td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
           

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive" id="mainTable">
                    <table class="table table-striped table-bordered table-condensed table-hover" id="index-historialdetalle">
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 

    @else
        <br/><div class='rechazado' align="center"><label style='color:#FA206A'>...No se ha encontrado ningun detalle...</label>  </div> 
    @endif
</div>

<meta name="_token" content="{!! csrf_token() !!}" />

<script type="text/javascript">
    (function( $ ) {
    'use strict';

	    var EditableTable = {
	        options: {
	            addButton: '#addToTable',
	            table: '#index-historialdetalle',
	            dialog: {
	                wrapper: '#dialog',
	                cancelButton: '#dialogCancel',
	                confirmButton: '#dialogConfirm',
	            }
	        },
	                
	        initialize: function() {
	            this
	                .setVars()
	                .build()
	                .events();
	        },

	        setVars: function() {
	            this.$table             = $( this.options.table );
	            //this.$addButton         = $( this.options.addButton );

	            // dialog
	            this.dialog             = {};
	            //this.dialog.$wrapper    = $( this.options.dialog.wrapper );
	            //this.dialog.$cancel     = $( this.options.dialog.cancelButton );
	            //this.dialog.$confirm    = $( this.options.dialog.confirmButton );

	            return this;
	        },

	        build: function() {
	            this.datatable = this.$table.DataTable({
	                "language": {
	                "decimal":        "",
	                "emptyTable":     "No hay datos disponibles en la tabla",
	                "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros por pagina",
	                "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
	                "infoFiltered":   "(filtered from _MAX_ total entries)",
	                "infoPostFix":    "",
	                "thousands":      ",",
	                "lengthMenu":     "Mostrar _MENU_ registros",
	                "loadingRecords": "Loading...",
	                "processing":     "Processing...",
	                "search":         "Buscar:",
	                "total":          "total",          
	                "zeroRecords":    "No se encontraron registros",
	                "paginate": {
	                    "first":      "First",
	                    "last":       "Last",
	                    "next":       "Siguiente",
	                    "previous":   "Anterior"
		                },
		            },
		            
		            aoColumns: [
		                null,
		                null,
		                null,
		                null,
		                null,
		                null,
		                null,
		                null,
		                null,
		                null,
		                { "bSortable": false }
		            ],
		            aLengthMenu: [ 
		                20, 
		                25, 
		                30, 
		            ]
		        });
		        window.dt = this.datatable;
		        return this;
		    },

		    events: function() {
		        var _self = this;
		        this.$table           
		        return this;
		    },
		};
	    
	    $(function() {
	        EditableTable.initialize();
	    });
	}).apply( this, [ jQuery ]);
</script>


