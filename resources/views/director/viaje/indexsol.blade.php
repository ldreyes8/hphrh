<link href="{{asset('assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Solicitud de gastos</h4>
    <hr style="border-color:black;" />
    <div><p><br></p></div>
    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Solicitante</th>
                        <th>Tipo de caso</th> 
                        <th>Monto solicitado</th>
                        <th>Tipo proyecto</th>
                        <th>Inicio</th>
                        <th>Fin</th>                               
                        <th>Opciones</th>
                    </thead>
                    @foreach($viaje as $v)
                    <tr>
                        <td>{{$v->nombre}}</td>
                        <td>{{$v->tipogasto}}</td>
                        <td>{{$v->montosolicitado}}</td>
                        <td>{{$v->nombreproyecto}}</td>
                        <td>{{$v->fechainicio}}</td>
                        <td>{{$v->fechafin}}</td>
                        <td>
                            @if($v->tipogasto=='caja chica')
                                <a href="#"><button class="btn btn-success btn-md" value="{{$v->idgastocabeza}}" id="btnconfirmac" title="Caja Chica"><i class="ion-checkmark-circled"></i></button></a>
                                <a href="#"><button class="btn btn-danger btn-md" id="btnrechazov" title="Rechazar"><i class="ion-close-circled"></i></button></a>
                            @else
                                <a onclick="detalleviaje(1,{{$v->idgastocabeza}});"><button class="btn btn-info btn-md" id="btnconfirmav" title="Detalles"><i class="glyphicon glyphicon-list-alt"></i></button></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach   
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/permiso.js')}}"></script>
<script src="{{asset('assets/js/JefeInmediato/viajejf.js')}}"></script>
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
</script>
