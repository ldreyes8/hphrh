@extends ('layouts.index')
@section('estilos')
    @parent
 
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
   
@endsection
@section ('contenido')

<div class="row"> 
<input type="hidden" name="idempleado" value="{{$usuario->idempleado}}" id="idempleado">

    <div class="col-lg-3 col-md-4">
        <div class="box box-primary">                        
             
            <div class="card-box">
                <h4 class="text-center">Reporte</h4>
                <div class="member-card">
                    <div class="form-group">
                        <label class="control-label text-center">Fecha inicio</label>
                        
                        <div class="form-group">
                            <input type="text" id="fecha_inicio" class="form-control" name="fini">
                        <!--    <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span> -->
                        </div>
                   
                        <label class="control-label">Fecha final</label>
                        <div class="form-group">
                            <input type="text" id="fecha_final" class="form-control" name="ffin">

                        </div>
                    </div>
                                  
                    <div class="box-footer">
                        <button type="button" id="btngoce" class="btn btn-primary btn-sm w-sm waves-effect m-t-10 waves-light">Guardar</button>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div>
        <!---
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title">opciones</h4>
            <button class="btn btn-primary" id="btndescargar">Descargar</button>
            
              <a href="{{URL::action('VController@Gpdf')}}"><button class="btn btn-primary">Descargar</button></a> 
  
        </div>
        -->
    </div>

    <div class="col-md-8 col-lg-9">
        <div class="tab-content"> 
            <div class="row">
            	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                  <h3 class="text-center">Constancia de vacaciones</h3>
                    <h4>Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$usuario->nombre1.' '.$usuario->nombre2.' '.$usuario->nombre3.' '.$usuario->apellido1.' '.$usuario->apellido2}}</h4>
                    <h4>Puesto:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$usuario->puesto}}</h4>
                    <h4>Ubicación:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$usuario->afiliado}}</h4>
                    <h4>Fecha de ingreso a la fundacion</h4>
                    <h4>Fecha de emision de la constancia:&nbsp;&nbsp;&nbsp;{{$year}}</h4>
                    <p>Se hace constar que el colaborador (a) gozó de su período vacacional como se detalla a continuación</p>
            	</div>
            </div>
            <div class="row">
               <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover" id="dataTableItems">
                            <thead>
                                <th>FECHA DE SOLICITUD</th>
                                <th>DÍAS TOMADOS</th>
                                <th>TOTAL DE DIAS</th>
                                <th>PERÌODO VACACIONAL</th>
                            </thead>
                            
                        </table>
                    </div>
               </div>
            </div>

            <h5 class="text-center">TOTAL DE DIAS &nbsp;&nbsp;&nbsp;&nbsp; <label id="dtomado"></label></h5>


            <p>Quedando completo el período vacacional correspondiente al: <strong><u>03/03/11-02/03/12.</u></strong></p>
                  
            <div class="text-align: right"><p>&nbsp;&nbsp;SALDO DEL PERIODO: <strong>03/03/11 AL 02/03/12_____ (Llenar este espacio solo si hubiera saldo del periodo).</strong></p></div>

            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIRMAS DE CONFORMIDAD:</p>

            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            _______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________
            </p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Jefe inmediato Superior&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Colaborador (a)
            </p>

            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vº Bº Depto. de Recursos Humanos
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(firma y sello)
            </p>
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
@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
        <script src="{{asset('assets/js/gocevacaciones.js')}}"></script>
        <meta name="_token" content="{!! csrf_token() !!}" />

        <script>
            $("#btndescargar").hide();
        </script>

@endsection