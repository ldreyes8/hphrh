@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />        
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css')}}" rel="stylesheet" type="text/css" media="screen">


@endsection
@section ('contenido')

<div class="row"> 
    
    <div class="col-lg-3 col-md-4">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Cambiar Fotografia</h3>
            </div>             
            <div id="notificacion_resul_fci"></div>
            <form  id="f_subir_imagen" name="f_subir_imagen" method="post"  action="updatefoto" class="formarchivo" enctype="multipart/form-data" >
                <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
                <input type="hidden" id="id" name="idusuario" value="{{Auth::user()->id}}">  
                <div class="text-center card-box">
                    <div class="member-card">
                        <div class="thumb-xl member-thumb m-b-10 center-block">
                            @if (Auth::user()->fotoperfil==="")
                                <img  src="{{asset('imagenes/avatar.jpg')}}" class="img-circle" alt="profile-image" width="100px" height ="100px" id="fotografiaus">
                            @else
                                <img  src="{{asset('fotografias/'.Auth::user()->fotoperfil)}}" class="img-circle" alt="profile-image" width="100px" height ="100px" id="fotografiaus">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" name="fotoperfil" class="archivo form-control" id="imagen" required><br /><br />
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm w-sm waves-effect m-t-10 waves-light">Guardar</button>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </form>
        </div>

        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title">Cambiar contraseña</h4>
            <div class="p-b-10">
            
                <div class="form-group">
                    <label for="exampleInputEmail1">Correo </label>
                    <input type="email" class="form-control" id="email" disabled name="email" placeholder="Entrar email" value="{{Auth::user()->email}}" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">contraseña</label>
                    <input type="password" class="form-control" id="password"  name="password" placeholder="Contraseña" required>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-2">
                        <button type="button" class="btn btn-primary" id="btnchangepassword">
                            Cambiar contraseña
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title">Contraseña Office</h4>
            <div class="p-b-10">
                <div class="form-group">
                    <input type="email" class="form-control" disabled value="{{$empleado2->observacion}}" >
                </div>
            </div>
        </div>-->

    </div> <!-- end col -->


    <div class="col-md-8 col-lg-9">
        <div class="">
            <div class="">
                <ul class="nav nav-tabs navtab-custom">
                <!--
                    <li class="">
                        <a href="#home" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                            <span class="hidden-xs">Sobre Mi</span>
                        </a>
                    </li>
                    -->
                    <li class="active"> <a href="javascript:void(0);" onclick="cargarpersona(1,1);">
                    
                        <a href="#profile" data-toggle="tab" aria-expanded="false" >
                            <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                            <span class="hidden-xs">Datos Generales</span>
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
                    <li class=""> <a href="javascript:void(0);" onclick="cargaracademico(1,1);">
                    
                        <a href="#academicos" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="md md-school"></i></span>
                            <span class="hidden-xs">Académico</span>
                        </a>
                    </li>
                   
                    <li class=""> <a href="javascript:void(0);" onclick="cargarfamilia(1,1);">

                        <a href="#familiares" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="md md-people"></i></span>
                            <span class="hidden-xs">Familia</span>
                        </a>
                    </li>
                    <li class=""> <a href="javascript:void(0);" onclick="cargarreferencia(1,1);">

                        <a href="#referencias" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="ion ion-clipboard"></i></span>
                            <span class="hidden-xs">Referencia</span>
                        </a>
                    </li>
                    <li class=""> <a href="javascript:void(0);" onclick="cargarcredito(1,1);">

                        <a href="#creditos" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="ion ion-calculator"></i></span>
                            <span class="hidden-xs">Créditos</span>
                        </a>
                    </li>
                    <li class=""> <a href="javascript:void(0);" onclick="cargarpadecimiento(1,1);">

                        <a href="#padecimientos" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-cog"></i></span>
                            <span class="hidden-xs">Padecimientos</span>
                        </a>
                    </li>
                    <li class=""> <a href="javascript:void(0);" onclick="cargarexperiencia(1,1);">

                        <a href="#experiencias" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="md md-play-install"></i></span>
                            <span class="hidden-xs">Experiencia</span>
                        </a>
                    </li>

                    <li class=""> <a href="javascript:void(0);" onclick="cargarotros(1,1);">

                        <a href="#otros" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-cog"></i></span>
                            <span class="hidden-xs">Otros</span>
                        </a>
                    </li>
                    <!--li class=""> <a href="javascript:void(0);" onclick="cargareventos(1,1);">
                        <a href="#otros" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-cog"></i></span>
                            <span class="hidden-xs">Crear un evento</span>
                        </a>
                    </li-->
                </ul>
                <div class="tab-content">
                
                    @include('hr.persona')
                
                    @include('hr.academico')
                    @include('hr.familia')
                    @include('hr.referencias')
                    @include('hr.credito')
                    @include('hr.padecimientos')
                    @include('hr.experiencia')
                    @include('hr.otros')
                   

                    <div class="modal fade" id="erroresModalPassword" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Errores</h4>
                          </div>

                          <div class="modal-body">
                            <ul style="list-style-type:circle" id="erroresContentPassword"></ul>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('assets/js/persona.js')}}"></script>
    <script src="{{asset('assets/js/academico.js')}}"></script>
    <script src="{{asset('assets/js/familia.js')}}"></script>
    <script src="{{asset('assets/js/referencia.js')}}"></script>
    <script src="{{asset('assets/js/credito.js')}}"></script>
    <script src="{{asset('assets/js/padecimiento.js')}}"></script>
    <script src="{{asset('assets/js/experiencia.js')}}"></script>
    <script src="{{asset('assets/js/otros.js')}}"></script>
   
    <script src="{{asset('assets/js/changepassword.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>

    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>
        <script src="{{asset('assets/js/foto.js')}}"></script>


    
    
    <script>cargarpersona(1);   </script>
    <script>cargaracademico(1); </script>
    <script>cargarfamilia(1);   </script>
    <script>cargarreferencia(1);   </script>
    <script>cargarcredito(1);   </script>
    <script>cargarpadecimiento(1);   </script>
    <script>cargarotros(1);   </script>
   
    <script>cargarexperiencia(1);   </script>
    


@endsection