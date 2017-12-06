@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section ('contenido')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Confirmación de puesto</h3>
        <h5>Campos obligatorios *</h5>
    </div>
</div>
<div class="row">

        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Empleado</label>
                    <select name="idempleado" id="idempleado" class="form-control " data-live-search="true" data-style="btn-info">
                            <option value="{{$empleado->idempleado}}">{{$empleado->nombre1.' '.$empleado->nombre2.' '.$empleado->apellido1.' '.$empleado->apellido2}}</option>
                    </select>
                </div>                                                
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Afiliado al que aplica</label>
                    <select name="idafiliado" id="idafiliado" class="form-control selectpicker" data-live-search="true">
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
                    <select name="idpuesto" id="idpuesto" class="form-control selectpicker" data-live-search="true">
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
            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Caso</label>
                    <select name="idcaso" id="idcaso" class="form-control selectpicker" data-live-search="true" >
                        @foreach($caso as $co)
                            <option value="{{$co->idcaso}}">{{$co->nombre}}</option>
                        @endforeach
                    </select>
                </div>                                                
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                <label for="salario">Salario *</label>
                <div class="input-group">
                    <span class="input-group-addon">Q</i></span>
                    <input type="text" onkeypress="return valida(event)" min="0" name="salario" id="salario" class="form-control">
                </div>
                @if($errors->has('salario'))
                    <span style="color: red;">{{$errors->first('salario')}}</span>
                @endif
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha">Fecha *</label>
                    <input id="datof" type="text" class="form-control" onkeypress="mascaraData(this)">
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                <label for="salario">Codico L4</label>
                <div class="form-group">
                    <input type="text" name="l4" id="l4" class="form-control">
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha">No. de Cuenta</label>
                    <input id="ncuenta" type="text" class="form-control" name="ncuenta">
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
                        <tr>
                            <th>opciones</th>
                            <th>Jefe</th>
                            <th>Notifica</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="descripcion">Observaciones</label>
                <div class="form-group">
                    <textarea class="form-control" maxlength="100" id="descripcion" name="descripcion" placeholder=".........." rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary btnguardar" id="btnguardar">Guardar</button>
                    <a href=""><button class="btn btn-danger " id="btncancelar" type="button">Cancelar</button></a>
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
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".select2").select2();
                $('#bt_add1').click(function() {agregar7();});
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
                        var fila='<tr class="selected" id="fila'+contJI+'"><td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminar('+contJI+');">X</button></td><td><input type="hidden" id="idjefe" name="idjefes[]" value="'+idjefe+'">'+jefeTex+'</td> <td><input type="hidden" name="confirma[]" id="idchek" value="'+confirma+'">'+si+'</td> </tr>';
                        contJI++;
                        $('#detalle7').append(fila);
                        limpiar();
                        $("#btnguardar").show();
                    }
                    else
                    {
                        var fila='<tr class="selected" id="fila'+contJI+'"><td><button type="button" style="background-color:#E6E6E6"  class="btn " onclick="eliminar('+contJI+');">X</button></td><td><input type="hidden" id="idjefe" name="idjefes[]" value="'+idjefe+'">'+jefeTex+'</td> <td><input type="hidden" name="confirma[]" id="idchek" value="2">'+no+'</td> </tr>';
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
                $("#btnguardar").hide();
            }


            $(document).on('click','.btnguardar',function(e){
                var urlraiz=$("#url_raiz_proyecto").val();
                swal({
                        title: "¿Está seguro?",
                        text: "Usted confirmara a esta persona en un puesto",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#FFFF00",
                        confirmButtonText: "Si, enviar",
                        cancelButtonText: "No, cancelar",
                        closeOnConfirm: false,
                        closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        var itemsData=[];//listados/agregar
                        var miurl =urlraiz+"/empleado/nombraupdate";
                        
                        $('#detalle7 tr').each(function(){
                            var jefe = $(this).closest('tr').find('input[id="idjefe"]').val();
                            var notificar = $(this).closest('tr').find('input[id="idchek"]').val();
                            valor = new Array(jefe,notificar);
                            itemsData.push(valor);
                        });

                        var formData = {
                            idpuesto: $('#idpuesto').val(),
                            idempleado: $('#idempleado').val(),
                            fecha: $('#datof').val(),
                            salario: $('#salario').val(),
                            descripcion: $('#descripcion').val(),
                            idafiliado: $('#idafiliado').val(),
                            idcaso: $('#idcaso').val(),
                            ncuenta: $('#ncuenta').val(),
                            le4: $('#l4').val(),
                            items: itemsData,
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "POST",
                            url: miurl,
                            data: formData,
                            dataType: 'json',
                            //beforeSend: function(){ $f.data('locked', true);  // (2)
                            //},

                            success: function (data) {
                                swal({ 
                                    title:"Envio correcto",
                                    text: "Gracias",
                                    type: "success"
                                },
                               function(){
                                    window.location.href="/empleado/listadon1"
                                });                                
                            },
                            error: function (data) {
                                $('#loading').modal('hide');
                                var errHTML="";
                                if((typeof data.responseJSON != 'undefined')){
                                    for( var er in data.responseJSON){
                                        errHTML+="<li>"+data.responseJSON[er]+"</li>";
                                    }
                                }else{
                                    errHTML+='<li>Error...</li>';
                                }
                                swal({ 
                                    title:"Ups error",
                                    text: "Verifique campos",
                                    type: "error",
                                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                                    confirmButtonText: 'OK!'
                                },
                               function(){
                                    $("#erroresContent").html(errHTML); 
                                    $('#erroresModal').modal('show');
                                });  

                               
                            },
                            //complete: function(){ $f.data('locked', false);  // (3)
                            //}
                        }); 
                    }else {
                         swal("Cancelado", "No se ha guardado el registro :)", "error");
                    }
                });                            
            });

            function mascaraData(val) {
                var pass = val.value;
                var expr = /[0123456789]/;

                for (i = 0; i < pass.length; i++) {
                    var lchar = val.value.charAt(i);
                    var nchar = val.value.charAt(i + 1);

                    if (i == 0) {
                      if ((lchar.search(expr) != 0) || (lchar > 3)) {
                        val.value = "";
                      }

                    } else if (i == 1) {

                      if (lchar.search(expr) != 0) {
                        var tst1 = val.value.substring(0, (i));
                        val.value = tst1;
                        continue;
                      }

                      if ((nchar != '/') && (nchar != '')) {
                        var tst1 = val.value.substring(0, (i) + 1);

                        if (nchar.search(expr) != 0)
                          var tst2 = val.value.substring(i + 2, pass.length);
                        else
                          var tst2 = val.value.substring(i + 1, pass.length);

                        val.value = tst1 + '/' + tst2;
                      }

                    } else if (i == 4) {

                      if (lchar.search(expr) != 0) {
                        var tst1 = val.value.substring(0, (i));
                        val.value = tst1;
                        continue;
                      }

                      if ((nchar != '/') && (nchar != '')) {
                        var tst1 = val.value.substring(0, (i) + 1);

                        if (nchar.search(expr) != 0)
                          var tst2 = val.value.substring(i + 2, pass.length);
                        else
                          var tst2 = val.value.substring(i + 1, pass.length);

                        val.value = tst1 + '/' + tst2;
                      }
                    }

                    if (i >= 6) {
                        if (lchar.search(expr) != 0) {
                            var tst1 = val.value.substring(0, (i));
                            val.value = tst1;
                        }
                    }
                }

                if (pass.length > 10)
                    val.value = val.value.substring(0, 10);
                return true;
            }
        </script>
        
@endsection
