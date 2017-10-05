@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
@endsection

@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Confirmacion Periodo de Prueba</h3>
        <h5>Campos obligatorios *</h5>
	</div>
</div>
<div class="row">
    {!!Form::open(array('url'=>'listados/pprueba/agregar','method'=>'POST','autocomplete'=>'off','id'=>'form','onkeypress'=>'return anular(event)','enctype'=>'multipart/form_data'))!!}
    {{Form::token()}}
        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Empleadosd</label>
                    <select name="idempleado" class="form-control " data-live-search="true" data-style="btn-info">
                            <option value="{{$empleado->idempleado}}">{{$empleado->nombre1.' '.$empleado->nombre2.' '.$empleado->apellido1.' '.$empleado->apellido2}}</option>
                    </select>
                </div>                                                
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Afiliado al que aplica</label>
                    <select name="idafiliado" class="form-control selectpicker" data-live-search="true">
                        @foreach($afiliados as $af)
                            @if($af->idafiliado == $empleado->idafiliado)
                                <option value="{{$af->idafiliado}}" selected>{{$af->nombre}}</option>
                            @else
                                <option value="{{$af->idafiliado}}">{{$af->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Puesto</label>
                    <select name="idpuesto" class="form-control selectpicker" data-live-search="true">
                        @foreach($puestos as $pu)
                            @if($pu->idpuesto == $empleado->idpuesto)
                                <option value="{{$pu->idpuesto}}" selected>{{$pu->nombre}}</option>
                            @else
                                <option value="{{$pu->idpuesto}}">{{$pu->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Caso</label>
                    <select name="idcaso" class="form-control selectpicker" data-live-search="true" >
                        @foreach($caso as $co)
                            <option value="{{$co->idcaso}}">{{$co->nombre}}</option>
                        @endforeach
                    </select>
                </div>                                                
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <label for="salario">Salario *</label>
                <div class="input-group">
                    <span class="input-group-addon">Q</i></span>
                    <input type="text" onkeypress="return valida(event)" min="0" name="salario" id="salario" class="form-control">
                </div>
                @if($errors->has('salario'))
                    <span style="color: red;">{{$errors->first('salario')}}</span>
                @endif
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha">Fecha *</label>
                    <input id="dato1" type="text" class="form-control" name="fecha">
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Jefe inmediato</label>
                    <select name="idjefe" id="jefe" class="form-control selectpicker" data-live-search="true">
                        @foreach($jefesinmediato as $co)
                            <option value="{{$co->identificacion}}">{{$co->nombre1.' '.$co->nombre2.' '.$co->apellido1.' '.$co->apellido2}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                <label> Notificar <br> </label>
                <div>
                    <input type="checkbox" id="confirma" value="1"> Si
                </div>
            </div>

            <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                <label ></label>
                <div class="form-group">
                    <button type="button" id="bt_add1" style="background-color: #E6E6E6" class="btn">Asignar</button>
                </div>                 
            </div>
            <div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
                <table id="detalle7" class="table table-striped table-bordered table-condensed table-hover ">
                    <thead>
                        <th>opciones</th>
                        <th>Jefe</th>
                        <th>Notifica</th>
                    </thead>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="descripcion">Observaciones</label>
                <div class="form-group">
                    <textarea class="form-control" maxlength="100" name="descripcion" placeholder=".........." rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" id="btnguardar">Guardar</button>
                    <a href=""><button class="btn btn-danger" id="btncancelar" type="button">Cancelar</button></a>
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
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
    //
        <script type="text/javascript">
        $(document).ready(function() {

            $(".select2").select2();

            $('#bt_add1').click(function() {
                    agregar7();
                });
        });
            
            $("#btnguardar").hide();
            $("#btncancelar").hide();

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
            
            var contJI=0;
            function limpiar()
            {
                $("#confirma").attr('checked',false);
            }
            function agregar7()
            {

                confirma=$("#confirma").val();
                jefeTex=$("#jefe option:selected").text();
                idjefe=$("#jefe").val();
                no=("No");
                si=("Si");
                if (idjefe !="") 
                {
                    if($('#confirma').is(':checked'))
                    {
                        var fila='<tr class="selected" id="fila'+contJI+'"><td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminar('+contJI+');">X</button></td><td><input type="hidden" name="idjefes[]" value="'+idjefe+'">'+jefeTex+'</td> <td><input type="hidden" name="confirma[]" value="'+confirma+'">'+si+'</td> </tr>';
                        contJI++;
                        $('#detalle7').append(fila);
                        limpiar();
                        $("#btnguardar").show();
                    }
                    else
                    {
                        var fila='<tr class="selected" id="fila'+contJI+'"><td><button type="button" style="background-color:#E6E6E6"  class="btn " onclick="eliminar('+contJI+');">X</button></td><td><input type="hidden" name="idjefes[]" value="'+idjefe+'">'+jefeTex+'</td> <td><input type="hidden" name="confirma[]" value="2">'+no+'</td> </tr>';
                        contJI++;
                        $('#detalle7').append(fila);
                        $("#btnguardar").show();
                    }
                }
                else
                {
                    alert('Existen campos obligatorios');
                }

            }
            
            function eliminar(index)
            {
                $("#fila" + index).remove();
            }

        /*$("#btnguardar").click(function()
        { 
            re=$("#detalle7").val();
            if (re!="") {
                    return true;
                }
                else
                {
                    return false;
                }  
              
        });*/
        </script>
        
@endsection
