<style type="text/css">

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem; }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem; }

    .p-0 {
        padding: 0 !important; }

    .pt-0,
    .py-0 {
        padding-top: 0 !important; }

    .pr-0,
    .px-0 {
        padding-right: 0 !important; }

    .pb-0,
    .py-0 {
        padding-bottom: 0 !important; }

    .pl-0,
    .px-0 {
        padding-left: 0 !important; }

    .p-1 {
        padding: 0.25rem !important; }

    .pt-1,
    .py-1 {
      padding-top: 0.25rem !important; }

    .pr-1,
    .px-1 {
      padding-right: 0.25rem !important; }

    .pb-1,
    .py-1 {
      padding-bottom: 0.25rem !important; }

    .pl-1,
    .px-1 {
      padding-left: 0.25rem !important; }

    .p-2 {
      padding: 0.5rem !important; }

    .pt-2,
    .py-2 {
      padding-top: 0.5rem !important; }

    .pr-2,
    .px-2 {
      padding-right: 0.5rem !important; }

    .pb-2,
    .py-2 {
      padding-bottom: 0.5rem !important; }

    .pl-2,
    .px-2 {
      padding-left: 0.5rem !important; }

    .p-3 {
      padding: 1rem !important; }

    .pt-3,
    .py-3 {
      padding-top: 1rem !important; }

    .pr-3,
    .px-3 {
      padding-right: 1rem !important; }

    .pb-3,
    .py-3 {
      padding-bottom: 1rem !important; }

    .pl-3,
    .px-3 {
      padding-left: 1rem !important; }

    .p-4 {
      padding: 1.5rem !important; }

    .pt-4,
    .py-4 {
      padding-top: 1.5rem !important; }

    .pr-4,
    .px-4 {
      padding-right: 1.5rem !important; }

    .pb-4,
    .py-4 {
      padding-bottom: 1.5rem !important; }

    .pl-4,
    .px-4 {
      padding-left: 1.5rem !important; }

    .p-5 {
      padding: 3rem !important; }

    .pt-5,
    .py-5 {
      padding-top: 3rem !important; }

    .pr-5,
    .px-5 {
      padding-right: 3rem !important; }

    .pb-5,
    .py-5 {
      padding-bottom: 3rem !important; }

    .pl-5,
    .px-5 {
      padding-left: 3rem !important; }

    .container1 {
      width: 100%;
      margin-right: auto;
      margin-left: auto;
      padding-right: 15px;
      padding-left: 15px; }
      @media (min-width: 576px) {
        .container1 {container1
          max-width: 540px; } }
      @media (min-width: 768px) {
        .container1 {
          max-width: 720px; } }
      @media (min-width: 992px) {
        .container1 {
          max-width: 960px; } }
      @media (min-width: 1200px) {
        .container1 {
          max-width: 1140px; } }

    .container1-fluid {
      width: 100%;
      width: 100%;
      margin-right: auto;
      margin-left: auto;
      padding-right: 15px;
      padding-left: 15px; }

    .row {
      display: flex;
      flex-wrap: wrap;
      margin-right: -15px;
      margin-left: -15px; }
</style>
<link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />

<button class="btn btn-success btn-md" onclick="cargarusuario(1,1);"><i class="fa fa-reply-all"></i></button>     
<!--<div class="py-5" style="background-image: url('{{asset('assets/images/fondo.jpg')}}');">-->
<div>
    <div class="container1">
        <div class="row">
            <div class="col-md-6" id="book">
                <div class="card">
                    <div class="card-body p-5">
                        <h3 class="pb-3">Crear usuario</h3>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('seguridad/usuario/store') }}" id="formagregarU">
                        {{Form::token()}}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-4 control-label">Nombre</label>
                                <div class="col-sm-7">
                                    <input id="usuario" type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" required autofocus placeholder="solera@gmail.com">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-4 control-label">Correo</label>
                                <div class="col-sm-7">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="ejemplo@gmail.com">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('identificacion') ? ' has-error' : '' }}">
                                <label for="empleado" class="col-sm-4 control-label">Identificacion empleado</label>
                                <div class="col-sm-7">
                                    <input id="identificacion" type="text" class="form-control" name="identificacion" value="{{ old('identificacion') }}" required>
                                    @if ($errors->has('identificacion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('identificacion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-sm-4 control-label">Contraseña</label>
                                <div class="col-sm-7">
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-sm-4 control-label">Confirmar Contraseña</label>
                                <div class="col-sm-7">
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required value="{{ old('password_confirmation') }}">
                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary" type="button" id="Gusuario">Guardar</button>
                                <button class="btn btn-danger"  type="reset">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--<div class="align-self-center col-md-6 text-white" style="background-image: url('{{asset('assets/images/fondo.jpg')}}');"> -->
            <div class="align-self-center col-md-6 text-white">
                <h1 class="text-center text-md-left display-3">Nuevo usuario</h1>
                <p class="lead"><strong>Ingreso de nombre</strong></p>
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
                <!-- The messages container -->
                <!--                <div id="erroresContent"></div>-->
                <ul style="list-style-type:circle" id="erroresContent"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    
    <!-- -->
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
    <!-- Parsleyjs -->
    <script type="text/javascript" src="{{asset('assets/plugins/parsleyjs/dist/parsley.js')}}"></script>

    <script type="text/javascript">
        $("#Gusuario").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            var formData = {
                usuario: $('#usuario').val(),
                password: $('#password').val(),
                email: $('#email').val(),
                identificacion: $('#identificacion').val(),
                password_confirmation: $('#password_confirmation').val(),
            };

            var urlraiz=$("#url_raiz_proyecto").val();
            var miurl=urlraiz+"/seguridad/usuario/store";
            
            $.ajax({
                type: 'POST',
                url: miurl,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    swal({
                        title: "Envio Correcto",
                        text: "Desea agregar otro usuario",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#FFFF00",
                        confirmButtonText: "Si",
                        cancelButtonText: "No",
                        closeOnConfirm: true,
                        closeOnCancel: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            $('#usuario').val("");
                            $('#password').val("");
                            $('#email').val("");
                            $('#identificacion').val("");
                            $('#password_confirmation').val("");
                            $('#formagregarU').trigger("reset");
                        } else {
                            cargarusuario(1,1);
                        }
                    });
                },
                error: function (data) {
                    var errHTML="";
                    if((typeof data.responseJSON != 'undefined')){
                        for( var er in data.responseJSON){
                            errHTML+="<li>"+data.responseJSON[er]+"</li>";
                        }
                    }else{
                        errHTML+='<li>Error al guardar el usuario.</li>';
                    }
                    $("#erroresContent").html(errHTML); 
                    $('#erroresModal').modal('show');  
                }
            });
        });
    </script>
 