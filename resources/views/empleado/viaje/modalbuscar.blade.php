<link rel="stylesheet" href="{{asset('assets/plugins/magnific-popup/dist/magnific-popup.css')}}" />
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatables-editable/datatables.css')}}" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="col-lg-12" id="modales">
    <div class="modal fade" id="formModalBuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" align="center" id="inputTitleBuscar"></h4>
                </div>

                <form role="form" id="formAgregarBuscar">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="">
                                <table class="table table-striped" id="buscarveh">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">Id</th>
                                            <th style="width: 15%">placa</th>
                                            <th style="width: 15%">color</th>
                                            <th style="width: 15%">marca</th>
                                            <th style="width: 15%">modelo</th>
                                            <th style="width: 15%">kilometraje</th>
                                            <th style="width: 15%">Estado</th>
    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($vehiculos as $veh)
                                    <tr>
                                        <td>{{$veh->idvehiculo}}</td>
                                        <td>{{$veh->placa}}</td>
                                        <td>{{$veh->color}}</td>
                                        <td>{{$veh->marca}}</td>
                                        <td>{{$veh->modelo}}</td>
                                        <td>{{$veh->kilacumulado}}</td>
                                        <td>{{$veh->status}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div><br></div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-succes" data-dismiss="modal" id="button">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="erroresModalBuscar" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="inputErrorBuscar"></h4>
            </div>
            <div class="modal-body">
                <ul style="list-style-type:circle" id="erroresContentBuscar"></ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/plugins/tiny-editable/mindmup-editabletable.js')}}"></script>


<script type="text/javascript">
$(document).ready(function() {
    $('#buscarveh tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    });

    $('#button').click( function () {
        $('#buscarveh').DataTable().$('tr.selected').each(function(i){
            var idveh   = $(this).find("td:eq(0)").text();
            var placa   = $(this).find("td:eq(1)").text();
            var color   = $(this).find("td:eq(2)").text();
            var marca   = $(this).find("td:eq(3)").text();
            var modelo   = $(this).find("td:eq(4)").text();
            var kilome  = $(this).find("td:eq(5)").text();
            var estado  = $(this).find("td:eq(6)").text();

            var item  = '<tr class="even gradeA" id="veh'+$(this).find("td:eq(0)").text()+'">';
            item +='<td><button type="button" class="btn btn-warning" onclick="eliminar('+idveh+');">X</button></td>';
            item += '<td><input type="hidden" id="idvehiculo" value="'+idveh+'">'+marca+' '+color + ' '+ modelo +'</td>';
            item += '<td>'+kilome+'</td>';
            item += '<td>'+estado+'</td><tr>';

            $('#table-veh').append(item);
        });
        $('#formModalBuscar').modal('hide');
        //console.log($('#table-veh')); 
    });
});
</script>

<script type="text/javascript">

(function( $ ) {

    'use strict';

    var EditableTable = {

        options: {
            addButton: '#addToTable',
            table: '#buscarveh',
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
                    "zeroRecords":    "No matching records found",
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
                    { "bSortable": false }
                ],
                aLengthMenu: [ 
                    5, 
                    10, 
                    15, 
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