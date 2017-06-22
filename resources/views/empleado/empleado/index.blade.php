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
                @foreach ($empleado as $em)
                <tr>
                    <td>{{$em->identificacion}}</td>
                    <td>{{$em->nit}}</td>
                    <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->nombre3.' '.$em->apellido1.' '.$em->apellido2.' '.$em->apellido3}}</td>
                    <td>{{$em->estadocivil}}</td>
                    <td>{{$em->afiliacionigss}}</td>
                    <td>{{$em->genero}}</td>
                    <td>{{$em->barriocolonia}}</td>
                    <td>{{$em->fechanac}}</td>
                    <td>{{$em->numerodependientes}}</td>
                    <td>{{$em->aportemensual}}</td>
                    <td>{{$em->vivienda}}</td>
                    
                </tr>
                @endforeach
            </table>
        </div>
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
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre1</label>
                                <input class="form-control" id="titulo" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre2</label>
                                <input class="form-control" id="titulo" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Nombre3</label>
                                <input class="form-control" id="titulo" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Apellido1</label>
                                <input class="form-control" id="titulo" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Apellido2</label>
                                <input class="form-control" id="titulo" name="titulo">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Apellido3</label>
                                <input class="form-control" id="titulo" name="titulo">
                            </div>
                        </div>                                          
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="barriocolonia">Dirección completa *</label>
                                <input type="text-area" maxlength="100" name="barriocolonia" id="barriocolonia" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                            <label>Genero</label>
                            <div class="form-group">
                                <label ><input type="radio" name="genero" value="M">Masculino</label>
                                <label ><input type="radio" name="genero" value="F">Femenino</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    <input type="hidden" name="idacad" id="idacad" value="0"/>
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
                $('#inputTitle').html("Agregar información personal");
                $('#formAgregar').trigger("reset");
                $('#btnGuardar').val('add');
                $('#formModal').modal('show');
            });
        });
        </script>
@endsection

    