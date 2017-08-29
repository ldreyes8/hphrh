@extends ('layouts.index')
@section('estilos')
    @parent
    
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
@endsection
@section ('contenido')
        

        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="table-responsive">
                     <table class="table table-striped table-bordered table-condensed table-hover">
                         <thead>
                             <th style="width: 2%">Id</th>
                             <th style="width: 4%">Identificación</th>
                             <th style="width: 2%">Nit</th>
                             <th style="width: 25%">Nombre</th>
                             <th style="width: 5%">Afiliado </th>
                             <th style="width: 15%">Puesto </th>
                             <th style="width: 10%">Status</th>
                             <th style="width: 42%">Opciones</th>
                         </thead>
                         @foreach ($empleados as $em)
                         <tr class="even gradeA">
                            <td>{{$em->idempleado}}
                                <input type="hidden" id="idempleado" class="idempleado" value="{{$em->idempleado}}">
                            </td>
                            <td>{{$em->identificacion}}</td>
                            <td>{{$em->nit}}</td>
                            <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                            <td>{{$em->afnombre}}</td>
                            <td>{{$em->puesto}}</td>
                            <td>{{$em->status}}
                                <input type="hidden" class="idstatus" value="{{$em->idstatus}}">
                            </td>
                            <td>
                                <a href="{{URL::action('RHEvaluciones@show',$em->identificacion)}}"><button class="btn btn-primary" title="Detalles"><i class="glyphicon glyphicon-zoom-in"></i></button></a>
                                <a href="{{URL::action('RHEvaluciones@listadotablares',$em->idempleado)}}"><button type="button" class="btn btn-success" title="ver Resultados"><i class="fa-calculator"></i></button></a>
                            
                                <a> 
                                    <button title="Rechazar" id="btnrechazo" 
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
                                                        window.location.href="{{url("empleado/rechazoe",array("id"=>$em->idempleado,"ids"=>$em->idstatus))}}";
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
                                    class="btn btn-danger btnrechazo"><i class="fa fa-remove"></i> </button>
                                </a>
                                
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
@endsection