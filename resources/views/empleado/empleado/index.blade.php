@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Datos generales&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success" id="btnAgregar"><i class="icon-user icon-white" ></i> Agregar o editar datos</button></h3>
	</div>
</div>
<div><br></div>

<!--
<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <font color="blue">Datos generales</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success">Agregar o Editar</button>  Identificacion,Nit,Nombre,Afilacion igss,Fecha nacimiento
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <font color="blue">Vivienda</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success">Agregar o Editar</button><alquiler mensual, vivienda propia, alquilada, vive con padres 
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <font color="blue">Direcci&oacute;n</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success">Agregar o Editar</button> direccion 
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <font color="blue">Otros datos</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success">Agregar o Editar</button> direccion
        </div>
</div>

-->

<div class="row">
    <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Identificación</th>
                    <th>Nit</th>
                    <th>Nombre</th>
                    <th>Estado civil</th>
                    <th>Afilaci&oacute;n iggs</th>
                    <th>Genero</th>
                    <th>Direcci&oacute;n</th>
                    <th>Fecha Nacimiento</th>
                    <th>Numero dependientes</th>
                    <th>Aporte Mensual</th>
                    <th>Vivienda</th>
                </thead>
                <tbody id="per" name="per">
                    @if(isset($empleado))
                        @for ($i=0;$i <= count($empleado);$i++)
                            <tr class="even gradeA" id="empleado{{$empleado[$i]->identificacion}}">
                                <td>{{$empleado[$i]->identificacion}}</td>
                                <td>{{$empleado[$i]->nit}}</td>
                                <td>{{$empleado[$i]->nombre1.' '.$empleado[$i]->nombre2.' '.$empleado[$i]->nombre3.' '.$empleado[$i]->apellido1.' '.$empleado[$i]->apellido2.' '.$empleado[$i]->apellido3}}</td>
                                <td>{{$empleado[$i]->estadocivil}}</td>
                                <td>{{$empleado[$i]->afiliacionigss}}</td>
                                    @if ($empleado[$i]->genero == "M")
                                        <td>Masculino</td>
                                    @endif

                                    @if ($empleado[$i]->genero == "F")
                                        <td>Femenino</td>
                                    @endif

                                <td>{{$empleado[$i]->barriocolonia}}</td>
                                <td>{{$empleado[$i]->fechanac}}</td>
                                <td>{{$empleado[$i]->numerodependientes}}</td>
                                <td>{{$empleado[$i]->aportemensual}}</td>
                                <td>{{$empleado[$i]->vivienda}}</td>
                    
                            </tr>
                        @endfor
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


</div>
<div class="col-lg-12">
    <input type="hidden" name="" id="valgenero">
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="inputTitle"></h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="formAgregar">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="identificacion">Identicación *</label>
                            <div class="form-group">
                                <input type="text" name="identificacion" id="identificacion" maxlength="13" onkeypress="return valida(event)" class="form-control">
                                <!--<div class="text-danger" id="error_identi">{{$errors->formulario->first('identificacion')}}</div>-->
                                @if($errors->has('identificacion'))
                                    <span style="color: red;">{{$errors->first('identificacion')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="nit">Nit </label>
                                <input type="text" name="nit" id="nit" class="form-control" maxlength="9">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre1</label>
                                <input class="form-control" id="nombre1" name="nombre1">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre2</label>
                                <input class="form-control" id="nombre2" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre3</label>
                                <input class="form-control" id="nombre3" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Apellido1</label>
                                <input class="form-control" id="apellido1" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Apellido2</label>
                                <input class="form-control" id="apellido2" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Apellido3</label>
                                <input class="form-control" id="apellido3" name="titulo">
                            </div>
                        </div>

                        <!--                                          
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Departamento</label>
                                <select name="iddepartamento" id="iddepartamento1" class="form-control selectpicker" data-live-search="true" data-style="btn-info">
                                @if (isset($departamento))
                                    @foreach($departamento as $depa)
                                        <option value="{{$depa->iddepartamento}}">{{$depa->nombre}}</option>
                                    @endforeach
                                @endif  
                                </select>
                            </div>                                                
                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Municipio</label>
                                {!! Form::select('pidmunicipio',['placeholder'=>'Selecciona'],null,['id'=>'pidmunicipio','class'=>'form-control']) !!}
                            </div>
                        </div>

                        -->

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="fechanac">Fecha de nacimiento *</label>
                                <input id="fechanac" type="text" class="form-control" name="fechanac">
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Estado civil</label>
                                <select name="idcivil" class="form-control" id="idcivil" data-live-search="true">
                                    @if (isset($estadocivil))
                                    @foreach($estadocivil as $cat)
                                        @if($cat->idcivil == $em->idcivil)                 
                                            <option value="{{$cat->idcivil}}" selected>{{$cat->estado}}</option>
                                        @else
                                            <option value="{{$cat->idcivil}}">{{$cat->estado}}</option>
                                        @endif                                        
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>   

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <label>Genero</label>
                            <div class="form-group">
                                <label ><input type="radio" name="genero" value="M" id="generoM">Masculino</label>
                                <label ><input type="radio" name="genero" value="F" id="generoF">Femenino</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="numerodependientes">Dependientes</label>
                                <input type="number" name="numerodependientes" id="dependientes" min="0" class="form-control" onkeypress="return valida(event)">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="aportemensual">Aporte mensual</label>
                                <input type="number" name="aportemensual" id="apmensual" min="0" class="form-control" onkeypress="return valida(event)">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Vivienda</label>
                                <select name="vivienda" class="form-control">
                                    <option value="casa propia">casa propia</option>
                                    <option value="vive con familiares">vive con familiares</option>
                                    <option value="Alquila">Alquila</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <label for="alquilermensual">Alquiler mensual</label>
                            <div class="input-group">
                                <span class="input-group-addon">Q</i></span>
                                <input type="text" min="0" name="alquilermensual" id="alquilermensual" class="form-control" onkeypress="return valida(event)">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <label for="otrosingresos">Otros ingresos</label>
                            <div class="input-group">
                                <span class="input-group-addon">Q</i></span>
                                <input type="text" min="0" name="otrosingresos" id="otrosingresos" class="form-control" onkeypress="return valida(event)">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="barriocolonia">Dirección completa *</label>
                                <input type="text-area" maxlength="100" name="barriocolonia" id="barriocolonia" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    <input type="hidden" name="iddg" id="iddg" value="0"/>
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
@endsection

@section('fin')
    @parent
        <script src="{{asset('assets/plugins/summernote/dist/summernote.min.js')}}"></script>
        <script src="{{asset('assets/js/permiso.js')}}"></script>
        <meta name="_token" content="{!! csrf_token() !!}" />

        <script>
            jQuery(document).ready(function () {
                

                $('#btnAgregar').click(function(){
                    //var idacad=$(this).val();
                    var miurl="listardgenerales";
                    $.get(miurl, function(data){
                        console.log(data);
                        $('#identificacion').val(data.identificacion);
                        $('#nit').val(data.nit);
                        $('#nombre1').val(data.nombre1);
                        $('#nombre2').val(data.nombre2);
                        $('#nombre3').val(data.nombre3);
                        $('#apellido1').val(data.apellido1);
                        $('#apellido2').val(data.apellido2);
                        $('#apellido3').val(data.apellido3);
                        $('#barriocolonia').val(data.barriocolonia);
                        $('#fechanac').val(data.fechanac);
                        $('#genero').val(data.genero);
                        $('#dependientes').val(data.numerodependientes);
                        $('#apmensual').val(data.aportemensual);
                        $('#alquilermensual').val(data.alquilermensual);
                        $('#otrosingresos').val(data.otrosingresos);

                        if(data.genero == "M")
                        {
                            $("input[name=genero][value='M']").prop("checked",true);
                        }

                        if(data.genero == "F")
                        {
                            $("input[name=genero][value='F']").prop("checked",true);
                        }

                        //$('#pidmunicipio option:selected').val(data.idmunicipio);
                        //$('#pidmunicipio option:selected').text(data.nombre);
                        //$('#idnivel').val(data.idnivel);
                        //$('#periodo').val(data.periodo);

                        //$('#idpaisPA option:selected').val(data.idpais);
                        //$('#idpaisPA option:selected').text(data.nompais);

                        $('#inputTitle').html("Información general");
                        $('#formModal').modal('show');
                        $('#btnGuardar').val('update');
                        $('loading').modal('hide');
                    });
                });

                $("#btnGuardar").click(function(e){

                

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    var formData = {
                        identificacion: $("#identificacion").val(),
                        nit: $("#nit").val(),
                        nombre1: $("#nombre1").val(),           
                        nombre2: $("#nombre2").val(),
                        nombre3: $('#nombre3').val(),
                        apellido1: $('#apellido1').val(),
                        apellido2: $('#apellido2').val(),
                        apellido3: $('#apellido3').val(),

                        fechanac : $("#fechanac").val(),
                        estadocivil: $("#estadocivil").val(),
                        genero: $("#genero").val(),
                        dependientes: $("#dependientes").val(),
                        aportemensual: $("#aportemensual").val(),
                        vivienda: $("#vivienda").val(),
                        alquilermensual: $("#alquilermensual").val(),
                        otrosingresos: $("#otrosingresos").val(),
                        barriocolonia: $("#barriocolonia").val(),
                    };
                    
                    nivel=$("#idnivel option:selected").text();
                    var state=$("#btnGuardar").val();

                    var type;
                    var idacad=$('#iddg').val();
                    var my_url;

                    if (state == "update") 
                    {
                        type="PUT";
                        my_url = 'updatedgenerales/'+idacad;
                    }
                    if (state == "add") 
                    {
                        type="POST";
                        my_url = 'agregaracademico';
                    }
                    
                    var fingreso12=$("#fechaingreso").val();
                    var fsalida12=$("#fechasalida").val();

                    $.ajax({
                        type: type,
                        url: my_url,
                        data: formData,
                        dataType: 'json',

                        success: function (data) {
                            var item = '<tr class="even gradeA" id="persona'+data.identificacion+'">';
                                item +='<td>'+data.nombre1+data.nombre2+data.nombre3+'</td>'+'<td>' +data.establecimiento+ '</td>'+'<td>'+data.duracion+' '+data.periodo+'</td>'+'<td>'+nivel+'</td>'+'<td>'+fingreso12+'</td>'+'<td>'+fsalida12+'</td>';
                            if (state == "add")
                            {
                                $('#productsA').append(item);
                            }
                            if (state == "update")
                            {
                                $("#persona"+idacad).replaceWith(item);
                            }

                            $('#formAgregar').trigger("reset");
                            $('#formModal').modal('hide');
                            
                        },
                        error: function (data) {
                            $('#loading').modal('hide');
                            var errHTML="";
                            if((typeof data.responseJSON != 'undefined')){
                                for( var er in data.responseJSON){
                                    errHTML+="<li>"+data.responseJSON[er]+"</li>";
                                }
                            }else{
                                errHTML+='<li>Error</li>';
                            }
                            
                            $("#erroresContent").html(errHTML); 
                            $('#erroresModal').modal('show');
                        }
                    });
                });
            });
        </script>
@endsection

    