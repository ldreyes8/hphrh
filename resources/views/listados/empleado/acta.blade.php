@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />
@endsection

@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Acta</h3>
        <h5>Campos obligatorios *</h5>
	</div>
</div>
<div class="row">
    {!!Form::open(array('url'=>'listados/empleado/agregar','method'=>'POST','autocomplete'=>'off','files'=>'true','onkeypress'=>'return anular(event)','enctype'=>'multipart/form_data'))!!}
    {{Form::token()}}
        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Jefe</label>
                    <select name="idjefe" class="form-control selectpicker" data-live-search="true" data-style="btn-info">
                            <option value="{{$asignajefe->idasignajefe}}">{{$asignajefe->nombre1}}</option>
                    </select>
                </div>                                                
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Empleado</label>
                    <select name="idempleado" class="form-control selectpicker" data-live-search="true" data-style="btn-info">
                            <option value="{{$empleado->idempleado}}">{{$empleado->nombre1.': '.$empleado->apellido1}}</option>
                    </select>
                </div>                                                
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Motivo</label>
                    <select name="motivo" class="form-control">
                        <option value="Felicitacion">Felicitación</option>
                        <option value="Llamada de atención">Llamada de atención</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha">Fecha *</label>
                    <input id="dato1" type="text" class="form-control" name="fecha">
                </div>
            </div>
        </div>    
        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <label for="comentario">Comentario</label>
                <div class="form-group">
                    <textarea class="form-control" maxlength="100" name="comentario" placeholder=".........." rows="3"></textarea>
                </div>
                @if($errors->has('comentario'))
                    <span style="color: red;">{{$errors->first('comentario')}}</span>
                @endif
            </div>  
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <label for="adjunto">Adjunto</label>
                <div class="form-group">
                    <input type="file" name="adjunto" id="prs" class="form-control">
                </div>
            </div>          
        </div>
        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-info" id="btnguardar" type="submit">Guardar</button>
                    <a href=""><button class="btn btn-danger" type="button">Cancelar</button></a>
                </div>
            </div>
        </div>
        
    {!!Form::close()!!}
</div>
@endsection

@section('fin')
    @parent
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>
@endsection
