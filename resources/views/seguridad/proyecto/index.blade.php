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
                <button class="btn btn-success waves-effect waves-light" id="bnt-nproyecto" title="nuevo proyecto">Nuevo <i class="fa fa-plus"></i></button>
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

<input type="hidden" id="url_raiz_proyecto" value="{{ url("/") }}" />
<div id="capa_modal" class="div_modal" style="display: none;"></div>
<div id="capa_formularios" class="div_contenido" style="display: none;"></div>

@endsection

@section('fin')
    @parent

    <script src="{{asset('assets/js/PanelControl/Usuario.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

@endsection