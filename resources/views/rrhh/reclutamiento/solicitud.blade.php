<div class="tab-pane active" id="listadoSol">
    @if (isset($empleados))
        <div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        		@include('empleado.solicitante.search')
        	</div>
        </div>
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="table-responsive">
                     <table class="table table-striped table-bordered table-condensed table-hover">
                         <thead>
                             <th>Id</th>
                             <th>Identificación</th>
                             <th>Nit</th>
                             <th>Nombre</th>
                             <th>Afiliado </th>
                             <th>Puesto aplicar</th>
                             <th>Status</th>
                             <th>Opciones</th>
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
                            <td>{{$em->status}}
                                <input type="hidden" class="idstatus" value="{{$em->idstatus}}">
                            </td>
                            <td>
                                <a href="{{URL::action('SController@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                                <a href="{{URL::action('Pprueba@update',$em->idempleado)}}"><button class="btn btn-primary">Aceptar</button></a>
                            
                                <a > 
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
                                                window.location.href="{{url("empleado/rechazo",array("id"=>$em->idempleado,"ids"=>$em->idstatus))}}";
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
                                class="btn btn-primary btnrechazo">Rechazar</button></a>
                                <a href="{{URL::action('SController@Spdf',$em->identificacion)}}"><button class="btn btn-primary">Descargar</button></a>
                            </td>
                         </tr>
                         @endforeach
                     </table>
                 </div>
                 {{$empleados->render()}}
           </div>
        </div>
    @endif
</div>