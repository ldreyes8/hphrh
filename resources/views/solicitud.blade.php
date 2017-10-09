<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{asset('assets/images/logo.ico')}}">

        <title>Hábitat - Solicitud de Empleo</title>
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
        <link href="{{asset('assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />

        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">        
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/components1.css')}}" rel="stylesheet" type="text/css">
        <!--<link href="{{asset('assets/css/bootstrap.min.css.map')}}" rel="stylesheet" type="text/css"> -->  
        <link href="{{asset('assets/css/core1.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/menu1.css')}}" rel="stylesheet" type="text/css">

    <!-- Sweet Alert css -->
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet"/>

    <!-- Datapicker Files  -->
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />

    </head>


    <body class="fixed-left" >
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <!-- -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="#" class="logo"></a>
                        
                    </div>
                </div>

                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            
                            <ul class="nav navbar-nav hidden-xs">
                                
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>

            <!-- ========== Left Sidebar Start ========== -->
            
            <!-- Left Sidebar End --> 

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->                      
            <div class="content-page">
            
                <!-- Start content -->
                <div class="content">
                    <!-- START carousel-->
                        <div id="carousel-example-captions-1" data-ride="carousel" class="carousel slide">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-captions-1" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-captions-1" data-slide-to="1"></li>
                                <li data-target="#carousel-example-captions-1" data-slide-to="2"></li>
                            </ol>
                            <div role="listbox" class="carousel-inner">
                                <div class="item active">
                                    <img src="assets/images/small/banner1.jpg" alt="First slide image">
                                </div>
                                <div class="item">
                                    <img src="assets/images/small/banner2.jpg" alt="Second slide image">
                                </div>
                                <div class="item">
                                    <img src="assets/images/small/banner3.jpg" alt="Third slide image">
                                </div>
                            </div>
                        </div>
                    <!-- END carousel-->

                <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
                      <strong id="error"></strong>
                </div>
                    <div class="container" >                       
                        <div class="row">
{!!Form::open(array('url'=>'solicitud/ds','method'=>'POST','autocomplete'=>'off','files'=>'true','id'=>'form','onkeypress'=>'return anular(event)','enctype'=>'multipart/form_data'))!!}
{{Form::token()}}
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box p-b-0 ">
                <h4 class="text-dark  header-title m-t-0"></h4>
                <h5 >Campos obligatorios *</h5>
                <p class="text-muted m-b-25 font-13"></p>

                

                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      {{Session::get('message')}}
                    </div>
                @endif

                <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
                      <strong id="error"></strong>
                </div>
                <div id="progressbarwizard" class="pull-in">
                    <ul >
                        <li ><a href="#generales" data-toggle="tab">Generales</a></li>
                        <li ><a href="#familia" data-toggle="tab">Famíliares</a></li>
                        <li ><a href="#academico" data-toggle="tab">Académicos</a></li>
                        <li ><a href="#laboral" data-toggle="tab">Laboral</a></li>
                        <li ><a href="#referencia" data-toggle="tab">Referencias</a></li>
                        <li ><a href="#deudas" data-toggle="tab">Otros</a></li>
                    </ul>

                    <div class="tab-content bx-s-0 m-b-0">
                        <div id="bar" class="progress progress-striped active">
                            <div class="bar progress-bar progress-bar-primary"></div>
                        </div> 
                        
                        <!--Inicio de label y text y otros  -->
                            <!--Datos personales  -->
                                <div class="tab-pane p-t-10 fade" id="generales">
                                    <div class="row" >
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>País de origen *</label>
                                                    <select name="idpaisPS" id="idpaisPS" class="form-control selectpicker" data-live-search="true">
                                                        <option value="" hidden>Seleccione</option>
                                                        @foreach($pais as $p)
                                                            <option value="{{$p->idpais}}">{{$p->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>                                                
                                            </div>

                                            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Tipo Documento</label>
                                                    <select name="iddocumento" class="form-control " data-live-search="true" data-style="btn-info">
                                                        @foreach($tdocumento as $depa)
                                                        <option value="{{$depa->iddocumento}}">{{$depa->documento}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>                                                
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                                                <label for="identificacion">Identicación *</label>
                                                <div class="form-group">
                                                    <input type="text" name="identificacion" id="identificacion" maxlength="13" onkeypress="return valida(event)" placeholder="No colocar espacios ni guiones" class="form-control">
                                                    <!--<div class="text-danger" id="error_identi">{{$errors->formulario->first('identificacion')}}</div>-->
                                                        @if($errors->has('identificacion'))
                                                            <span style="color: red;">{{$errors->first('identificacion')}}</span>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                           <div class="form-group">
                                                                <label for="nit">Nit </label>
                                                                <input type="text" name="nit" id="nit" class="form-control" maxlength="9">
                                                            </div>
                                                        </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                <label for="nombre1">Primer nombre *</label>
                                                <div class="form-group">
                                                    <input type="text" name="nombre1" id="nombre1" class="form-control" onkeypress="return validaL(event)"  maxlength="15" >
                                                    <!--<div class="text-danger" id="error_n1">{{$errors->formulario->first('nombre1')}}</div>-->
                                                    @if($errors->has('nombre1'))
                                                        <span style="color: red;">{{$errors->first('nombre1')}}</span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="nombre2">Segundo nombre</label>
                                                    <input type="text" id="nombre2" name="nombre2" class="form-control" onkeypress="return validaL(event)" maxlength="15">
                                               </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="nombre3">Tercer nombre</label>
                                                    <input type="text" id="nombre3" name="nombre3" class="form-control" onkeypress="return validaL(event)" maxlength="15">
                                                </div>
                                            </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="apellido1">Primer apellido *</label>
                                                                <input type="text" name="apellido1" id="apellido1" class="form-control" onkeypress="return validaL(event)" maxlength="15">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="apellido2">Segundo apellido</label>
                                                                <input type="text" id="apellido2" name="apellido2" class="form-control" onkeypress="return validaL(event)" maxlength="15">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="apellido3">Apellido de casada</label>
                                                                <input type="text" id="apellido3" name="apellido3" class="form-control" onkeypress="return validaL(event)" maxlength="15">
                                                            </div>
                                                        </div>
                                        </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <label>Genero</label>
                                                            <div class="form-group">
                                                                <label ><input type="radio" name="genero" value="M">Masculino</label>
                                                                <label ><input type="radio" name="genero" value="F">Femenino</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="telefono">Teléfono </label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">502</i></span>
                                                                <input type="text" maxlength="8" name="telefono" onkeypress="return valida(event)" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="celular">Celular *</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">502</i></span>
                                                                <input type="text" maxlength="8" name="celular" id="celular" onkeypress="return valida(event)" class="form-control">
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="fechanac">Fecha de nacimiento *</label>
                                                                <input id="dato1" type="text" class="form-control" name="fechanac">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
                                                           <div class="form-group">
                                                                <label for="barriocolonia">Dirección completa *</label>
                                                                <input type="text-area" maxlength="100" name="barriocolonia" id="barriocolonia" class="form-control">
                                                            </div>
                                                        </div>
                                                                                                                    
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">     
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Departamento </label>
                                                                <select name="iddepartamento" id="iddepartamento" class="form-control selectpicker" data-live-search="true">
                                                                    @foreach($departamento as $depa)
                                                                    <option value="{{$depa->iddepartamento}}">{{$depa->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>                                                
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Municipio</label>
                                                                {!! Form::select('idmunicipio',['placeholder'=>'Selecciona'],null,['id'=>'idmunicipio','class'=>'form-control'])!!}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Nacionalidad</label>
                                                                <select name="idnacionalidad" class="form-control " data-live-search="true" data-style="btn-info">
                                                                    @foreach($nacionalidad as $nac)
                                                                    <option value="{{$nac->idnacionalidad}}">{{$nac->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>                                                
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Etnia</label>
                                                                <select name="idetnia" class="form-control " data-live-search="true" data-style="btn-info">
                                                                    @foreach($etnia as $et)
                                                                    <option value="{{$et->idetnia}}">{{$et->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>                                                
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="afiliacionigss">Afiliacion igss</label>
                                                                <input type="text" name="afiliacionigss" class="form-control" maxlength="13">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Estado civil</label>
                                                                <select name="idcivil" class="form-control " data-live-search="true">
                                                                    @foreach($estadocivil as $cat)
                                                                        <option value="{{$cat->idcivil}}">{{$cat->estado}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="numerodependientes">Dependientes</label>
                                                                <input type="number" name="numerodependientes" min="0" class="form-control" onkeypress="return valida(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="aportemensual">Aporte mensual</label>
                                                                <input type="number" name="aportemensual" min="0" class="form-control" onkeypress="return valida(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Vivienda</label>
                                                                <select name="vivienda" class="form-control">
                                                                    <option value="casa propia">casa propia</option>
                                                                    <option value="vive con familiares">vive con familiares</option>
                                                                    <option value="Alquila">Alquila</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="alquilermensual">Alquiler mensual</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">Q</i></span>
                                                                <input type="text" min="0" name="alquilermensual" class="form-control" onkeypress="return valida(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="otrosingresos">Otros ingresos</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">Q</i></span>
                                                                <input type="text" min="0" name="otrosingresos" class="form-control" onkeypress="return valida(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="pretension">Pretensión *</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">Q</i></span>
                                                                <input type="text" onkeypress="return valida(event)" min="0" name="pretension" id="pretension" class="form-control" >
                                                                <span class="input-group-addon">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                           <div class="form-group">
                                                                <label for="correo">Email</label>
                                                                <input type="email" id="correo" name="correo" maxlength="40" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Puesto *</label>
                                                                <select name="idpuesto" id="puesto" class="form-control selectpicker" data-live-search="true">
                                                                <option value="" hidden>Seleccione</option>
                                                                    @foreach($puestos as $cat)
                                                                        <option value="{{$cat->idpuesto}}">{{$cat->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                            <label>¿En qué afiliado le gustaría aplicar?</label>
                                                            <div class="form-group">
                                                                
                                                                <select name="idafiliado" id="afiliado" class="form-control selectpicker" data-live-search="true" >
                                                                <option value="" hidden>Seleccione</option>
                                                                    @foreach($afiliados as $cat)
                                                                        <option value="{{$cat->idafiliado}}">{{$cat->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="pager m-b-0 wizard">
                                                    <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light">Atras</a></li>
                                                    <li class="next"><a href="#" class="btn btn-primary waves-effect waves-light" id="bt_next">Siguiente</a></li>
                                                </ul>
                                            </div>
                            <!--Datos familia -->
                                            <div class="tab-pane p-t-10 fade" id="familia">
                                                <div class="row">   
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="nombref">Nombres de familiar *</label>
                                                                <input type="text" id="nombref" maxlength="30" class="form-control" onkeypress="return validaL(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="apellidof">Apellidos de familiar *</label>
                                                                <input type="text" id="apellidof" maxlength="30" class="form-control" onkeypress="return validaL(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="edad">Edad</label>
                                                                <input type="text" maxlength="3" id="edad" class="form-control" onkeypress="return valida(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Parentesco</label>
                                                                <select id="parentezco" class="form-control">
                                                                    <option value="Padre">Padre</option>
                                                                    <option value="Madre">Madre</option>
                                                                    <option value="Hermano">Hermano</option>
                                                                    <option value="Conyuge">Conyuge</option>
                                                                    <option value="Hijo">Hijo(a)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="telefonof">Teléfono de familiar</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">502</i></span>
                                                                <input type="text" id="telefonof" class="form-control" maxlength="8" onkeypress="return valida(event)">
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="ocupacion">Ocupación</label>
                                                                <input type="text" id="ocupacion" maxlength="40" class="form-control" onkeypress="return validaL(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                            <label> <br> <br> <br> </label>
                                                             <input type="checkbox" id="emergencia"  value="Si">LLamar en caso de emergencias
                                                        </div>
                                                        <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                            <label ></label>
                                                            <div class="form-group">
                                                                <button type="button" id="bt_add4" class="btn btn-primary">Agregar</button>
                                                            </div>                 
                                                        </div>
                                                    </div>
                                                        
                                                        
                                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                            <table id="detalle4" class="table table-striped table-bordered table-condensed table-hover">
                                                                <thead style="background-color:#A9D0F5">
                                                                    <th style="width: 1%">Opciones</th>
                                                                    <th>Nombre</th>
                                                                    <th>Apellido</th>
                                                                    <th>Edad</th>
                                                                    <th>Teléfono</th>
                                                                    <th>Parentezco</th>
                                                                    <th>Ocupación</th>
                                                                    <th>Emergencias</th>
                                                                </thead>
                                                                <tfoot>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tfoot>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    
                                                </div>
                                                <ul class="pager m-b-0 wizard">
                                                    <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light">Atras</a></li>
                                                    <li class="next"><a href="#" class="btn btn-primary waves-effect waves-light">Siguiente</a></li>
                                                </ul>
                                            </div>
                            <!--Datos Acaemicos -->
                                            <div class="tab-pane p-t-10 fade" id="academico">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card-box">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <h4>DATOS ACADEMICOS</h4>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="titulo">Título *</label>
                                                                        <input type="text" id="titulo" maxlength="100" class="form-control" onkeypress="return validaL(event)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="establecimiento">Establecimiento *</label>
                                                                        <input type="text" maxlength="100" id="establecimiento" class="form-control" onkeypress="return validaL(event)">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <label for="duracion">Duración *</label>
                                                                    <div class="form-group">
                                                                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                                                            <input type="text" id="duracion" maxlength="3" class="form-control" onkeypress="return valida(event)">
                                                                        </div> 
                                                                        <div class="col-lg-7 col-md-4 col-sm-6 col-xs-12">
                                                                            <select id="priodo" class="form-control">
                                                                                <option value="Dia">Días</option>
                                                                                <option value="Mes">Mes</option>
                                                                                <option value="Año">Años</option>
                                                                            </select>  
                                                                        </div>
                                                                    </div>    
                                                                </div>
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <label for="nivel">Nivel</label>
                                                                    <div class="form-group">
                                                                        <select id="idnivel" class="form-control selectpicker" data-live-search="true" >
                                                                            @foreach($nivelacademico as $depa)
                                                                            <option value="{{$depa->idnivel}}">{{$depa->nombrena}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group ">
                                                                        <label >Fecha de ingreso</label>
                                                                        <input type="text" id="dato2" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group ">
                                                                        <label for="fsalida">Fecha de salida</label>
                                                                        <input type="text" id="dato3" class="form-control">
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                    <label>País de origen *</label>
                                                                    <div class="form-group">
                                                                        <select id="idpaisPA" class="form-control selectpicker" data-live-search="true">
                                                                            <option value="" hidden>Seleccione</option>
                                                                            @foreach($pais as $p)
                                                                                <option value="{{$p->idpais}}">{{$p->nombre}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>                                                
                                                                </div>     
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <label>Departamento *</label>
                                                                    <div class="form-group">
                                                                        <select id="iddepartamento1" class="form-control selectpicker" data-live-search="true" >
                                                                            @foreach($departamento as $depa)
                                                                            <option value="{{$depa->iddepartamento}}">{{$depa->nombre}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Municipio</label>
                                                                        {!! Form::select('pidmunicipio',['placeholder'=>'Selecciona'],null,['id'=>'pidmunicipio','class'=>'form-control']) !!}
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                                                    <label ></label>
                                                                    <div class="form-group">
                                                                        <button type="button" id="bt_add6" class="btn btn-primary">Agregar</button>
                                                                    </div>                 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div> <label><br><br></label> </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card-box">  
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <h4>IDIOMAS QUE DOMINA</h4>
                                                            </div>
                                                            <div class="col-lg-5 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Idioma</label>
                                                                    <select id="ididioma" class="form-control selectpicker" data-live-search="true" >
                                                                        @foreach($idiomas as $cat)
                                                                            <option value="{{$cat->ididioma}}">{{$cat->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Nivel</label>
                                                                    <select id="niveli" class="form-control">
                                                                        <option value="" selected="selected">Seleccione</option>
                                                                        <option value="Principiante">Principiante</option>
                                                                        <option value="Intermedio">Intermedio</option>
                                                                        <option value="Avanzado">Avanzado</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">
                                                                <label ></label>
                                                                <div class="form-group">
                                                                    <button type="button" id="bt_add7" class="btn btn-primary">Agregar</button>
                                                                </div>                 
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                    <div> <label><br><br></label> </div>
                                                    <div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
                                                        <table id="detalle6" class="table table-striped table-bordered table-condensed table-hover">
                                                            <thead>
                                                                <th style="width: 1%">Opciones</th>
                                                                <th>Título</th>
                                                                <th>Establecimiento</th>
                                                                <th>Duración</th>
                                                                <th>-</th>
                                                                <th>Nivel</th>
                                                                <th>Fecha de ingreso</th>
                                                                <th>Fecha de salida</th>
                                                                <th>Lugar cursado</th>
                                                            </thead>
                                                            <tfoot>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                            </tfoot>
                                                            <tbody>
                                                                        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
                                                        <table id="detalle7" class="table table-striped table-bordered table-condensed table-hover">
                                                            <thead>
                                                                <th style="width: 1%">Opciones</th>
                                                                <th>Idioma</th>
                                                                <th>Nivel</th>
                                                            </thead>
                                                            <tfoot>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                            </tfoot>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <ul class="pager m-b-0 wizard">
                                                    <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light">Atras</a></li>
                                                    <li class="next"><a href="#" class="btn btn-primary waves-effect waves-light">Siguiente</a></li>
                                                </ul>
                                            </div>
                            <!--Datos Experiencia -->
                                            <div class="tab-pane p-t-10 fade" id="laboral">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="empresa">Empresa</label>
                                                            <input type="text" id="empresa" maxlength="100" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label >Puesto</label>
                                                            <input type="text" id="puesto5" maxlength="50" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="jefeinmediato">Jefe inmediato</label>
                                                            <input type="text" id="jefeinmediato" maxlength="50" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="teljefeinmediato">Teléfono Jefe inmediato</label>
                                                            <input type="text" id="teljefeinmediato" maxlength="8" class="form-control" onkeypress="return valida(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="motivoretiro">Motivo de retiro</label>
                                                            <input type="text" id="motivoretiro" maxlength="40" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <label for="ultimosalario">Ultimo salario</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Q</i></span>
                                                            <input type="text" id="ultimosalario" class="form-control" onkeypress="return valida(event)">
                                                            <span class="input-group-addon">.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="fingresoex">Año de ingreso</label>
                                                            <input id="fingresoex" type="text" maxlength="4" class="form-control" onkeypress="return valida(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="fsalidaex">Año de salida</label>
                                                            <input id="fsalidaex" maxlength="4" type="text" class="form-control" onkeypress="return valida(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <label ></label>
                                                        <div class="form-group">
                                                            <button type="button" id="bt_add5" class="btn btn-primary">Agregar</button>
                                                        </div>                 
                                                    </div>
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                        <table id="detalle5" class="table table-striped table-bordered table-condensed table-hover">
                                                            <thead style="background-color:#A9D0F5">
                                                                <th style="width: 1%">Opciones</th>
                                                                <th>Empresa</th>
                                                                <th>Puesto</th>
                                                                <th>Jefe inmediato</th>
                                                                <th>Teléfono Jefe</th>
                                                                <th>Motivo retiro</th>
                                                                <th>Ultimo Salario</th>
                                                                <th>Ingreso</th>
                                                                <th>Salida</th>
                                                            </thead>
                                                            <tfoot>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                            </tfoot>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <ul class="pager m-b-0 wizard">
                                                    <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light">Atras</a></li>
                                                    <li class="next"><a href="#" class="btn btn-primary waves-effect waves-light">Siguiente</a></li>
                                                </ul>
                                            </div>
                            <!--Datos referencia -->
                                            <div class="tab-pane p-t-10 fade" id="referencia">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                            
                                                                <label for="nombrer">Nombre completo *</label>
                                                                <input type="text" id="nombrer" maxlength="70" class="form-control" onkeypress="return validaL(event)">
                                                            
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="telefonor">Teléfono *</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">502</i></span>
                                                                <input type="text" id="telefonor"  maxlength="8" class="form-control" onkeypress="return valida(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="profesion">Profesion</label>
                                                                <input type="text" id="profesion" maxlength="100" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <label>Tipo de referencia *</label>
                                                                <select id="tiporeferencia" class="form-control">
                                                                    <option value="Personal">Personal</option>
                                                                    <option value="Laboral">Laboral</option>
                                                                </select>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-1 col-xs-12">
                                                            <label> <br> <br> </label>
                                                                <button type="button" id="bt_add3" class="btn btn-primary">Agregar</button>   
                                                        </div>
                                                        <div> <label><br><br></label> </div>
                                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                            <table id="detalle3" class="table table-striped table-bordered table-condensed table-hover">
                                                                <thead style="background-color:#A9D0F5">
                                                                    <th style="width: 1%">Opciones</th>
                                                                    <th>Nombre</th>
                                                                    <th>Teléfono</th>
                                                                    <th>Profesion</th>
                                                                    <th>Tipo referencia</th>
                                                                </thead>
                                                                <tfoot>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tfoot>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="pager m-b-0 wizard">
                                                    <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light">Atras</a></li>
                                                    <li class="next"><a href="#" class="btn btn-primary waves-effect waves-light">Siguiente</a></li>
                                                </ul>
                                            </div>
                            <!--Datos varios -->
                                            <div class="tab-pane p-t-10 fade" id="deudas">
                                                <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group ">
                                                                    <h4>PADECIMENTOS:</h4>
                                                                    <h6>Ingrese los padecimientos que tenga o haya tenido en los últimos 6 meses.</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="nombre">Padecimiento</label>
                                                                    <input type="text" id="nombre" maxlength="40" class="form-control" onkeypress="return validaL(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                                <label ></label>
                                                                <div class="form-group">
                                                                    <button type="button" id="bt_add1" class="btn btn-primary">Agregar</button>
                                                                </div>                 
                                                            </div>
                                                        
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group ">
                                                                    <h4>LICENCIAS DE CONDUCIR:</h4>
                                                                    <h6>Ingrese las licencias que tenga vigente actualmente para los distintos tipo de vehículo</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Tipo licencia</label>
                                                                    <select  id="licenciaid" class="form-control selectpicker" data-live-search="true" >
                                                                        @foreach($licencia as $cat)
                                                                            <option value="{{$cat->idlicencia}}">{{$cat->tipolicencia}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label >Vigencia</label>
                                                                    <input type="text" id="vigencia"  maxlength="4" onkeypress="return valida(event)" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                <label ></label>
                                                                <div class="form-group">
                                                                    <button type="button" id="bt_add8" class="btn btn-primary">Agregar</button>
                                                                </div>                 
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <h4>INFORMACIÓN REQUERIDA POR IVE</h4>
                                                                    <h6>Si tiene deudas con uno o varios acreedores por favor consignelo en el siguiente espacio, esta información es para cumplir con los requerimientos de IVE según la legislación actual y serán tratados confidencialmente.</h6>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                    <label for="acreedor">Acreedor</label>
                                                                    <input type="text" id="acreedor" class="form-control" onkeypress="return validaL(event)">
                                                            </div>
                                                            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                                                                <label for="amortizacionmensual">Amortización mensual</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Q</i></span>
                                                                    <input type="text" min="0" id="amortizacionmensual" class="form-control" onkeypress="return valida(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <label for="montodeuda">Monto deuda</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Q</i></span>
                                                                    <input type="text" min="0" id="montodeuda" class="form-control" onkeypress="return valida(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-md-4 col-sm-6 col-xs-12">
                                                                    <label for="motivodeuda">Motivo de Deuda</label>
                                                                    <input type="text" id="mdeuda" maxlength="100" class="form-control" onkeypress="return validaL(event)">
                                                            </div>
                                                            <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                                <label ></label>
                                                                <div class="form-group">
                                                                    <button type="button" id="bt_add2" class="btn btn-primary">Agregar</button>
                                                                </div>                 
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>¿Usted es una persona expuesta políticamente?</label>
                                                                    <label ><input type="radio" name="ive" value="Si" onclick="Finiquito(this)">Si</label>
                                                                    <label ><input type="radio" name="ive" value="No" onclick="Finiquito(this)">No</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-4 col-sm-6 col-xs-12" id="Dfini" style="display: none;">
                                                                <div class="form-group">
                                                                    <label for="archivo">Finiquito</label>
                                                                    <input type="file" name="archivo" id="prs" class="form-control">
                                                                </div>
                                                            </div> 
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>¿Tiene algún pariente político?</label>
                                                                    <label ><input type="radio" name="parientepolitico" value="Si" onclick="FPariente(this)">Si</label>
                                                                    <label ><input type="radio" name="parientepolitico" value="No" onclick="FPariente(this)">No</label>
                                                                </div>
                                                            </div>
                                                            <div id="Dpariente" style="display: none;">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="nombrep">Nombre</label>
                                                                        <input type="text" name="nombrep" class="form-control" onkeypress="return validaL(event)">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="puestop">Puesto</label>
                                                                        <input type="text" name="puestop" class="form-control" onkeypress="return validaL(event)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="dependencia">Dependencia</label>
                                                                        <input type="text" name="dependencia" class="form-control" onkeypress="return validaL(event)">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>¿Ha trabajado en el extranjero?</label>
                                                                    <label ><input type="radio" name="trabajoext" value="Si" onclick="Fextra(this)">Si</label>
                                                                    <label ><input type="radio" name="trabajoext" value="No" checked onclick="Fextra(this)">No</label>
                                                                </div>
                                                            </div>
                                                            <div id="Dextranjero" style="display: none;">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="forma">En que forma</label>
                                                                        <input type="text" id="format" class="form-control" onkeypress="return validaL(event)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="idpais">País</label>
                                                                        <select id="idpaist" class="form-control selectpicker" data-live-search="true">
                                                                            <option value="" hidden>Seleccione</option>
                                                                            @foreach($pais as $p)
                                                                                <option value="{{$p->idpais}}">{{$p->nombre}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="motivofin">Motívo de finalización de la relación laboral en el extranjero</label>
                                                                        <input type="text" id="motivofint" class="form-control" onkeypress="return validaL(event)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                                    <label ></label>
                                                                    <div class="form-group">
                                                                        <button type="button" id="bt_addTE" class="btn btn-primary">Agregar</button>
                                                                    </div>                 
                                                                </div>
                                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                                    <label></label>
                                                                    <table id="detalleTE" class="table table-striped table-bordered table-condensed table-hover">
                                                                        <thead style="background-color: #A9D0F5">
                                                                            <th style="width: 1%">Opciones</th>
                                                                            <th>Forma en la que trabajo</th>
                                                                            <th>País en el que trabajo</th>
                                                                            <th>Motívo de finalización laboral</th>
                                                                        </thead>
                                                                        <tfoot>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tfoot>
                                                                        <tbody></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                                <label></label>
                                                                <table id="detalle" class="table table-striped table-bordered table-condensed table-hover">
                                                                    <thead style="background-color: #A9D0F5">
                                                                        <th style="width: 1%">Opciones</th>
                                                                        <th>Nombre del padecimiento</th>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tfoot>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>

                                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                                <label></label>
                                                                <table id="detalle8" class="table table-striped table-bordered table-condensed table-hover">
                                                                    <thead style="background-color: #A9D0F5">
                                                                        <th style="width: 1%">Opciones</th>
                                                                        <th style="width: 3%" class="col-lg-3">Licencia</th>
                                                                        <th class="col-lg-3">Vigencia</th>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tfoot>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                                <label></label>
                                                                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                                                    <thead style="background-color:#A9D0F5">
                                                                        <th style="width: 1%">Opciones</th>
                                                                        <th>Acreedor</th>
                                                                        <th>Mensualidad</th>
                                                                        <th>Acreedor</th>
                                                                        <th>Motivo</th>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tfoot>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    {!! Recaptcha::render() !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <label><h3>Hago constar que toda la información consignada, es verídica y autorizo a Fundación Hábitat para la Humanidad, confirmar los datos indicados.&nbsp;&nbsp;</h3></label>
                                                                <input type="checkbox" class="checkbox-danger" style="transform: scale(1.4);" id="confirma" onchange="javascript:showContent()">
                                                            </div>

                                                </div>
                                                <ul class="pager m-b-0 wizard">
                                                    <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light">Atras</a></li>
                                                    <li class="next"><button class="btn btn-primary waves-effect waves-light" id="gdr" type="submit">Enviar datos</button></li>
                                                </ul>
                                            </div>
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
                    2017 © Hábitat para la humanidad.
                </footer>

               <!-- End FOOTER -->
            </div>
        </div>

        <script>
            var resizefunc = [];
        </script>
        @section('fin')
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
    <!-- Form wizard -->
        <script src="{{asset('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js')}}"></script>
        <script src="{{asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/jquery.core.js')}}"></script>
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
    <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
        <script src="{{asset('assets/js/datos.js')}}"></script>
           
    </body>
</html>

