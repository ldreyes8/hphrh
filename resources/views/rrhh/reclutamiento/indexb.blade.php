<div class="row" id="tblsolicitante">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 class="box-title" align="center">Listado de solicitudes de empleo nacional</h3>
            </div>
        
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="table-responsive">
                    <input type="hidden" value="{{$var}}">
                     <table id="datatable-buttons" class="table table-striped table-bordered table-condensed table-hover" data-order='[[6, "desc"]]'>
                         <thead>
                             <th style="width: 2%">Id</th>
                             <th style="width: 4%">Identificación</th>
                             <th style="width: 2%">Nit</th>
                             <th style="width: 20%">Nombre</th>
                             <th style="width: 5%">Afiliado </th>
                             <th style="width: 12%">Puesto </th>
                             <th style="width: 5%">Solicitud</th>
                             <th style="width: 5%">Estado</th>
                             <th style="width: 45%">Opciones</th>
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
                                
                            </td>
                            <td>
                                <a href="{{url('empleado/solicitudes/show',array('id'=>$em->identificacion,'ids'=>$var))}}"><button class="btn btn-primary" title="Detalles"><i class="glyphicon glyphicon-zoom-in"></i></button></a>
                                
                                <a href="{{URL::action('Pprueba@update',$em->idempleado)}}"><button class="btn btn-success" title="Aceptar"><i class="fa fa-handshake-o"></i></button></a>
                            
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
                                                        window.location.href="{{url("empleado/rechazo",array("id"=>$em->idempleado,"ids"=>$em->idstatus))}}";
                                                        //window.location.reload(true);
                                                        //window.self.close(); 
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
                                    class="btn btn-danger btnrechazo"><i class="fa fa-remove"></i></button>
                                </a>
                                <a href="{{URL::action('SController@Spdf',$em->identificacion)}}"><button class="btn btn-default" title="Descargar"><i class="fa fa-download"></i></button></a>
                            </td>
                         </tr>
                         @endforeach
                     </table>
                 </div>
           </div>
</div>