@extends ('layouts.index')
@section('estilos')
    @parent
    
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
@endsection
@section ('contenido')
        

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th style="width: 2%">Id</th>
                            <th style="width: 4%">Identificación</th>
                            <th style="width: 2%">Nit</th>
                            <th style="width: 25%">Nombre</th>
                            <th style="width: 5%">Afiliado </th>
                            <th style="width: 15%">Puesto </th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 42%">Opciones</th>
                        </thead>
                        @foreach ($empleados as $em)
                        <tr class="even gradeA">
                            <td>{{$em->idempleado}}
                                <input type="hidden" id="idempleado" class="idempleado" value="{{$em->idempleado}}">
                            </td>
                            <td>{{$em->identificacion}}</td>
                            <td>{{$em->nit}}</td>
                            <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                            <td>{{$em->afnombre}}</td>
                            <td>{{$em->puesto}}</td>
                            <td>{{$em->status}}
                                <input type="hidden" class="idstatus" value="{{$em->idstatus}}">
                            </td>
                            <td>
                                <!--a href="{{URL::action('RHEvaluciones@show',$em->identificacion)}}"><button class="btn btn-primary" title="Detalles"><i class="glyphicon glyphicon-zoom-in"></i></button></a-->
                                <button type="button" class="btn btn-success btnresult" id="resultado" value="{{$em->idempleado}}" title="Asignar Resultado"><i class="fa-calculator"></i></button>                                
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                 
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
                    <input type="hidden" id="idempleado" name="idempleado" value="">
                    <div class="form-group">
                        <label for="nombrer">Nombre completo *</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" >
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >                                   
                        <div class="form-group">
                            <label for="nota">Nota *</label>
                            <input type="text" id="nota"  maxlength="3" class="form-control" onkeypress="return valida(event)">
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12" >
                        <div class="form-group">
                            <label>Observacion</label>
                            <textarea maxlength="99" class="form-control" id="observacione" ></textarea>
                        </div>
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
    <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
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
            $(document).ready(function(){
                $('.btnresult').click(function(){
                    var idref=$(this).val();
                    var miurl="nombrelist";
                    $.get(miurl+'/'+ idref, function(data){
                        $('#nombre').val(data.nombre1+' '+data.nombre2+' '+data.apellido1+' '+data.apellido2);
                        //$('#nombre').val(data.nombre2);
                        //$('#nombre3').val(data.nombre3);
                    });
                    $('#inputTitle').html("Agregar nota de evaluación");
                    $('#formAgregar').trigger("reset");
                    $('#formModal').modal('show');
                    $('#idempleado').val(idref);
                });


                $("#btnGuardar").click(function(e){
                    var miurl="agregarnota";
                    
                    var formData = {
                        observacion: $("#observacione").val(),
                        idempleado: $("#idempleado").val(),
                        nota: $("#nota").val(),

                    };
                    console.log(formData);
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

                        success: function (data) {

                            swal({ 
                                title:"Envio correcto",
                                text: "Se ha agregado una nota a este empleado",
                                type: "success"
                            },
                            function(){
                                window.location.href="/empleado/resultados"
                            });
                
                            //$('#formModal').modal('hide');
                            
                        },
                        error: function (data) {
                            $('#loading').modal('hide');
                            var errHTML="";
                            if((typeof data.responseJSON != 'undefined')){
                                for( var er in data.responseJSON){
                                    errHTML+="<li>"+data.responseJSON[er]+"</li>";
                                }
                            }else{
                                errHTML+='<li>Error, en este momento no se puede ingresar la nota intente mas tarde.</li>';
                            }
                            $("#erroresContent").html(errHTML); 
                            $('#erroresModal').modal('show');
                        }
                    });
                });
              
            });
        </script>

@endsection