@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
@endsection
@section ('contenido')
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="table-responsive">
                     <table id="datatable-buttons" class="table table-striped table-bordered table-condensed table-hover" data-order='[[6, "asc"]]'>
                         <thead>
                             <th style="width: 2%">Id</th>
                             <th style="width: 4%">Identificación</th>
                             <th style="width: 2%">Nit</th>
                             <th style="width: 20%">Nombre</th>
                             <th style="width: 5%">Afiliado </th>
                             <th style="width: 12%">Puesto </th>
                             <th style="width: 5%">Solicitud</th>
                             <th style="width: 5%">Estado</th>
                             <th style="width: 50%">Opciones</th>
                         </thead>
                         @foreach ($empleados as $em)
                         <tr class="even gradeA">
                            <td>{{$em->idempleado}}
                                <input type="hidden" class="idempleado" value="{{$em->idempleado}}">
                            </td>
                            <td>{{$em->identificacion}}</td>
                            <td>{{$em->nit}}</td>
                            <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                            <td>{{$em->afnombre}}</td>
                            <td>{{$em->puesto}}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $em->fechasolicitud)->format('d-m-Y')}}</td>
                            <td>{{$em->status}}
                                <input type="hidden" class="idstatus" value="{{$em->idstatus}}">
                                <input type="hidden" value="{{$var}}">
                            </td>
                            <td>
                                <a href="{{url('empleado/solicitudesjf/show',array('id'=>$em->identificacion,'ids'=>$var))}}"><button class="btn btn-primary" title="Detalles">Detalles</button></a>                            
                                <a> 
                                    <button id="btnrechazo" 
                                        onclick='
                                        swal({
                                            title: "¿Está seguro de Rechazar la solicitud?",
                                            text: "Usted rechazara la solicitud de empleo",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "¡Si!",
                                            cancelButtonText: "No",
                                            closeOnConfirm: false,
                                            closeOnCancel: false },

                                            function(isConfirm){
                                            if (isConfirm) 
                                            {
                                                swal(
                                                    {
                                                        title: "¡Hecho!",
                                                        text: "Solicitud rechazada con éxito!!!",
                                                        type: "success"
                                                    },
                                                    function()
                                                    {
                                                        window.location.href="{{url("empleado/rechazojf",array("id"=>$em->idempleado,"ids"=>$em->idstatus))}}";
                                                        //location.reload();
                                                    }
                                                ); 
                                            }

                                            else {
                                            swal("¡Cancelado!",
                                            "No se ha realizado algún cambio...",
                                            "error");
                                            }
                                            });
                                        ' 
                                    class="btn btn-primary btnrechazo">Rechazar</button>
                                </a>
                                <a href="{{URL::action('SController@Spdf',$em->identificacion)}}"><button class="btn btn-primary">Descargar</button></a>
                            </td>
                         </tr>
                         @endforeach
                     </table>
                 </div>
                
           </div>
        </div>
@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
    <!-- Datatables-->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    
    <script src="{{asset('assets/js/RHjs/datatablesRH.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable({ ajax: "../plugins/datatables/json/scroller-demo.json",deferRender:true,scrollY:380,scrollCollapse:true,scroller:true });
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
        } );
        TableManageButtons.init();
    </script>

@endsection