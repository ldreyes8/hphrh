<div class="card-box" id="rechazadosf">
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    		<h3>Solicitudes rechazadas</h3>
    	</div>
        @if (isset($empleado))
            <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
                 <div class="table-responsive">
                     <table class="table table-striped table-bordered table-condensed table-hover">
                         <thead>
                             <th>Id</th>
                             <th>Identificación</th>
                             <th>Nit</th>
                             <th>Nombre</th>
                             <th>Afiliado</th>
                             <th>Puesto</th>
                             <th>Status</th>
                             <th>Opciones</th>
                         </thead>
                         <tbody>

                             @foreach ($empleado as $em)
                             <tr>
                             <td>{{$em->idempleado}}</td>
                             <td>{{$em->identificacion}}</td>
                             <td>{{$em->nit}}</td>
                             <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                             <td>{{$em->fnombre}}</td>
                             <td>{{$em->pnombre}}</td>
                             <td>{{$em->statusn}}</td>
                             <td>
                             <a href="{{URL::action('Rechazados@show',$em->identificacion)}}"><button class="btn btn-primary" title="Detalles"><i class="glyphicon glyphicon-zoom-in"></i></button></a>
                             <a href="{{URL::action('Pprueba@update',$em->idempleado)}}"><button class="btn btn-success" title="Contratar"><i class="fa fa-handshake-o"></i></button></a>
                             <a> 
                                <button id="btnrechazo" title="Eliminar" 
                                onclick='
                                    if (!confirm("ADVERTENCIA!! Eliminara todos los registros de esta Persona")){return false;}
                                    else 
                                    {
                                        location.href=("{{URL::action("Rechazados@eliminar",$em->identificacion)}}");
                                    }
                                    ' 
                                class="btn btn-danger"><i class="fa fa-remove"></i></button></a>
                             </td>
                             </tr>
                             @endforeach
                        </tbody>
                     </table>
                 </div>
            </div>
        @endif
    </div>
</div>

