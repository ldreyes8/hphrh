@extends ('layouts.index')

@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Usuarios </h3>
		@include('seguridad.usuario.search')
	</div>   
</div>
<div class="row">
    <div class="margin" id="botones_control">
        @role('informatica')

        <a href="usuario/create" class="btn btn-xs btn-primary">Agregar Usuarios</a>
        <!--<a href="{{ url("/listado_usuarios") }}" class="btn btn-xs btn-primary" >Listado Usuarios</a> -->
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(2);">Roles</a> 
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formulario(3);" >Permisos</a>
        @endrole
    </div>
    <div><br></div>
</div>
<div class="row">
   <div class=class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
         <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover"> 
                <thead>
                    <th style="width: 5%">Id</th>
                    <th style="width: 20%">Nombre</th>
                    <th style="width: 20%">Email</th>
                    <th>Roles</th>
                    <th style="width: 5%">Opciones</th>
                </thead>
                @foreach ($usuarios as $usu)
                    <tr>
                        <td>{{$usu->id}}</td>
                        <td class="mailbox-messages mailbox-name"><a style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $usu->name  }}</a></td>
                        <td style="width: 20%s">{{$usu->email}}</td>
                        <td><span class="label label-success">
                        @foreach($usu->getRoles() as $roles)
                            {{  $roles.","  }}
                        @endforeach
                        </span></td>
                        <td style="width: 5%">
                            <button class="btn  btn-default btn-xs" onclick="verinfo_usuario({{$usu->id }})"><i class="fa fa-pencil"></i></button>
                            <a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal" class="on-default" remove-row"><i class="fa fa-trash-o danger"></i></a>
                        </td>                     
                    </tr>
                    @include('seguridad.usuario.modal')
                @endforeach
            </table>
         </div>
         {{$usuarios->render()}}
   </div>           
</div>

<div style="display: none;" id="cargador_empresa" align="center">
    <br>
    <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>
    <img src="{{ url('/img/cargando.gif') }}" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando tarea solicitada ...</label>
    <br>
    <hr style="color:#003" width="50%">
    <br>
</div>
<input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />

<div id="capa_modal" class="div_modal" style="display: none;"></div>
<div id="capa_formularios" class="div_contenido" style="display: none;"></div>
@endsection
@section('fin')
    @parent
    <script src="{{asset('assets/js/U.js')}}"></script>
@endsection