@extends ('layouts.index')

@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />        
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />




@endsection
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
        <input type="hidden" name="idempleado" id="idempleado" value="{{$empleado->idempleado}}">
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
                    <th>Alquiler mensual</th>
                    <th>Otros ingresos</th>
                </thead>
                <tbody id="per" name="per">
                    @if(isset($empleado))
                            <tr class="even gradeA" id="empleadoRH">
                                <td>{{$empleado->identificacion}}</td>
                                <td>{{$empleado->nit}}</td>
                                <td>{{$empleado->nombre1.' '.$empleado->nombre2.' '.$empleado->nombre3.' '.$empleado->apellido1.' '.$empleado->apellido2.' '.$empleado->apellido3}}</td>
                                <td>{{$empleado->estadocivil}}</td>
                                <td>{{$empleado->afiliacionigss}}</td>
                                    @if ($empleado->genero == "M")
                                        <td>Masculino</td>
                                    @endif

                                    @if ($empleado->genero == "F")
                                        <td>Femenino</td>
                                    @endif

                                <td>{{$empleado->barriocolonia}}</td>
                                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$empleado->fechanac)->format('d/m/Y')}}</td> 

                                <td>{{$empleado->numerodependientes}}</td>
                                <td>{{$empleado->aportemensual}}</td>
                                <td>{{$empleado->vivienda}}</td>
                                <td>{{$empleado->alquilermensual}}</td>
                                <td>{{$empleado->otrosingresos}}</td>
                    
                            </tr>                        
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="col-lg-12">
    <input type="hidden" name="" id="valgenero">
    <input type="hidden" name="idper" id="idper">
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="inputTitle"></h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="formAgregar">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <label for="identificacion">Identicación *</label>
                            <div class="form-group">
                                <input type="text" name="identificacion" id="identificacion" maxlength="13" class="form-control" onkeypress="return valida(event)">
                               
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="nit">Nit </label>
                                <input type="text" name="nit" id="nit" class="form-control" maxlength="9">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="nit">Afilación iggs</label>
                                <input type="text" name="afiliacionigss" id="afiliacionigss" class="form-control" maxlength="9">
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

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <label for="fechanac">Fecha de nacimiento *</label>
                            <div class="input-group">
                                <input id="fechanac" type="date" class="form-control" name="fechanac">
                                <span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span>


                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Estado civil</label>
                                <select name="idcivil" class="form-control" id="idcivil" data-live-search="true">
                                    @if (isset($estadocivil))
                                    @foreach($estadocivil as $cat)
                                        @if($cat->idcivil == $empleado->idcivil)                 
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
                                <label ><input type="radio" name="genero" value="M" id="genero">Masculino</label>
                                <label ><input type="radio" name="genero" value="F" id="genero">Femenino</label>
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
                                <select name="vivienda" id="vivienda" class="form-control">
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

        <script src="{{asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('assets/plugins/summernote/dist/summernote.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>       
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/conversion.js')}}"></script>
        <meta name="_token" content="{!! csrf_token() !!}" />

        <script>
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
            function anular(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                return (tecla != 13);
            }
            
            function anularEspacios(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                return (tecla == 8);
            }               

            //Se utiliza para que el campo de texto solo acepte letras
            function validaL(e) {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toString();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ63";//Se define todo el abecedario que se quiere que se muestre.
                especiales = [8, 37, 39, 46, 9]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.
                tecla_especial = false
                for(var i in especiales) {
                    if(key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }

                if(letras.indexOf(tecla) == -1 && !tecla_especial){
                //alert('Tecla no aceptada');
                    return false;
                }
            }

            jQuery(document).ready(function () {          
                $('#btnAgregar').click(function(){
                    //var idacad=$(this).val();
                    var miurl="listardgenerales";
                    $.get(miurl, function(data){
                        console.log(data);
                        $('#identificacion').val(data.identificacion);
                        $('#idper').val(data.identificacion);
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
                        $('#afiliacionigss').val(data.afiliacionigss);

                        if(data.genero == "M")
                        {
                            $("input[name=genero][value='M']").prop("checked",true);
                        }

                        if(data.genero == "F")
                        {
                            $("input[name=genero][value='F']").prop("checked",true);
                        }

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
                        idper: $("#idper").val(),
                        identificacion: $("#identificacion").val(),
                        nit: $("#nit").val(),
                        nombre1: $("#nombre1").val(),           
                        nombre2: $("#nombre2").val(),
                        nombre3: $('#nombre3').val(),
                        apellido1: $('#apellido1').val(),
                        apellido2: $('#apellido2').val(),
                        apellido3: $('#apellido3').val(),

                        fechanac : $("#fechanac").val(),
                        estadocivil: $("#idcivil").val(),
                        genero: $("#genero").val(),
                        dependientes: $("#dependientes").val(),
                        aportemensual: $("#apmensual").val(),
                        vivienda: $("#vivienda").val(),
                        alquilermensual: $("#alquilermensual").val(),
                        otrosingresos: $("#otrosingresos").val(),
                        barriocolonia: $("#barriocolonia").val(),
                        idempleado: $('#idempleado').val(),
                        afiliacionigss: $('#afiliacionigss').val(),
                    };
                    
                    nit = $('#nit').val();
                    nivel=$("#idnivel option:selected").text();
                    var idacad=$('#idempleado').val();
                    var identificacion=$('#identificacion').val();
                    var estadocivil= $("#idcivil option:selected").text();
                    var nombre2=$('#nombre2').val();
                    var nombre3=$('#nombre3').val();
                    var apellido2=$('#apellido2').val();
                    var apellido3=$('#apellido3').val();
                    var afiliacionigss = $('#afiliacionigss').val();
                    var numerodependientes = $('#dependientes').val();
                    var aportemensual = $('#apmensual').val();
                    var otrosingresos = $('#otrosingresos').val();
                    var genero = $('#genero').val();
                    var fechanac = $('#fechanac').val();
                    var vivienda=$("#vivienda").val();

                    if(genero == "M")
                    {
                        genero = "Masculino";
                    }
                    if(genero == "F")
                    {
                        genero = "Femenino";
                    }

                    var state=$("#btnGuardar").val();
                    var type;
                    var my_url;

                    if (state == "update") 
                    {
                        type="PUT";
                        my_url = 'updatedgenerales/'+idacad;
                    }

                    var fingreso12=$("#fechaingreso").val();
                    var fsalida12=$("#fechasalida").val();

                    $.ajax({
                        type: type,
                        url: my_url,
                        data: formData,
                        dataType: 'json',



              
                   success: function (data) {
                            var item  = '<tr class="even gradeA" id="empleado'+data.identificacion+'">';
                                item += '<td>'+identificacion+'</td>';
                                item += '<td>'+nit+'</td>';
                                item += '<td>'+data.nombre1+' '+nombre2+' '+nombre3+' '+data.apellido1+' '+apellido2+' '+apellido3+'</td>';
                                item += '<td>' +estadocivil+ '</td>'+'<td>'+afiliacionigss+'</td>'+'<td>'+genero+'</td>'+'<td>'+data.barriocolonia+'</td>'+'<td>'+fechanac+'</td>';
                                item += '<td>'+numerodependientes+'</td>';
                                item += '<td>'+aportemensual+'</td>';
                                item += '<td>'+vivienda+'</td><tr>';

                            if (state == "update")
                            {
                                $("#empleadoRH").replaceWith(item);
                                swal({ 
                                    title:"Envio correcto",
                                    text: "Se ha guardado sus datos correctamente",
                                    type: "success"
                                });
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

    