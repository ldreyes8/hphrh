<link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Solicitud de avance autorizados</h4>
    <hr style="border-color:black;" />
    <div><p><br></p></div>
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Solicitante</th>
                        <th>Caso</th> 
                        <th>Monto solicitado</th>
                        <th>Proyecto</th>
                        <th>Pago</th>
                        <th>Fecha</th>                               
                        <th>Opciones</th>
                    </thead>
                    @foreach($asistente as $v)
                    <tr>
                        <td>{{$v->nombre}}</td>
                        <td>{{$v->tipogasto}}</td>
                        <td>{{$v->montosolicitado}}</td>
                        <td>{{$v->nombreproyecto}}</td>
                        <td>{{$v->chequetransfe}}</td>
                        <td>{{$v->fechafin.' '.$v->fechainicio}}</td>
                        <td>
                            <button class="btn btn-success btn-md btnconfirma" value="{{$v->idgastocabeza}}" title="Aceptar"><i class="ion-checkmark-circled"></i></button>
                        </td>
                    </tr>
                    @endforeach     
                </table>
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
                <h4 class="modal-title" id="inputError">Errores</h4>
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
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
<script src="{{asset('assets/js/JefeInmediato/rutas.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('assets/js/JefeInmediato/datatablesJF.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable( { keys: true } );
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({ ajax: "../plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true });
            var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    } );
    TableManageButtons.init();
    $(document).on('click','.btnconfirma',function(e){
    	$.ajaxSetup({
			headers: {
			    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
    	var urlraiz=$("#url_raiz_proyecto").val();
		var miurl = urlraiz+"/asistete/viaje/tramite/";
		var formData = {idgasto:$(this).val(),};
    	swal({
            title: "¿Está Seguro de haber realizado el tramite?",
           	text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "¡Si!",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false 
            },
            function(isConfirm){
            	if (isConfirm) 
            	{ 
			        $.ajax({
			            type: "PUT",
			            url: miurl,
			            data: formData,
			            dataType: 'json',

			            success: function (data) {
			            	swal({
	                            title: "Enviado correctamente",
	                            text: "",
	                            type: "success"
                            },
                            function()
                            {
                            	cargar_formularioviaje(25);
                            });              
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
            	}
                else 
                {
                	swal("¡Cancelado!","No se ha realizado cambios...","error");
                }
        });
    });
</script>