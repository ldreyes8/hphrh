@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />

                <link rel="stylesheet" href="{{asset('assets/plugins/magnific-popup/dist/magnific-popup.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatables-editable/datatables.css')}}" />

@endsection
@section ('contenido')

@if (isset($empleado))
<div id="capa_formularios">
    <div class="card-box" id="lisadoEmp">
        <h4 class="box-title" align="center">Reporte vacaciones y permisos</h4>
        <hr style="border-color:black;" />
        <div class="row">

           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="table-responsive">
                     <table class="table table-striped table-bordered table-condensed table-hover" id= "index-reportevpempleado">
                        <thead>
                             <th>Id</th>
                             <th>Identificación</th>
                             <th>Nit</th>
                             <th>Nombre</th>
                             <th>Afiliado</th>
                             <th>Puesto</th>
                             <th>Status</th>
                             <th style="width: 10%">Opciones</th>
                        </thead>
                         @foreach ($empleado as $em)
                        <tr>
                            <td>{{$em->idempleado}}</td>
                            <td>{{$em->identificacion}}</td>
                            <td>{{$em->nit}}</td>
                            <td>{{$em->persona->nombre1.' '.$em->persona->nombre2.' '.$em->persona->apellido1.' '.$em->persona->apellido2}}</td>
                            <td>{{$em->afiliado}}</td>
                            <td>{{$em->puesto}}</td>
                            <td>{{$em->statusn}}</td>
                            <td>
                                <button class="btn btn-primary btn-vacaciones" onclick="ji_reporte(1,{{$em->idempleado }})" title="Vacaciones"><i class="fa fa-camera-retro fa-xs"></i></button>
                                <button class="btn btn-primary btn-permisos" onclick="ji_reporte(2,{{$em->idempleado }})" title="Permisos"><i class="fa fa-leanpub"></i></button>
                            </td>
                        </tr>

                         @endforeach
                     </table>
                 </div>
           </div>
        </div>
    </div>
</div>

@endif
@endsection
@section('fin')
    @parent
        <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="{{asset('assets/js/RHjs/listados.js')}}"></script>
        <!--
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
        -->

        <script src="{{asset('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('assets/plugins/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
        <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
        <script src="{{asset('assets/plugins/tiny-editable/mindmup-editabletable.js')}}"></script>
        <script src="{{asset('assets/js/JefeInmediato/reporte.js')}}"></script>


        <script type="text/javascript">
        (function( $ ) {

            'use strict';

            var EditableTable = {

                options: {
                    table: '#index-reportevpempleado',
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