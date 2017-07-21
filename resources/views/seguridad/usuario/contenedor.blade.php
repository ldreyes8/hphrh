@extends ('layouts.index')

        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />


@section ('contenido')
	 <div class="col-md-12 col-lg-12">
        <div class="">
            <div class="">
                <ul class="nav nav-tabs navtab-custom">
                
                    <li class="active"> <a href="javascript:void(0);" onclick="cargarusuario(1,1);"></a>
                    
                        <a href="#contentsecundario" data-toggle="tab" aria-expanded="false" >
                            <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                            <span class="hidden-xs">Registro Usuarios</span>
                        </a>
                    </li>
                    <!--
                    <li class="">
                        <a href="#settings" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-cog"></i></span>
                            <span class="hidden-xs">Ajustes</span>
                        </a>
                    </li>
                    -->
                   
                    <!--li class=""> <a href="javascript:void(0);" onclick="cargareventos(1,1);">
                        <a href="#otros" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-cog"></i></span>
                            <span class="hidden-xs">Crear un evento</span>
                        </a>
                    </li-->
                </ul>
                <div class="tab-content">
                
                    @include('seguridad.usuario.index')
                
                 </div>
            </div>
        </div>
    </div> <!-- end col -->
@endsection

@section('fin')
    @parent

    <script src="{{asset('assets/js/PanelControl/Usuario.js')}}"></script>
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>



    <script>cargarusuario(1);</script>
@endsection