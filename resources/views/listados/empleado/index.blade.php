@extends ('layouts.index')
@section ('contenido')

<div class="tab-pane" id="otros">
    <h3>Empleados</h3>
    <ul class="nav nav-tabs navtab-custom">
        <li class="active tab"><a href="#lisadoEmp" data-toggle="tab">Listado General</a></li>
        <li><a href="#salarios" data-toggle="tab">Salarios</a></li>
        <li><a href="#rechazados" data-toggle="tab">Rechazados</a></li>
        <li><a href="#nombramientos" data-toggle="tab">Nombramientos</a></li>
    </ul>
</div>

<div class="tab-content bx-s-0 m-b-0" >
    <div class="tab-pane p-t-10 fade in active" id="lisadoEmp">
        <div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        		@include('listados/empleado.search')
        	</div>
        </div>
        <div class="row">

           <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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
                             <a href="{{URL::action('ListadoController@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                             <!--a href="{{URL::action('ListadoController@historial',$em->idempleado)}}"><button class="btn btn-primary">Historial</button></a>
                             <a href="{{URL::action('ListadoController@Acta',$em->idempleado)}}"><button class="btn btn-primary">Acta</button></a-->
                             <a href="{{URL::action('ListadoController@laboral',$em->idempleado)}}"><button class="btn btn-primary
                             ">Historia laboral</button></a>
                            <button class="btn btn-primary btn-vacaciones" id="btnsaldo" value="{{$em->idempleado}}">Vacaciones</button>
                            <a href=""><button class="btn btn-primary">Despedir</button></a>
                         </td>
                         </tr>

                         @endforeach
                     </table>
                 </div>
                 {{$empleado->render()}}
           </div>
        </div>
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

    </div>
    <div class="tab-pane p-t-10 fade" id="salarios">
    </div>
    <div class="tab-pane p-t-10 fade" id="rechazados">
    </div>
    <div class="tab-pane p-t-10 fade" id="nombramientos">
    </div>
</div>
@endsection
@section('fin')
    @parent
        <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="{{asset('assets/js/RH.js')}}"></script>

@endsection


