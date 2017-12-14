<div class="card-box" id="SviajeE">
    <h4 class="box-title" align="center">Liquidaciones en proceso</h4>
    <hr style="border-color:black;" />

    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

    <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" id="index-viaje"> 
                <thead>
                    <th>Solicitud</th>
                    <th>Monto solicitado</th>
                    <th>Autorizaci&oacute;n</th>
                    <th>Opciones</th>
                </thead>
                @foreach ($viaje as $via)
                <tr>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$via->fechainicio)->format('d/m/Y')}}</td>
                    <td>{{$via->monto}}</td>
                    <td>{{$via->status}}</td>
                    @if($via->status == 'habilitada')
                    <td>
                        <a onclick="detalleavance(5,{{$via->idcajachica}});"><button class="btn btn-primary" title="Agregar factura"><i class="glyphicon glyphicon-edit"></i></button></a>
                    </td>
                    @elseif($via->status == 'solicitado')
                    <td><a href="javascript:void(0);" onclick="detalleavance(2,{{$via->idgastocabeza}});"><button class="btn btn-primary">Detalles</button></a>
                        <a href="#"><button class="btn btn-danger" id="cancelarmov" value="{{$via->idgastocabeza}}">Cancelar</button></a></td>
                    @elseif($via->status == 'Finalizado')
                    <td><a href="javascript:void(0);" onclick="detalleavance(2,{{$via->idgastocabeza}});"><button class="btn btn-primary">Detalles</button></a>
                         <a href="{{URL::action('EViajeController@descargardetalle',$via->idgastocabeza)}}"><button class="btn btn-success">Descargar</button></a></td>
                    @else
                        <td><a href="#"><button class="btn btn-primary">Detalles</button></a>
                    @endif
                </tr> 
                @endforeach
            </table>
        </div>
    </div>
</div>

<!-- l10  = 1000 -->
<!-- l5 descartado -->
<!-- FONDOS LOCALES-PAGO CASAS default L8  titulo Linea de presupuesto-->
<!-- A ON -->           <!-- l2 !-->
<!-- P Afilidaso -->
<!-- f steve -->
<!-- L5 DEFAULT GENERIC Y OCULTO -->
<!-- L9 SIRVIENDO FAMILIAS GUATEMALTEC default -->
<!-- FACTURAS ESPECIALES NEGATIVOS -->

    <!-- Examples -->
        <script src="{{asset('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('assets/plugins/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
        <script src="{{asset('assets/plugins/tiny-editable/mindmup-editabletable.js')}}"></script>

        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>

        <script src="{{asset('assets/js/Empleado/cargardetalle.js')}}"></script>

    <script type="text/javascript">
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


    <script type="text/javascript">
        (function( $ ) {

            'use strict';

            var EditableTable = {

                options: {
                    addButton: '#addToTable',
                    table: '#index-viaje',
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
                    this.dialog             = {};
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

                            { "bSortable": false }
                        ],
                        aLengthMenu: [ 
                            10, 
                            15, 
                            25, 
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