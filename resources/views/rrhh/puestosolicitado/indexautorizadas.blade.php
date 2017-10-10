<div class="card-box" id="lisadoEmp">
    @if (isset($puesto))
    @if(count($puesto) > 0)

        <h4 class="box-title" align="center">Plazas autorizadas</h4>
        <hr style="border-color:black;" />

        <div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Id</th>
                            <th>Fecha Solicitud</th>
                            <th>Afiliado</th>
                            <th>Puesto</th>
                            <th>Solicitante</th>
                            <th style="width: 20%">Opciones</th>
                        </thead>
                        @foreach ($puesto as $pue)
                        <tr class="even gradeA" id="vacante{{$pue->idvacante}}">
                          	<td>{{$pue->idvacante}}</td>
                           	<td>{{$pue->fecha}}</td>
                           	<td>{{$pue->afiliado}}</td>
                           	<td>{{$pue->puesto}}</td>
                           	<td>{{$pue->nombre1.' '.$pue->nombre2.' '.$pue->apellido1.' '.$pue->apellido2}}</td>
                           	<td>
                               	<button class="btn btn-danger btn-disablevacante" id="btndesablev" value="{{$pue->idvacante}}" title="Rechazar" ><i class="fa fa-remove"></i></button>
                           	</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                {{$puesto->render()}}
            </div>
        </div>
    @else
        <br/><div class='rechazado'><label style='color:#FA206A'>...No se ha encontrado ninguna plaza autorizada  ...</label>  </div> 
    @endif
    @endif
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


<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>

<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {
    	$(".select2").select2();        
  	});
</script>