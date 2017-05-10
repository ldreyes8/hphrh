@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
@endsection


@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de vacaciones <button class="btn btn-success" id="btnnuevo" >Nuevo</button></h3>
    </div>
</div>

<div class="row">
   <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Solicitud</th>
                    <th>Iniicio</th>
                    <th>Fin</th>
                    <th>Total dias</th>
                    <th>Total horas</th>
                    <th>Autorizacion</th>
                </thead>
                @foreach ($ausencias as $aus)
                <tr>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechasolicitud)->format('d-m-Y')}}</td>

                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechainicio)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $aus->fechafin)->format('d-m-Y')}}</td> 
                    <td>{{$aus->totaldias}}</td>
                    <td>{{$aus->totalhoras}}</td>
                    <td>{{$aus->autorizacion}}</td>
                 </tr>
                
                @endforeach
             </table>
         </div>
         {{$ausencias->render()}}
   </div>
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

                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <button class="btn btn-success" id="btnnuevo" >Nuevo</button><

                    </div>


                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div><label for="horainicio">Hora inicio</label></div>
                         
                                <select name="horainicio" id="hinicio" class="form-control">
                                    <option value="00">00</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                </select>
                            
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div><label for="horainicio">Hora fin</label></div>
                           
                                <select name="horafin" id="hfin" class="form-control">
                                    <option value="00">00</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                </select>
                          
                        </div>
                        <div><p><br><br><br><br><br></p></div>

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Fecha inicio</label>
                            <div class="input-group">
                                <input type="text" id="fechaini" class="form-control" name="fechainicio">
                                <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                            </div>
                            <div class="text-danger" id="error_fechaini">{{$errors->formulario->first('fechainicio')}}</div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label">Fecha final</label>
                            <div class="input-group">
                                <input type="text" id="fechafin" class="form-control" name="fechafin">
                                <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>
                            </div>
                            <div class="text-danger" id="error_fechafin">{{$errors->formulario->first('fechafin')}}</div>
                        </div>
             
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('fin')
    @parent
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
        <script src="{{asset('assets/js/fecha.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
        <script src="{{asset('assets/js/vacaciones.js')}}"></script>
         <script>


        $(function(){
            $("#formAgregar").submit(function(e){
                var fields = $(this).serialize();

                $.post("{{url('empleado/vacaciones/create')}}", fields, function(data){

                    if(data.valid !== undefined){
                        $("#result").html("En hora buena formulario enviado correctamente");
                        $("#formAgregar")[0].reset();
                        $("#error_fechaini").html('');
                        $("#error_fechafin").html('');
                    }
                    else{
                        $("#error_fechaini").html('');
                        $("#error_fechafin").html('');
                        if (data.fechainicio !== undefined){
                            $("#error_fechaini").html(data.fechainicio); 
                        }
                        if (data.fechafin !== undefined){
                            $("#error_fechafin").html(data.fechafin);
                        }
                    }
                    var errHTML="";
                 
                

                    if(typeof data.error != 'undefined')
                    {
                        for(e in data.error){
                            errHTML+=data.error[e];
                            //$("#result").html("la fecha inicio no puede ser mayor a la fecha final");
                    }
                    
                    $("#erroresContent").html(errHTML);
                     $('#erroresModal').modal('show');
                }
                      
                });

                return false;
            });
        });        
        </script>
@endsection
