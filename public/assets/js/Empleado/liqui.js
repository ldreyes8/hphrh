(function( $ ) {

	'use strict';
	var resultadoglobal = "";
	var EditableTable = {

		options: {
			addButton: '#addToTable',
			table: '#tabprueba',
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
			this.$table				= $( this.options.table );
			this.$addButton			= $( this.options.addButton );

			// dialog
			this.dialog				= {};
			this.dialog.$wrapper	= $( this.options.dialog.wrapper );
			this.dialog.$cancel		= $( this.options.dialog.cancelButton );
			this.dialog.$confirm	= $( this.options.dialog.confirmButton );

			return this;
		},

		build: function() {
			this.datatable = this.$table.DataTable({
				"language": {
					"decimal":        "",
				    "emptyTable":     "No data available in table",
				    "info":           "Mostrar _START_ a _END_ de _TOTAL_ registros por pagina",
				    "infoEmpty":      "Showing 0 to 0 of 0 entries",
				    "infoFiltered":   "(filtered from _MAX_ total entries)",
				    "infoPostFix":    "",
				    "thousands":      ",",
				    "lengthMenu":     "Mostrar _MENU_ registros",
				    "loadingRecords": "Loading...",
				    "processing":     "Processing...",
				    "search":         "Buscar:",
				    "total": 		  "total",			
				    "zeroRecords":    "No matching records found",
				    "paginate": {
				        "first":      "First",
				        "last":       "Last",
				        "next":       "Siguiente",
				        "previous":   "Anterior"
				    },
                },
				columns: [
					null, //Fecha
					null, //Descripcion
					null, //#Factura
					null, //Empleado
					{ "bSortable": false },
					null, //LOB L10
					null, //Donador L8
					null, //Proyecto L9
					null, //Funcion L2
					null, //Monto
					null, //Saldo
					{ "bSortable": false }
				]//,
				//select: true
			});

			/**
			"columnDefs": [
		 *          { "orderDataType": "dom-text", "targets": [ 2, 3 ] },
		 *          { "type": "numeric", "targets": [ 3 ] },
		 *          { "orderDataType": "dom-select", "targets": [ 4 ] },
		 *          { "orderDataType": "dom-checkbox", "targets": [ 5 ] }
		 *        ]*/
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
				.on('click', 'a.cancel-row', function( e ) {
					e.preventDefault();

					_self.rowCancel( $(this).closest( 'tr' ) );
				})
				.on('click', 'a.edit-row', function( e ) {
					e.preventDefault();

					_self.rowEdit( $(this).closest( 'tr' ) );
				})
				.on( 'click', 'a.remove-row', function( e ) {
					e.preventDefault();

					var $row = $(this).closest( 'tr' );

					swal({
	                	title: "¿Estás seguro?",
	                	text: "No podrás recuperar este registro",
		                type: "warning",
		                showCancelButton: true,
		                confirmButtonColor: "#FFFF00",
		                confirmButtonText: "Si, eliminarlo",
		                cancelButtonText: "No, cancelar",
		                closeOnConfirm: false,
		                closeOnCancel: false
	            	}, function (isConfirm) {
	                	if (isConfirm) {
	                    	swal("Eliminado", "Se ha eliminado el registro", "success");
	                    	_self.rowRemove( $row);
	                	} else {
	                    	swal("Cancelado", "No se ha eliminado el registro :)", "error");
	                	}
	            	});

	
				});

			this.$addButton.on( 'click', function(e) {
				e.preventDefault();

				_self.rowAdd();
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
		rowAdd: function() {
			this.$addButton.attr({ 'disabled': 'disabled' });

			var urlraiz=$("#url_raiz_proyecto").val();
			var id = $("#idempleado").val();
			var idp = $("#idgastocabeza").val();
			var miurl = urlraiz+"/empleado/viaje/liquidar/add/"+id+"/"+idp;

			var actions,
				data,
				$row;	

			actions = [
				'<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>',
				'<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>',
				'<a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>',
				'<a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>'
			].join(' ');


			$.ajax({
				url: miurl
			}).done( function(resul) {
				$("#rowtable").html(resul);


				data = $("#tabprueba tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabprueba tbody");

				$(document).ready(function() {
                	$(".select2").select2();
                });
				
				}).fail(function() 
				{
					console.log('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
				});

				//document.getElementById("rowtable").reset();

				//$row = $(this).parents().get(0);
				//$("#tabprueba").DataTable().order([0,'asc']).draw();

				//this.rowEdit($row);		
		},

		rowCancel: function( $row ) {
			var _self = this,
				$actions,
				i,
				data;

			if ( $row.hasClass('adding') ) {
				this.rowRemove( $row );
			} else {

				data = this.datatable.row( $row.get(0) ).data();
				this.datatable.row( $row.get(0) ).data( data );

				$actions = $row.find('td.actions');
				if ( $actions.get(0) ) {
					this.rowSetActionsDefault( $row );
				}

				this.datatable.draw();
			}
		},

		rowEdit: function( $row ) {
			var _self = this,
				data;

			data = this.datatable.row( $row.get(0) ).data();

			$row.children( 'td' ).each(function( i ) {
				var $this = $( this );

				if ( $this.hasClass('actions') ) {
					_self.rowSetActionsEditing( $row );


				} else {
					$this.html( '<input type="text" class="form-control input-block" value="' + data[i] + '"/>' );
				}
			});
		},

		rowSave: function( $row ) {

			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            
            var formData = {
                idempleado: $("#idemple").val(),
                identificacion: $("#identifica").val(),
                fecha_despido: $("#fecha_inicio").val(),           
                motivo: $("#idstatus option:selected").text(),
                observaciones : $("#observaciones").val(),
                idstatus: $("#idstatus").val(),
            };

            var state=$("#btnGuardarBaja").val();

            var type;

            type="POST";
            var my_url = 'addbaja';

            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',

                success: function (data) {
                    swal({
                        title:"Envio correcto",
                        text: "Se ha despedido al empleado correctamente",
                        type: "success",
                    });

                    $("#empleado" + idEP).remove();
                    $('#formDespedir').trigger("reset");
                    $('#formModalDespedir').modal('hide');                        
                },
                error: function (data) {
                    $('#loading').modal('hide');
                    var errHTML="";
                    if((typeof data.responseJSON != 'undefined')){
                        for( var er in data.responseJSON){
                            errHTML+="<li>"+data.responseJSON[er]+"</li>";
                        }
                    }else{
                        errHTML+='<li>Error</li>';
                    }
                    $("#erroresContent").html(errHTML); 
                    $('#erroresModal').modal('show');
                }
            });

			this.$addButton.removeAttr( 'disabled' );

			var _self     = this,
				$actions,
				values    = [];

			if ( $row.hasClass( 'adding' ) ) {
				this.$addButton.removeAttr( 'disabled' );
				$row.removeClass( 'adding' );
				console.log($row);
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
				console.log(this.rowSetActionsDefault( $row ));
				this.rowSetActionsDefault( $row );
			}

			this.datatable.draw();
		},

		rowRemove: function( $row ) {
			if ( $row.hasClass('adding') ) {
				this.$addButton.removeAttr( 'disabled' );
			}

			this.datatable.row( $row.get(0) ).remove().draw();
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