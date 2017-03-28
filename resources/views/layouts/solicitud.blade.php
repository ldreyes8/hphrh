<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Minton - Responsive Admin Dashboard Template</title>

        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />

        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">        
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/components.css')}}" rel="stylesheet" type="text/css">


        <link href="{{asset('assets/css/core.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet" type="text/css">

<!-- Datapicker Files  -->

        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />

        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-standalone.css')}}" rel="stylesheet" />

        
    </head>


    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <!-- -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.html" class="logo"><i class="md md-equalizer"></i> <span></span> </a>
                    </div>
                </div>

                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav hidden-xs">
                                <li><a href="#" class="waves-effect">Files</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">Projects <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Web design</a></li>
                                        <li><a href="#">Projects two</a></li>
                                        <li><a href="#">Graphic design</a></li>
                                        <li><a href="#">Projects four</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                 <input type="text" placeholder="Search..." class="form-control app-search-input">
                                 <a href=""><i class="fa fa-search"></i></a>
                            </form>

                            <ul class="nav navbar-nav navbar-right pull-right">

                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light"
                                       data-toggle="dropdown" aria-expanded="true">
                                        <i class="md md-notifications"></i> <span class="badge badge-xs badge-pink">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notification</li>
                                        <li class="list-group nicescroll notification-list">
                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-diamond noti-primary"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-cog noti-warning"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">New settings</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-bell-o noti-success"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Updates</h5>
                                                        <p class="m-0">
                                                            <small>There are <span class="text-primary">2</span> new
                                                                updates available
                                                            </small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                        </li>

                                        <li>
                                            <a href="javascript:void(0);" class=" text-right">
                                                <small><b>See all notifications</b></small>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i
                                            class="md md-settings"></i></a>
                                </li>

                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">                       
                        <div class="row">
                        {!!Form::open(array('url'=>'layouts','method'=>'POST','autocomplete'=>'off'))!!}
                        {{Form::token()}}
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card-box p-b-0">
                                    <h4 class="text-dark  header-title m-t-0">Solicitud de empleo</h4>
                                    <p class="text-muted m-b-25 font-13">
                                        Llene los campos.
                                    </p>

                                    <div id="progressbarwizard" class="pull-in">
                                        <ul>
                                            <li><a href="#generales" data-toggle="tab">Datos generales</a></li>
                                            <li><a href="#personales" data-toggle="tab">Datos personales</a></li>
                                            <li><a href="#academico" data-toggle="tab">Informacion academicos</a></li>
                                            <li><a href="#laboral" data-toggle="tab">Experiencia laboral</a></li>
                                            <li><a href="#familia" data-toggle="tab">Datos familiares</a></li>
                                            <li><a href="#referencia" data-toggle="tab">Referencias (No familiares)</a></li>
                                            <li><a href="#deudas" data-toggle="tab">Deudas</a></li>
                                            <li><a href="#padecimiento" data-toggle="tab">Padecimientos</a></li>
                                        </ul>

                                        <div class="tab-content bx-s-0 m-b-0">

                                            <div id="bar" class="progress progress-striped active">
                                                <div class="bar progress-bar progress-bar-primary"></div>
                                            </div>
                                        
                                            <!--Inicio de label y text y otros  -->
                                        <!--Datos personales  -->
                                            <div class="tab-pane p-t-10 fade" id="generales">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="identificacion">Identicación</label>
                                                        <input type="text" name="identificacion" required value="{{old('identificacion')}}" class="form-control" placeholder="Identificación...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="nombre1">Primer nombre</label>
                                                        <input type="text" name="nombre1" required value="{{old('nombre1')}}" class="form-control" placeholder="Primer nombre...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="nombre2">Segundo nombre</label>
                                                        <input type="text" name="nombre2" class="form-control" placeholder="Segundo nombre...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="nombre3">Tercer nombre</label>
                                                        <input type="text" name="nombre3" class="form-control" placeholder="Tercer nombre...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="apellido1">Primer apellido</label>
                                                        <input type="text" name="apellido1" required value="{{old('apellido1')}}" class="form-control" placeholder="Primer apellido...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="apellido2">Segundo apellido</label>
                                                        <input type="text" name="apellido2" required value="{{old('apellido2')}}" class="form-control" placeholder="Segundo apellido...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="apellido3">Apellido de casado(a)</label>
                                                        <input type="text" name="apellido3" class="form-control" placeholder="Apellido de casado...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="telefono">Telefono</label>
                                                        <input type="text" name="telefono" required value="{{old('telefono')}}" class="form-control" placeholder="Telefono...">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                        <label for="fechanac">Fecha de nacimiento</label>
                                                        <input type="text" class="form-control datepicker" name="fechanac" placeholder="Fecha de nacimiento...">
                                                    </div>
                                                </div>    
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                   <div class="form-group">
                                                        <label for="avenida">Avenida</label>
                                                        <input type="text" name="avenida" class="form-control" placeholder="Avenida...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                   <div class="form-group">
                                                        <label for="calle">Calle</label>
                                                        <input type="text" name="calle" class="form-control" placeholder="Calle...">
                                                    </div>
                                                </div> 
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                   <div class="form-group">
                                                        <label for="nomenclatura">Nomenclatura</label>
                                                        <input type="text" name="nomenclatura" class="form-control" placeholder="Nomenclatura...">
                                                    </div>
                                                </div> 
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                   <div class="form-group">
                                                        <label for="zona">Zona</label>
                                                        <input type="text" name="zona" class="form-control" placeholder="Zona...">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                   <div class="form-group">
                                                        <label for="barriocolonia">Barrio o colonia</label>
                                                        <input type="text" name="barriocolonia" class="form-control" placeholder="barriocolonia...">
                                                    </div>
                                                </div>          
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Departamento</label>
                                                        <select name="iddepartamento" id="iddepartamento" class="form-control selectpicker" data-live-search="true" data-style="btn-info">
                                                            @foreach($departamento as $depa)
                                                            <option value="{{$depa->iddepartamento}}">{{$depa->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>                                                
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Municipio</label>
                                                        {!! Form::select('idmunicipio',['placeholder'=>'Selecciona'],null,['id'=>'idmunicipio'])!!}
                                                    </div>
                                                </div>
                                            </div>
                                        <!--Datos empleado  -->
                                            <div class="tab-pane p-t-10 fade" id="personales">
                                                <div class="row">
                                                    
                                                </div>
                                            </div>                            
                                            <!--datos academicos --> 
                                            <div class="tab-pane p-t-10 fade" id="academico">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <label class="col-lg-2 control-label" for="name1"> First name *</label>
                                                    <div class="col-lg-10">
                                                        <input id="name1" name="name" type="text" class="required form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label class="col-lg-2 control-label " for="surname1"> Last name *</label>
                                                    <div class="col-lg-10">
                                                        <input id="surname1" name="surname" type="text" class="required form-control">

                                                    </div>
                                                </div>

                                                <div class="form-group clearfix">
                                                    <label class="col-lg-2 control-label " for="email1">Email *</label>
                                                    <div class="col-lg-10">
                                                        <input id="email1" name="email" type="text" class="required email form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!--Datos experiencia-->
                                            <div class="tab-pane p-t-10 fade" id="laboral">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <div class="col-lg-12">
                                                        <div class="checkbox checkbox-primary">
                                                        <input id="checkbox-h1" type="checkbox">
                                                            <label for="checkbox-h1">
                                                                este es una experiencia.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!--Datos familia -->
                                            <div class="tab-pane p-t-10 fade" id="familia">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <div class="col-lg-12">
                                                        <div class="checkbox checkbox-primary">
                                                        <input id="checkbox-h1" type="checkbox">
                                                            <label for="checkbox-h1">
                                                                esta es una familia.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!--Datos referencia -->
                                            <div class="tab-pane p-t-10 fade" id="referencia">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <div class="col-lg-12">
                                                        <div class="checkbox checkbox-primary">
                                                        <input id="checkbox-h1" type="checkbox">
                                                            <label for="checkbox-h1">
                                                                esta es una referencia.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!--Datos deudas -->
                                            <div class="tab-pane p-t-10 fade" id="deudas">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <div class="col-lg-12">
                                                        <div class="checkbox checkbox-primary">
                                                        <input id="checkbox-h1" type="checkbox">
                                                            <label for="checkbox-h1">
                                                                esta es una deuda.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!--Datos Padecimientos -->
                                            <div class="tab-pane p-t-10 fade" id="padecimiento">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <div class="col-lg-12">
                                                        <div class="checkbox checkbox-primary">
                                                        <input id="checkbox-h1" type="checkbox">
                                                            <label for="checkbox-h1">
                                                                esta es un padecimiento.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <ul class="pager m-b-0 wizard">
                                                <li class="previous first" style="display:none;"><a href="#">First</a>
                                                </li>
                                                <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light">Previous</a></li>
                                                <li class="next last" style="display:none;"><a href="#">Last</a></li>
                                                <li class="next"><a href="#" class="btn btn-primary waves-effect waves-light">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!!Form::close()!!}
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <footer class="footer text-right">
                    2017 © Habitat para la humanidad.
                </footer>
               <!-- End FOOTER -->
            </div>
        </div>

        
            
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/detect.js')}}"></script>
        <script src="{{asset('assets/js/fastclick.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('assets/js/waves.js')}}"></script>
        <script src="{{asset('assets/js/wow.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>
        <script src="{{asset('assets/plugins/switchery/switchery.min.js')}}"></script>

        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>


        <!-- Form wizard -->
        <script src="{{asset('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js')}}"></script>
        <script src="{{asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js')}}"></script>
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

        <script src="{{asset('assets/js/jquery.core.js')}}"></script>
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#basicwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted'});

                $('#progressbarwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index+1;
                    var $percent = ($current/$total) * 100;
                    $('#progressbarwizard').find('.bar').css({width:$percent+'%'});
                },
                'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted'});

                $('#btnwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted','nextSelector': '.button-next', 'previousSelector': '.button-previous', 'firstSelector': '.button-first', 'lastSelector': '.button-last'});

                var $validator = $("#commentForm").validate({
                    rules: {
                        emailfield: {
                            required: true,
                            email: true,
                            minlength: 3
                        },
                        namefield: {
                            required: true,
                            minlength: 3
                        },
                        urlfield: {
                            required: true,
                            minlength: 3,
                            url: true
                        }
                    }
                });

                $('.datepicker').datepicker({
                    format: "yyyy/mm/dd",
                    language: "es",
                    autoclose: true
                    });


                $("#iddepartamento").change(event => {
                $.get(`towns/${event.target.value}`, function(res, sta){
                    $("#idmunicipio").empty();
                    res.forEach(element => {
                        $("#idmunicipio").append(`<option value=${element.idmunicipio}> ${element.nombre} </option>`);
                            });
                        });
                    });
                $('#rootwizard').bootstrapWizard({
                    'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted',
                    'onNext': function (tab, navigation, index) {
                        var $valid = $("#commentForm").valid();
                        if (!$valid) {
                            $validator.focusInvalid();
                            return false;
                        }
                    }
                });
            });

        </script>   
    </body>
</html>