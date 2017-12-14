@extends ('layouts.index')

@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/plugins/magnific-popup/dist/magnific-popup.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatables-editable/datatables.css')}}" />
    @endsection

@section ('contenido')

<div class="tab-pan active" id="contentsecundario">
    @if(isset($proyectos))
    @if(count($proyectos) > 0)
    <div class="box-header with-border my-box-header">
        <h4 class="box-title" align="center"><strong>Listado proyectos</strong></h4>
    </div>

    <hr style="border-color:black;" />
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div><br></div>
            <div class="margin" id="botones_control">
            @role('informatica')
                <button class="btn btn-success waves-effect waves-light" id="btn-nproyecto" title="nuevo proyecto">Nuevo <i class="fa fa-plus"></i></button>
            @endrole
            </div>
            <div><br></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="tproyecto"> 
                    <thead>
                        <th style= "width: 5%">Id</th>
                        <th style= "width: 15%">Proyecto</th>
                        <th style= "width: 6%">Monto</th>
                        <th >Descripción </th>
                        <th style= "width: 5%">Status</th>
                        <th style= "width: 5%">Saldo</th>
                        <th style= "width: 4%">Default</th>
                    </thead>

                    @foreach ($proyectos as $pro)
                    <tr>
                        <td>{{$pro->idproyecto}}</td>
                        <td>{{$pro->proyecto}}</td>
                        <td>{{$pro->monto}}</td>
                        <td>{{$pro->descripcion}}</td>
                        <td>{{$pro->status}}</td>
                        <td>{{$pro->saldo}}</td>
                        @if($pro->indice == 1)
                        <td><input id="checkbox1" class="checkbox1" type="checkbox" checked="true" value="{{$pro->idproyecto}}"></td>
                        @else
                        <td><input id="checkbox1" class="checkbox1" type="checkbox" value="{{$pro->idproyecto}}"></td>
                        @endif   
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>           
    </div>
    @else
        <br/><div class='rechazado'><label style='color:#FA206A'>...No se ha encontrado ningun proyecto...</label>  </div> 
    @endif
    @endif
</div>

<div class="col-lg-12">
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="inputTitle"></h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="formAgregar">
                        <div class="form-group">
                            <label>Nombre del proyecto</label>
                            <input class="form-control" id="proyecto" required="true" maxlength="45" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label>Monto</label>
                            <input class="form-control" id="monto" required="true"  maxlength="10" onkeypress="return validadecimal(event,this)"/>
                        </div>

                        <div class="form-group col-md-6">
                            <label>codigo conta</label>
                            <input class="form-control" id="codigoconta" type="text" name="" maxlength="10">
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Fecha inicio</label>
                            <div class="input-group">
                                <input type="text" id="fecha_inicio" class="form-control">
                                <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Fecha final</label>
                            <div class="input-group">
                                <input type="text" id="fecha_final" class="form-control">
                                <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <br>
                            <input class="cas" type="checkbox" id="casilla" value="1"/> Dejar como predeterminado este proyecto.
                        </div>

                        <div class="form-group">
                            <label>Descripci&oacute;n</label>
                            <textarea class="form-control " id="descripcion" rows="3" style="width: 100%"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">      Guardar</button>
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

<input type="hidden" id="url_raiz_proyecto" value="{{ url("/") }}" />
<div id="capa_modal" class="div_modal" style="display: none;"></div>
<div id="capa_formularios" class="div_contenido" style="display: none;"></div>

@endsection

@section('fin')
    @parent

    <script type="text/javascript">

    (function( $ ) {

        'use strict';
        var resultadoglobal = "";
        var indice = "";
        var EditableTable = {

            options: {
                addButton: '#btnGuardar',
                table: '#tproyecto',
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
                        "info":           "Mostrar _START_ a _END_ de _TOTAL_ registros por pagina",
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
                        null, //id { "bVisible": false }
                        null, //proyecto
                        null, //monto
                        null, //descripcion
                        null, //status
                        null, //saldo,
                        { "bSortable": false } // Default
                    ]
                });
                window.dt = this.datatable;
                return this;
            },
            
            events: function() {
                var _self = this;

                this.$table
                    .on('click', 'a.save-row', function( e ) {
                        e.preventDefault();
                        _self.rowSave( $(this).closest( 'tr' ) );

                    })
                    .on('click', 'a.edit-row', function( e ) {
                        e.preventDefault();

                        _self.rowEdit( $(this).closest( 'tr' ) );
                        indice = $(this).closest( 'tr' );
                    })
                    
                this.$addButton.on( 'click', function(e) {
                    e.preventDefault();
 
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });

                    var urlraiz=$("#url_raiz_proyecto").val();
                    var miurl;
                    var type;
                    var state=$("#btnGuardar").val();

                    var checked;

                     if (state == "update"){
                        type="PUT";
                        miurl = urlraiz+"/empleado/viaje/liquidar/update/"+idliq;
                    }
                    if (state == "add"){
                        type="POST";
                        miurl = urlraiz+"/seguridad/proyecto/store";

                        if($('#casilla').prop('checked')){
                            checked = 1;
                        }

                        else{
                            checked = 0;
                        }
                    } 

                    var formData = {
                        proyecto: $("#proyecto").val(),
                        monto: $("#monto").val(),
                        codigo_conta: $("#codigoconta").val(),           
                        fecha_inicio: $("#fecha_inicio").val(),
                        fecha_final : $("#fecha_final").val(),
                        default: checked,
                        descripcion: $("#descripcion").val(),
                    };


                    $.ajax({
                        type: type,
                        url: miurl,
                        data: formData,
                        dataType: 'json',
                 
                        success: function (data) {
                            if(state == "add"){ 
                                _self.rowAdd(data);
                            }
                            if(state == "update"){
                                _self.rowUpdate(data);
                            }

                            $('#formAgregar').trigger("reset");
                            $('#formModal').modal('hide');                            
                        },
                        
                        error: function (data) {                            
                            var errHTML="";
                            if((typeof data.responseJSON != 'undefined')){
                                for( var er in data.responseJSON){
                                    errHTML+="<li>"+data.responseJSON[er]+"</li>";
                                }
                            }else{
                                errHTML+='<li>Error</li>';
                            }
                            $("#inputError").html("Error");
                            $("#erroresContent").html(errHTML); 
                            $('#erroresModal').modal('show');
                        }
                    });
                });

                this.dialog.$cancel.on( 'click', function( e ) {
                    e.preventDefault();
                    $.magnificPopup.close();
                });

                return this;
            },

            // ==========================================================================================
            // ROW FUNCTIONS
            // ==========================================================================================
            rowAdd: function($data) {
                var _self     = this;
                this.$addButton.attr({ 'disabled': 'disabled' });
                var actions,
                    data,
                    $row;

                if($data.indice == 0){
                    actions = [
                        '<input class="checkbox1 checkbox-primary" id="checkbox1" type="checkbox"></input>'
                    ].join(' ');
                }
                if($data.indice == 1)
                {   
                    // todos los checbox se dejan desactivados.
                    $(".checkbox1").each(function(){
                        $(this).prop('checked',false);
                    });

                    // se crea un nuevo checkbox con la propiedad check para que este sea seleccionado.
                    actions = [
                        '<input class="checkbox1 checkbox-primary" id="checkbox1'+$data.idproyecto+'" type="checkbox" checked="true" ></input>'
                    ].join(' ');
                }

                data = this.datatable.row.add([ $data.idproyecto,
                                                $data.nombreproyecto,
                                                $data.montoproyecto,
                                                $data.descripcion,
                                                $data.status,
                                                $data.saldoproyecto,
                                                actions
                                            ]);

                $row = this.datatable.row( data[0] ).nodes().to$();
                $row
                    .addClass( 'adding' )
                    .find('td')
                    .addClass('actions');
                this.datatable.order([0,'asc']).draw(); 
                _self.rowSave($row);
            },

            rowUpdate: function($data){
            },

            rowSave: function( $row ) {
                var _self     = this,
                    $actions,
                    values    = [];

                if ( $row.hasClass( 'adding' ) ) {
                    this.$addButton.removeAttr( 'disabled' );
                    $row.removeClass( 'adding' );
                }

                values = $row.find('td').map(function() {
                    var $this = $(this);

                    if ( $this.hasClass('actions') ) {
                        _self.rowSetActionsDefault( $row );
                        return _self.datatable.cell( this ).data();
                    } else {
                        return $.trim( $this.find('input').val() );
                    }
                });

                this.datatable.row( $row.get(0) ).data( values );

                $actions = $row.find('td.actions');
                if ( $actions.get(0) ) {
                    this.rowSetActionsDefault( $row );
                }

                this.datatable.draw();
            },

            rowSetActionsEditing: function( $row ) {
                $row.find( '.on-editing' ).removeClass( 'hidden' );
                $row.find( '.on-default' ).addClass( 'hidden' );
            },

            rowSetActionsDefault: function( $row ) {
                $row.find( '.on-editing' ).addClass( 'hidden' );
                $row.find( '.on-default' ).removeClass( 'hidden' );
            }
        };
     
        $(function() {
            EditableTable.initialize();
        });

    }).apply( this, [ jQuery ]);



    $('#btn-nproyecto').click(function(){
            $('#inputTitle').html("Agregar proyecto");
            $('#formAgregar').trigger("reset");
            $('#btnGuardar').val('add');
            $('#formModal').modal('show');
    });

    
    $(document).on('change','.checkbox1',function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl = urlraiz+"/seguridad/proyecto/determinado";

        $(".checkbox1").each(function(){
            $(this).prop('checked',false);
        });

        $(this).prop('checked',true);

        var formData = {
            //valores:valor,
            proyecto:$(this).val(),
        };
        $.ajax({
            type: "PUT",
            url: miurl,
            data: formData,
            dataType: 'json',

            success: function (data) {          
            },
            error: function (data) {
                $('#loading').modal('hide');
                var errHTML="";
                if((typeof data.responseJSON != 'undefined')){
                    for( var er in data.responseJSON){
                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                    }
                }else{
                    errHTML+='<li>Error al enviar los datos, por favor intente mas tarde.</li>';
                }
                $("#erroresContent").html(errHTML); 
                $('#erroresModal').modal('show');
            }
        });
    });
    </script>

    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>    
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
    <script src="{{asset('assets/js/valida.js')}}"></script>

    <script src="{{asset('assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-datatables-editable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/plugins/tiny-editable/mindmup-editabletable.js')}}"></script>

@endsection