@extends ('layouts.index')

@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
    @endsection

@section ('contenido')

<div class="tab-pan active" id="contentsecundario">
    @if(isset($proyectos))
    @if(count($proyectos) > 0)
    <div class="box-header with-border my-box-header">
        <h4 class="box-title" align="center"><strong>Listado proyectos</strong></h4>
    </div>

    <hr style="border-color:black;" />
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div><br></div>
            <div class="margin" id="botones_control">
            @role('informatica')
                <button class="btn btn-success waves-effect waves-light" id="btn-nproyecto" title="nuevo proyecto">Nuevo <i class="fa fa-plus"></i></button>
                <!--<a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(4);">Agregar Usuarios</a>--> 
            @endrole
            </div>
            <div><br></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover"> 
                    <thead>
                        <th style= "width: 5%">Id</th>
                        <th style= "width: 20%">Proyecto</th>
                        <th style= "width: 20%">Monto</th>
                        <th >Descripción </th>
                        <th style= "width: 5%">Status</th>
                        <th style= "width: 5%">Saldo</th>
                        <th style= "width: 5%">Default</th>
                    </thead>

                    @foreach ($proyectos as $pro)
                    <tr>
                        <td>{{$pro->idproyecto}}</td>
                        <td>{{$pro->proyecto}}</td>
                        <td>{{$pro->monto}}</td>
                        <td>{{$pro->descripcion}}</td>
                        <td>{{$pro->status}}</td>
                        <td>{{$pro->saldo}}</td>
                        <td><input id="checkbox2" class="checkbox2" type="checkbox" value=""></td>       
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>           
    </div>
    @else
        <br/><div class='rechazado'><label style='color:#FA206A'>...No se ha encontrado ningun proyecto...</label>  </div> 
    @endif
    @endif
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
                        <div class="form-group">
                            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Nombre del proyecto</label>
                                <input type="text" id="fecha_inicio" class="form-control" name="fechainicio">                            
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label">Monto</label>
                                <input type="text" id="fecha_final" class="form-control" name="fechafin">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="numerodependientes">Descripción</label>
                                <textarea class="form-control" id="descripcion" rows="2"></textarea>
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


<input type="hidden" id="url_raiz_proyecto" value="{{ url("/") }}" />
<div id="capa_modal" class="div_modal" style="display: none;"></div>
<div id="capa_formularios" class="div_contenido" style="display: none;"></div>

@endsection

@section('fin')
    @parent

    <script type="text/javascript">
        $('#btn-nproyecto').click(function(){
            $('#inputTitle').html("Agregar proyecto");
            $('#formAgregar').trigger("reset");
            $('#btnGuardar').val('add');
            $('#formModal').modal('show');
        });
    </script>

    <script src="{{asset('assets/js/PanelControl/Usuario.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

@endsection