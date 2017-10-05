<div class="card-box" id="lisadoEmp">
    <div class="row">
        <h3>Listado de empleados que han sido despedidos o renunciaron</h3>

        <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
             <div class="table-responsive">
                 <table class="table table-striped table-bordered table-condensed table-hover" >
                     <thead>
                         <th>Id</th>
                         <th>Identificación</th>
                         <th>Nit</th>
                         <th>Nombre</th>
                         <th>Afiliado</th>
                         <th>Puesto</th>
                         <th>Status</th>
                         <th style="width: 13%">Opciones</th>
                     </thead>
                     @foreach ($empleado as $em)
                     <tr id="empleado{{$em->idempleado}}">
                         <td>{{$em->idempleado}}</td>
                         <td>{{$em->identificacion}}</td>
                         <td>{{$em->nit}}</td>
                         <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                         <td>{{$em->afiliado}}</td>
                         <td>{{$em->puesto}}</td>
                         <td>{{$em->statusn}}</td>
                        <td>
                            <a href="{{URL::action('ListadoController@show',$em->identificacion)}}"><button class="btn btn-primary" title="Detalles"><i class="fa fa-search-plus"></i></button></a>
                            <a href="{{URL::action('ListadoController@laboral',$em->idempleado)}}"><button class="btn btn-primary" title="Historial laboral "><i class="fa fa-stack-overflow"></i></button></a>
                            <button class="btn  btn-default btn-md" onclick="vernombramiento_emp({{$em->idempleado }})"><i class="fa fa-handshake-o"></i></button>
                         </td>
                      
                     </tr>
                     @endforeach
                 </table>
             </div>
             {{$empleado->render()}}
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
        <h4 class="modal-title">Errores</h4>
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
