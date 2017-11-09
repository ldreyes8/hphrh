/**
* Theme: Minton Admin Template
* Author: Coderthemes
* Component: Datatable
* 
*/

var handleDataTableButtons = function() {
        "use strict";
        0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
            dom: "Bfrtip",
            buttons: [],
            "language": {
                    "decimal":        "",
                    "emptyTable":     "No se encontrarron registros",
                    "info":           "",
                    "infoEmpty":      "",
                    "infoFiltered":   "",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ registros",
                    "loadingRecords": "Loading...",
                    "processing":     "Processing...",
                    "search":         "Buscar:",
                    "total":          "total",          
                    "zeroRecords":    "No se han encontrado resultados",
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
					{ "bSortable": false }
				],
				aLengthMenu:[
                15],
            responsive: !0
        })
    },
    TableManageButtons = function() {
        "use strict";
        return {
            init: function() {
                handleDataTableButtons()
            }
        }
    }();