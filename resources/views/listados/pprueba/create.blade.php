@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />
@endsection

@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>ConfirmacionGG</h3>
        <h5>Campos obligatorios *</h5>
	</div>
</div>
<div class="row">
    {!!Form::open(array('url'=>'listados/pprueba/agregar','method'=>'POST','autocomplete'=>'off','id'=>'form','onkeypress'=>'return anular(event)','enctype'=>'multipart/form_data'))!!}
    {{Form::token()}}
        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
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
                    <label>Jefe inmediato</label>
                    <select name="idjefe" class="form-control selectpicker" data-live-search="true">
                        @foreach($jefesinmediato as $co)
                            <option value="{{$co->idjefeinmediato}}">{{$co->nombre1.': '.$co->apellido1}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Afiliado al que aplica</label>
                    <select name="idafiliado" class="form-control selectpicker" data-live-search="true">
                            <option value="{{$afiliados->idafiliado}}">{{$afiliados->nombre}}</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Puesto</label>
                    <select name="idpuesto" class="form-control selectpicker" data-live-search="true">
                            <option value="{{$puestos->idpuesto}}">{{$puestos->nombre}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Caso</label>
                    <select name="idcaso" class="form-control selectpicker" data-live-search="true" data-style="btn-info">
                        @foreach($caso as $co)
                            <option value="{{$co->idcaso}}">{{$co->nombre}}</option>
                        @endforeach
                    </select>
                </div>                                                
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <label for="salario">Salario *</label>
                <div class="input-group">
                    <span class="input-group-addon">Q</i></span>
                    <input type="text" onkeypress="return valida(event)" min="0" name="salario" id="salario" class="form-control">
                </div>
                @if($errors->has('salario'))
                    <span style="color: red;">{{$errors->first('salario')}}</span>
                @endif
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha">Fecha *</label>
                    <input id="dato1" type="text" class="form-control" name="fecha">
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <label for="descripcion">Observaciones</label>
                <div class="form-group">
                    <textarea class="form-control" name="descripcion" placeholder=".........." rows="3"></textarea>
                </div>
            </div>

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

        <script type="text/javascript">
            function valida(e){
                tecla = e.keyCode || e.which;
                tecla_final = String.fromCharCode(tecla);
                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8 || tecla==37 || tecla==39 ||tecla==46 ||tecla==9)
                    {
                        return true;
                    } 
                // Patron de entrada, en este caso solo acepta numeros
                patron =/[0-9]/;
                //patron =/^\d{9}$/;
                return patron.test(tecla_final);
            }
        </script>
@endsection
