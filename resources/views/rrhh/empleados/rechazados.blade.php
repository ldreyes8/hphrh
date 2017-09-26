<div class="card-box" id="rechazadosf">
    <div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    		<h3>Solicitudes rechazadas</h3>
    	</div>
        @if (isset($empleado))
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                             <button type="button" id="btncomentarioEL" value="{{$em->identificacion}}" class="btn btn-success btnpr" title="Contratar"><i class="fa fa-handshake-o"></i></button>
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
                {{$empleado->render()}}
            </div>
        @endif
    </div>


    <div class="col-lg-12">
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="inputTitle"></h4>
              </div>
              <div class="modal-body">
              <form role="form" id="formAgregar">
                    <input type="hidden" id="idempleado" name="idempleado" value="{{$em->idempleado}}">
                    <input type="hidden" id="identificacion" name="identificacion" value="">
                    <div class="form-group">
                        <label for="nombrer">Nombre completo *</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" >
                    </div>                               
                    <div class="form-group">
                            <label for="nota">Puesto</label>
                            <select name="idpuesto" id="puesto" class="form-control select2" data-live-search="true">
                                @foreach($puestos as $cat)
                                    <option value="{{$cat->idpuesto}}">{{$cat->nombre}}</option>
                                @endforeach
                            </select>
                    </div>                                  
                    <div class="form-group">
                        <label for="nota">Afiliado</label>         
                        <select name="idafiliado" id="afiliado" class="form-control select2" data-live-search="true" >
                            @foreach($afiliados as $cat)
                                <option value="{{$cat->idafiliado}}">{{$cat->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
              </form>                                                                       

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btnGuardar" id="btnGuardar">Guardar</button>
              </div>
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
</div>

<script type="text/javascript">
    $(document).on("click",".pagination li a",function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $("#rechazadosf").html($("#cargador_empresa").html());
        $.get(url,function(resul){
            $("#rechazadosf").html(resul);  
        })
    })
</script>