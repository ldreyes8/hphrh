@extends ('layouts.index')
@section('estilos')
    @parent
 
        <link rel="stylesheet" href="{{asset('assets/plugins/magnific-popup/dist/magnific-popup.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatables-editable/datatables.css')}}" />
   
@endsection
@section ('contenido')


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="{{URL::action('Reporte@Empleadoexcel')}}"><button class="btn btn-primary">Descargar</button></a>
        <p><h2 ALIGN=center>Informe Empleado General</h2></p>
    </div>
</div>


<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover" id="index-reportefinaciero">
            <thead style="background-color:#A9D0F5">
                <th>Afiliado</th>
                <th>Puesto</th>
                <th>Nombre del empleado</th>
                <th>Identificaci&oacute;n</th>
                <th>Salario</th>
                <th>Fecha ingreso</th>
                <th>Correo institucional</th>
                <!--<th>Correo personal</th>-->
                <th>Estado</th>
            </thead>
            <tbody>
            @foreach($nomytras as $ntr)
                <tr>
                    <td>{{$ntr->afiliado}}</td>
                    <td>{{$ntr->puesto}}</td>
                    <td>{{$ntr->nombre1.' '.$ntr->nombre2.' '.$ntr->nombre3.' '.$ntr->apellido1.' '.$ntr->apellido2}}</td>
                    <td>{{$ntr->identificacion}}</td>
                    <td>{{$ntr->salario}}</td>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $ntr->fecha)->format('d-m-Y')}}</td>
                    <td>{{$ntr->email}}</td>
                    <!--<td>{{$ntr->correo}}</td>-->
                    <td>{{$ntr->caso}}</td>
                </tr>               
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('fin')
    @parent
    <script src="{{asset('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/plugins/tiny-editable/mindmup-editabletable.js')}}"></script>
    <script type="text/javascript">
        (function( $ ) {
            'use strict';
            var EditableTable = {
                options: {
                    table: '#index-reportefinaciero',
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
                    this.$addButton         = $( this.options.addButton );

                    // dialog
                    this.dialog             = {};
                    this.dialog.$wrapper    = $( this.options.dialog.wrapper );
                    this.dialog.$cancel     = $( this.options.dialog.cancelButton );
                    this.dialog.$confirm    = $( this.options.dialog.confirmButton );

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
                        columns: [
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
@endsection
