<div class="tab-pane active" id="lisadoEmp">
    @if (isset($empleado))
        <div class="row">
            
                {!! Form::open(['url'=>'empleado/busqueda','method'=>'GET','class'=>'navbar-form navbar-left pull-right','role'=>'search']) !!}
                    <div class="form-group">
                        <select name="select" id="select" class="form-control selectpicker" data-live-search="true">
                            @foreach($caso as $p)
                                
                                    <option value="{{$p->idcaso}}">{{$p->nombre}}</option>
                                
                            @endforeach
                        </select>
                        <input type="text" class="form-control" id="searchText" name="searchText" placeholder="Buscar..." value="{{$searchText}}"> 
                    </div>
                    <button type="button" class="btn btn-default" onclick="buscarusuario();">Buscar</button>
                {{Form::close()}}
            
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
                             <th>Afiliado</th>
                             <th>Puesto</th>
                             <th>Status</th>
                             <th>Opciones</th>
                        </thead>
                         @foreach ($empleado as $em)
                        <tr>
                            <td>{{$em->idempleado}}</td>
                            <td>{{$em->identificacion}}</td>
                            <td>{{$em->nit}}</td>
                            <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                            <td>{{$em->afiliado}}</td>
                            <td>{{$em->puesto}}</td>
                            <td>{{$em->statusn}}</td>
                            <td>
                                <a href="{{URL::action('ListadoController@show',$em->identificacion)}}"><button class="btn btn-primary" title="Detalles"><i class="glyphicon glyphicon-zoom-in"></i></button></a>
                                 <!--a href="{{URL::action('ListadoController@historial',$em->idempleado)}}"><button class="btn btn-primary">Historial</button></a>
                                 <a href="{{URL::action('ListadoController@Acta',$em->idempleado)}}"><button class="btn btn-primary">Acta</button></a-->
                                <a href="{{URL::action('ListadoController@laboral',$em->idempleado)}}"><button class="btn btn-primary" title="Historial laboral"><i class="fa fa-stack-overflow"></i></button></a>
                                <button class="btn btn-primary btn-vacaciones" id="btnsaldo" value="{{$em->idempleado}}" title="Vacaciones"><i class="fa fa-camera-retro fa-lg"></i></button>
                                <a href=""><button class="btn btn-danger" title="Despedir"><i class="fa fa-remove"></i></button></a>
                            </td>
                        </tr>

                         @endforeach
                     </table>
                 </div>
                 {{$empleado->render()}}
           </div>
        </div>
    @endif
        <div class="col-lg-12">
            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <input type="hidden" name="tdias" id="tdias">
                    <input type="hidden" name="thoras" id="thoras">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="inputTitle"></h4>
                        </div>
                      
                            <form role="form" id="formAgregar">
                                <div class="modal-header">
                                <br>                           
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="control-label">Días acumulados</label>
                                        <input id="dacumulado" type="text" class="form-control" name="dias">   
                                    </div>
                                </div>
                                           
                            </form>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('assets/js/RH.js')}}"></script>
</div>




