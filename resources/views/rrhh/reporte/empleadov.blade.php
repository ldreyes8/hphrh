<style type="text/css">
	/*
 *  Usage:
 *
 *    <div class="sk-spinner sk-spinner-double-bounce">
 *      <div class="sk-double-bounce1"></div>
 *      <div class="sk-double-bounce2"></div>
 *    </div>
 *
 */
.sk-spinner-double-bounce.sk-spinner {
  width: 40px;
  height: 40px;
  position: relative;
  margin: 0 auto;
}
.sk-spinner-double-bounce .sk-double-bounce1,
.sk-spinner-double-bounce .sk-double-bounce2 {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: #1ab394;
  opacity: 0.6;
  position: absolute;
  top: 0;
  left: 0;
  -webkit-animation: sk-doubleBounce 2s infinite ease-in-out;
  animation: sk-doubleBounce 2s infinite ease-in-out;
}
.sk-spinner-double-bounce .sk-double-bounce2 {
  -webkit-animation-delay: -1s;
  animation-delay: -1s;
}
@-webkit-keyframes sk-doubleBounce {
  0%,
  100% {
    -webkit-transform: scale(0);
    transform: scale(0);
  }
  50% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}
@keyframes sk-doubleBounce {
  0%,
  100% {
    -webkit-transform: scale(0);
    transform: scale(0);
  }
  50% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}



</style>
                @if (isset($historialvacaciones))

                <div class=class="col-lg-6 col-md-6 col-sm-8 col-xs-12">

                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				        <div class="navbar-form navbar-left pull-left">
				        	<a href="{{URL::action('RHReporte@vpempleado')}}">
				            <button class="btn btn-success btn-md"><i class="fa fa-reply-all"></i></button>
				            </a>
				        </div>

				        <h4 class="box-title" align="center">Historial de vacaciones del año {{$year}}</h4>
				        <hr style="border-color:black;" />
				    </div>
					<div class="row">
	            	</div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItems">
                            <thead>
                                <th>Solicitud</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Días tomados</th>
                                <th>Horas tomadas</th>
                                <th>Autorizacion</th>
                                
                            </thead>
                                @foreach ($historialvacaciones as $aus)
                                <tr>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechasolicitud)->format('d-m-Y')}}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechainicio)->format('d-m-Y')}}</td>
                                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechafin)->format('d-m-Y')}}</td> 
                                    
                                    @if(($aus->htomado/10000) == -4)

                                        <td>{{$aus->diastomados - 1}}</td>
                                        <td>{{abs($aus->htomado)/10000}}</td>
                                    @else
                                        <td>{{$aus->diastomados}}</td>
                                        <td>{{$aus->htomado / 10000}}</td>
                                    @endif
                                    <td>{{$aus->autorizacion}}</td>
                                   
                                </tr>                
                                @endforeach
                        </table>
                    </div>
                </div>

                @endif()

                 <div class="col-lg-4">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Double bounce</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="spiner-example">
                                <div class="sk-spinner sk-spinner-double-bounce">
                                    <div class="sk-double-bounce1"></div>
                                    <div class="sk-double-bounce2"></div>
                                    <div class="sk-double-bounce1"></div>
                                    <div class="sk-double-bounce2"></div>
                                    <div class="sk-double-bounce1"></div>
                                    <div class="sk-double-bounce2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <li class="sk-folding-cube">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </li>