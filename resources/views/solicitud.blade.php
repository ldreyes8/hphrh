<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{asset('assets/images/logo.ico')}}">

        <title>Hábitat - Solicitud de Empleo</title>
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
        <link href="{{asset('assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />

        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">        
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/components.css')}}" rel="stylesheet" type="text/css">
        <!--<link href="{{asset('assets/css/bootstrap.min.css.map')}}" rel="stylesheet" type="text/css"> -->  
        <link href="{{asset('assets/css/core.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet" type="text/css">

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
                        <span>
                            <img src="{{asset('assets/images/Habitat/logoh.png')}}" alt="">
                        </span>
                    </div>
                </div>

                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            
                            <ul class="nav navbar-nav hidden-xs">
                                <li><a href="#" class="waves-effect">Hábitat para la Humanidad Guatemala </a></li>
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

                <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
                      <strong id="error"></strong>
                </div>
                    <div class="container" >                       
                        <div class="row">
{!!Form::open(array('url'=>'solicitud/ds','method'=>'POST','autocomplete'=>'off','files'=>'true','id'=>'form','onkeypress'=>'return anular(event)','enctype'=>'multipart/form_data'))!!}
{{Form::token()}}
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box p-b-0">
                <h4 class="text-dark  header-title m-t-0">Solicitud de empleo</h4>
                <h5 >Campos obligatorios *</h5>
                <p class="text-muted m-b-25 font-13"></p>

                <div class="text-success" id='result'>
                    @if(Session::has('message'))
                        {{Session::get('message')}}
                    @endif
                </div>

                <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
                      <strong id="error"></strong>
                </div>
                <div id="progressbarwizard" class="pull-in">
                    <ul>
                        <li><a href="#generales" data-toggle="tab">Datos generales</a></li>
                        <li><a href="#familia" data-toggle="tab">Datos famíliares</a></li>
                        <li><a href="#academico" data-toggle="tab">Información academicos</a></li>
                        <li><a href="#laboral" data-toggle="tab">Experiencia laboral</a></li>
                        <li><a href="#referencia" data-toggle="tab">Referencias</a></li>
                        <li><a href="#deudas" data-toggle="tab">Otros</a></li>
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
                                                    <input type="text" name="identificacion" id="identificacion" maxlength="13" onkeypress="return valida(event)" class="form-control">
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
                                                    <input type="text" name="nombre2" class="form-control" onkeypress="return validaL(event)" maxlength="15">
                                               </div>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="nombre3">Tercer nombre</label>
                                                    <input type="text" name="nombre3" class="form-control" onkeypress="return validaL(event)" maxlength="15">
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
                                                                <input type="text" name="apellido2" class="form-control" onkeypress="return validaL(event)" maxlength="15">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="apellido3">Apellido de casada</label>
                                                                <input type="text" name="apellido3" class="form-control" onkeypress="return validaL(event)" maxlength="15">
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
                                                                <input type="email" name="correo" maxlength="40" class="form-control">
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
                                                                <input type="text" id="nombref" name="nombref" maxlength="30" class="form-control" onkeypress="return validaL(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="apellidof">Apellidos de familiar *</label>
                                                                <input type="text" id="apellidof" name="apellidof" maxlength="30" class="form-control" onkeypress="return validaL(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="edad">Edad</label>
                                                                <input type="text" maxlength="3" id="edad" name="edad" class="form-control" onkeypress="return valida(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Parentezco</label>
                                                                <select name="parentezco" id="parentezco" class="form-control">
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
                                                                <input type="text" id="telefonof" name="telefonof" class="form-control" maxlength="8" onkeypress="return valida(event)">
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="ocupacion">Ocupación</label>
                                                                <input type="text" id="ocupacion" name="ocupacion" maxlength="40" class="form-control" onkeypress="return validaL(event)">
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
                                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                                        <div class="card-box">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group ">
                                                                    <label for="">Datos Academicos</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="titulo">Título *</label>
                                                                        <input type="text" id="titulo" name="titulo" maxlength="100" class="form-control" onkeypress="return validaL(event)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="establecimiento">Establecimiento *</label>
                                                                        <input type="text" name="establecimiento" maxlength="100" id="establecimiento" class="form-control" onkeypress="return validaL(event)">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                    <label for="duracion">Duración *</label>
                                                                    <div class="form-group">
                                                                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                                                            <input type="text" name="duracion" id="duracion" maxlength="3" class="form-control" onkeypress="return valida(event)">
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
                                                                        <select name="idnivel" id="idnivel" class="form-control selectpicker" data-live-search="true" >
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
                                                                        <input type="text" id="dato3" name="fsalida" class="form-control">
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                    <label>País de origen *</label>
                                                                    <div class="form-group">
                                                                        <select id="idpaisPA" name="idpaisPA" class="form-control selectpicker" data-live-search="true">
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
                                                                        <select name="iddepartamento1" id="iddepartamento1" class="form-control selectpicker" data-live-search="true" >
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
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="card-box">  
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group ">
                                                                    <label for="">Idiomas que domina</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Idioma</label>
                                                                    <select name="ididioma" id="ididioma" class="form-control select2" data-live-search="true" >
                                                                        @foreach($idiomas as $cat)
                                                                            <option value="{{$cat->ididioma}}">{{$cat->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Nivel</label>
                                                                    <select name="nivelI" id="niveli" class="form-control">
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
                                                            <input type="text" id="empresa" name="empresa" maxlength="100" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label >Puesto</label>
                                                            <input type="text" id="puesto5"  maxlength="50" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="jefeinmediato">Jefe inmediato</label>
                                                            <input type="text" id="jefeinmediato" name="jefeinmediato" maxlength="50" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="motivoretiro">Motivo de retiro</label>
                                                            <input type="text" id="motivoretiro" name="motivoretiro" maxlength="40" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <label for="ultimosalario">Ultimo salario</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Q</i></span>
                                                            <input type="text" id="ultimosalario" name="ultimosalario" class="form-control" onkeypress="return valida(event)">
                                                            <span class="input-group-addon">.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="fingresoex">Año de ingreso</label>
                                                            <input id="fingresoex" type="text" maxlength="4" class="form-control" name="fingresoex" onkeypress="return valida(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="fsalidaex">Año de salida</label>
                                                            <input id="fsalidaex" maxlength="4" type="text" class="form-control" name="fsalidaex" onkeypress="return valida(event)">
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
                                                                <input type="text" id="nombrer" name="nombrer" maxlength="70" class="form-control" onkeypress="return validaL(event)">
                                                            
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="telefonor">Teléfono *</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">502</i></span>
                                                                <input type="text" id="telefonor"  maxlength="8" name="telefonor" class="form-control" onkeypress="return valida(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                            <label for="profesion">Profesion</label>
                                                                <input type="text" id="profesion" name="profesion" maxlength="100" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <label>Tipo de referencia *</label>
                                                                <select name="tiporeferencia" id="tiporeferencia" class="form-control">
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
                                                                    <input type="text" id="nombre" name="nombre" maxlength="40" class="form-control" onkeypress="return validaL(event)">
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
                                                                    <input type="text" id="acreedor" name="acreedor" class="form-control" onkeypress="return validaL(event)">
                                                            </div>
                                                            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                                                                <label for="amortizacionmensual">Amortización mensual</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Q</i></span>
                                                                    <input type="text" min="0" id="amortizacionmensual" name="amortizacionmensual" class="form-control" onkeypress="return valida(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <label for="montodeuda">Monto deuda</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Q</i></span>
                                                                    <input type="text" min="0" id="montodeuda" name="montodeuda" class="form-control" onkeypress="return valida(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-md-4 col-sm-6 col-xs-12">
                                                                    <label for="motivodeuda">Motivo de Deuda</label>
                                                                    <input type="text" id="mdeuda" name="motivodeuda" maxlength="100" class="form-control" onkeypress="return validaL(event)">
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
                                                                        <input type="text" id="format" name="forma" class="form-control" onkeypress="return validaL(event)">
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
                                                                        <input type="text" id="motivofint" name="motivofin" class="form-control" onkeypress="return validaL(event)">
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
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/datapickerf.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/jquery.core.js')}}"></script>
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>

<script type="text/javascript">
    
      $(document).ready(function() {
                
                $('#bt_add1').click(function() {
                    agregar1();
                });

                $('#bt_add2').click(function() {
                    agregar2();
                });

                $('#bt_add3').click(function() {
                    agregar3();
                });

                $('#bt_add4').click(function() {
                    agregar4();
                });
                $('#bt_add5').click(function() {
                    agregar5();
                });
                $('#bt_add6').click(function() {
                    agregar6();
                });
                $('#bt_add7').click(function() {
                    agregar7();
                });
                $('#bt_add8').click(function() {
                    agregar8();
                });
                $('#bt_addTE').click(function() {
                    agregarTE();
                });
                $('#prs2').click(function() {
                    prs();
                });
                $('#bt_next').click(function() {
                    identificacion=$("#identificacion").val();
                    nombre1=$("#nombre1").val();
                    apellido1=$("#apellido1").val();
                    celular=$("#celular").val();
                    nit=$("#nit").val();
                    pretension=$("#pretension").val();
                    dato1=$("#dato1").val();   
                    idpaisPS=$("#idpaisPS").val();    
                    iddepartamento=$("#iddepartamento").val();
                    barriocolonia=$("#barriocolonia").val();       
                    puesto=$("#puesto").val();
                    afiliado=$("#afiliado").val();
                    if (identificacion!="" )
                        {  
                                           
                        }
                    else
                        {
                            alert('Su Identicación es requerida *');
                            return false;
                        }
                    
                    if (nombre1!="" )
                        {                     
                        }
                    else
                        {
                            alert('Almenos el primer nombre debe ingresar *');
                            return false;
                        }
                    if (apellido1!="")
                        {                     
                        }
                    else
                        {
                            alert('Almenos el primer apellido debe ingresar *');
                            return false;
                        }
                    if (celular!="")
                        {                     
                        }
                    else
                        {
                            alert('Celular, campo requerido *');
                            return false;
                        }
                    if (barriocolonia!="")
                        {                     
                        }
                    else
                        {
                            alert('Direción, campo obligatorio *');
                            return false;
                        }
                    if (dato1!="")
                        {                     
                        }
                    else
                        {
                            alert('Su fecha de nacimiento es requerida *');
                            return false;
                        }
                    if (pretension!="")
                        {                     
                        }
                    else
                        {
                            alert('Su pretensión salarial es requerida *');
                            return false;
                        }
                    if(puesto!="")
                    {
                        
                    }
                    else
                    {
                        alert('Debe seleccionar un puesto a aplicar');
                        return false;
                    }
                    if(afiliado!="")
                    {
                        
                    }
                    else
                    {
                        alert('Debe seleccionar un afiliado a aplicar');
                        return false;
                    }
                    if(idpaisPS!="")
                        {
                            if (idpaisPS == "73" ) 
                            {
                                if(iddepartamento!="1")
                                {
                                }
                                else
                                {
                                    alert('Departamento es un campo obligatorio *');
                                    return false;
                                }
                                if (nit!="")
                                    {                     
                                    }
                                else
                                    {
                                        alert('Nit es un campo obligatorio *');
                                        return false;
                                    }
                            }
                            else
                            {

                            }
                        }
                    else
                        {
                            alert('El pais es un compo obligatorio');
                            return false;
                        }
                });

               $("#form").submit(function(e)
                {
                    identificacion=$("#identificacion").val();
                    nombre1=$("#nombre1").val();
                    apellido1=$("#apellido1").val();
                    celular=$("#celular").val();
                    nit=$("#nit").val();
                    pretension=$("#pretension").val();
                    nom=$("#g-recaptcha-response").val();
                    idpaisPS=$("#idpaisPS").val();
                    iddepartamento=$("#iddepartamento").val();
                    barriocolonia=$("#barriocolonia").val();
                    puesto=$("#puesto").val();
                    afiliado=$("#afiliado").val();
                    if (identificacion!="" )
                        {  
                                           
                        }
                    else
                        {
                            alert('En Datos Generales existen campos obligatorios *');
                            return false;
                        }
                    if (nombre1!="" )
                        {                     
                        }
                    else
                        {
                            alert('En Datos Generales existen campos obligatorios *');
                            return false;
                        }
                    if (apellido1!="")
                        {                     
                        }
                    else
                        {
                            alert('En Datos Generales existen campos obligatorios *');
                            return false;
                        }
                    if (celular!="")
                        {                     
                        }
                    else
                        {
                            alert('En Datos Generales existen campos obligatorios *');
                            return false;
                        }
                    if (barriocolonia!="")
                        {                     
                        }
                    else
                        {
                            alert('En Datos Generales existen campos obligatorios *');
                            return false;
                        }
                    if (pretension!="")
                        {                     
                        }
                    else
                        {
                            alert('En Datos Generales existen campos obligatorios *');
                            return false;
                        }

                    if(puesto!="")
                    {
                        
                    }
                    else
                    {
                        alert('En Datos Generales existen campos obligatorios *');
                        return false;
                    }
                    if(afiliado!="")
                    {
                        
                    }
                    else
                    {
                        alert('En Datos Generales existen campos obligatorios *');
                        return false;
                    }
                    if(idpaisPS!="")
                        {
                            if (idpaisPS == "73") 
                            {
                                if(iddepartamento!="1")
                                {
                                }
                                else
                                {
                                    alert('Departamento es un campo obligatorio *');
                                    return false;
                                }
                                if (nit!="")
                                    {                     
                                    }
                                else
                                    {
                                        alert('Nit es un campo obligatorio *');
                                        return false;
                                    }
                            }
                            else
                            {
                                    
                            }
                        }
                    else
                        {
                            alert('En Datos Generales existen campos obligatorios *');
                            return false;
                        }

                    if (nom==false) 
                            {
                                alert('Campo No soy un robot es obligatorio *');
                                return false;
                            }
                    else
                        {
                            alert('Gracias por enviar su solicitud');

                        }                    
                });

                $('#basicwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted'});

                $('#progressbarwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index+1;
                    var $percent = ($current/$total) * 100;
                    $('#progressbarwizard').find('.bar').css({width:$percent+'%'});
                },
                'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted'});

                $('#btnwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted','nextSelector': '.button-next', 'previousSelector': '.button-previous', 'firstSelector': '.button-first', 'lastSelector': '.button-last'});
                
                
                var $validator = $("#form").validate({
                    rules: {
                        identificacion: {
                            required: true,
                            maxlength: 13
                        },
                        nombre1: {
                            required: true
                        },
                        apellido1: {
                            required: true
                        }
                    }
                });
                $('#rootwizard').bootstrapWizard({
                    'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted',
                    'onNext': function (tab, navigation, index) {
                        var $valid = $("#form").valid();
                        if (!$valid) {
                            $validator.focusInvalid();
                            return false;
                        }
                    }
                });
               
            });
        //variables 
            var cont=0;
            var conts=0;
            var contss=0;
            var contsss=0;
            var contEx=0;
            var contAc=0;
            var contId=0;
            var contL=0;
            var contTE=0;
            $("#gdr").hide();
        //confirmacion de formulario
            function showContent() {
                check = document.getElementById("confirma");
                nom=$("#g-recaptcha-response").val();
                if (check.checked) {
                    $("#gdr").show();
                }
                else {
                    $("#gdr").hide();
                }
            }

            function Fextra(elemento) {
                element = document.getElementById("Dextranjero");
                if (elemento.value=="Si") {
                    element.style.display='block';
                }
                else 
                { if (elemento.value=="No") {
                    element.style.display='none';
                }
                }
            }

            function anular(e) {
                  tecla = (document.all) ? e.keyCode : e.which;
                  return (tecla != 13);
             }

            function Finiquito(elemento) {
                element = document.getElementById("Dfini");
                if (elemento.value=="Si") {
                    element.style.display='block';
                }
                else 
                { if (elemento.value=="No") {
                    element.style.display='none';
                }
                }
            }
            function FPariente(elemento) {
                element = document.getElementById("Dpariente");
                if (elemento.value=="Si") {
                    element.style.display='block';
                }
                else 
                { if (elemento.value=="No") {
                    element.style.display='none';
                }
                }
            }
        //Departamento combo
            $("#iddepartamento").change(event => {
                $.get(`towns/${event.target.value}`, function(res, sta){
                    $("#idmunicipio").empty();
                    res.forEach(element => {
                        $("#idmunicipio").append(`<option value=${element.idmunicipio}> ${element.nombre} </option>`);
                            });
                        });
                    });

            $("#iddepartamento1").change(event => {
                $.get(`towns/${event.target.value}`, function(res, sta){
                    $("#pidmunicipio").empty();
                    res.forEach(element => {
                        $("#pidmunicipio").append(`<option value=${element.idmunicipio}> ${element.nombre} </option>`);
                            });
                        });
                    });
        //Validaciones Letras y numeros
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
            //Se utiliza para que el campo de texto solo acepte letras
            function validaL(e) {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toString();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ63";//Se define todo el abecedario que se quiere que se muestre.
                especiales = [8, 37, 39, 46, 9]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.
                tecla_especial = false
                for(var i in especiales) {
                    if(key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }
                if(letras.indexOf(tecla) == -1 && !tecla_especial){
                    //alert('Tecla no aceptada');
                    return false;
                  }
            }
        //Funciones Limpiar -->
            function limpiar1()
            {
                $("#nombre").val("");
            }

            function limpiar2()
            {
                $("#acreedor").val("");
                $("#amortizacionmensual").val("");
                $("#montodeuda").val("");
                $("#mdeuda").val("");
            }

            function limpiar3()
            {
                $("#nombrer").val("");
                $("#telefonor").val("");
                $("#profesion").val("");
            }
            function limpiar4()
            {
                $("#nombref").val("");
                $("#apellidof").val("");
                $("#edad").val("");
                $("#telefonof").val("");
                $("#ocupacion").val("");
                $("#emergencia").attr('checked', false);
            }

            function limpiar5()
            {
                $("#empresa").val("");
                $("#puesto5").val("");
                $("#jefeinmediato").val("");
                $("#motivoretiro").val("");
                $("#ultimosalario").val("");
                $("#fingresoex").val("");
                $("#fsalidaex").val("");
            }

            function limpiar6()
            {
                $("#titulo").val("");
                $("#establecimiento").val("");
                $("#duracion").val("");
                //$("#nivel").val("");
                $("#dato2").val("");
                $("#dato3").val("");
            }
            function limpiar7()
            {
                $("#vigencia").val("");
            }
            function limpiarTE()
            {
                $("#format").val("");
                $("#idpaist").val("");
                $("#motivofint").val("");
            }
        //Funciones agregar
            function prs()
            {

                nombre=$("#g-recaptcha-response").val();
                alert(nombre);/*
                if (nombre == true)
                {
                    alert('correcto');
                }*/
                if (nombre == false)
                {
                    alert('incorrecto');
                }//dd(nombre);
                else
                {
                    alert('bus');  
                    $("#gdr").show();

                }             
            }

            function agregar1()
            {

                nombre=$("#nombre").val();

                if (nombre!="")
                {
                    var filaP='<tr class="selected" id="filaP'+cont+'"><td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarP('+cont+');">X</button></td><td><input type="hidden" name="nombre[]" value="'+nombre+'">'+nombre+'</td>  </tr>';
                    cont++;
                    limpiar1();
                    //evaluar();
                    $('#detalle').append(filaP);
                }
                else
                {
                    alert('Ingrese un padecimiento')
                }   
            }

            function eliminarP(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaP" + index).remove();
                }
            }

            function agregar2()
            {
                acreedor=$("#acreedor").val();
                amortizacionmensual=$("#amortizacionmensual").val();
                montodeuda=$("#montodeuda").val();
                mdeuda=$("#mdeuda").val();
                if ((acreedor!="") && (amortizacionmensual!="") && (montodeuda!=""))
                {
                    var filaC='<tr class="selected" id="filaC'+conts+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarC('+conts+');">X</button></td> <td><input type="hidden" name="acreedor[]" value="'+acreedor+'">'+acreedor+'</td> <td><input type="hidden" name="amortizacionmensual[]" value="'+amortizacionmensual+'">'+amortizacionmensual+'</td> <td><input type="hidden" name="montodeuda[]" value="'+montodeuda+'">'+montodeuda+'</td> <td><input type="hidden" name="mdeuda[]" value="'+mdeuda+'">'+mdeuda+'</td> </tr>';
                    conts++;
                    limpiar2();
                    $('#detalles').append(filaC);
                }
                else
                {
                    alert('Si usted esta ingresando un Crédito, todos los campos son obligatorios')
                }   
            }

            function eliminarC(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaC" + index).remove();
                }
            }

            function agregar3()
            {

                nombrer=$("#nombrer").val();
                telefonor=$("#telefonor").val();
                profesion=$("#profesion").val();
                tiporeferencia=$("#tiporeferencia").val();
                //alert(tiporeferencia);

                if ((nombrer!="") && (telefonor!="") && (profesion!="") )
                {
                    var filaR='<tr class="selected" id="filaR'+contss+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarR('+contss+');">X</button></td> <td><input type="hidden" name="nombrer[]" value="'+nombrer+'">'+nombrer+'</td> <td><input type="hidden" name="telefonor[]" value="'+telefonor+'">'+telefonor+'</td> <td><input type="hidden" name="profesion[]" value="'+profesion+'">'+profesion+'</td> <td><input type="hidden" name="tiporeferencia[]" value="'+tiporeferencia+'">'+tiporeferencia+'</td> </tr>';
                    contss++;
                    limpiar3();
                    $('#detalle3').append(filaR);
                }
                else
                {
                    alert('Si esta ingresando una referencia, todos los campos son obligatorios')
                }   
            }

            function eliminarR(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaR" + index).remove();
                }
            }

            function agregar4()
            {
                nombref=$("#nombref").val();
                apellidof=$("#apellidof").val();
                edad=$("#edad").val();
                telefonof=$("#telefonof").val();
                parentezco=$("#parentezco").val();
                ocupacion=$("#ocupacion").val();
                emergencia=$("#emergencia").val();
                emr=("No");
                emrg=("Si");
                

                if ((nombref!="") && (apellidof!="") && (edad!=""))
                {
                    if ( ($('#emergencia').is(':checked')) && (telefonof!=""))
                    {
                        var filaF='<tr class="selected" id="filaF'+contsss+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarF('+contsss+');">X</button></td> <td><input type="hidden" name="nombref[]" value="'+nombref+'">'+nombref+'</td> <td><input type="hidden" name="apellidof[]" value="'+apellidof+'">'+apellidof+'</td> <td><input type="hidden" name="edad[]" value="'+edad+'">'+edad+'</td> <td><input type="hidden" name="telefonof[]" value="'+telefonof+'">'+telefonof+'</td> <td><input type="hidden" name="parentezco[]" value="'+parentezco+'">'+parentezco+'</td> <td><input type="hidden" name="ocupacion[]" value="'+ocupacion+'">'+ocupacion+'</td> <td><input type="hidden" name="emergencia[]" value="'+emergencia+'">'+emrg+'</td> </tr>';
                    contsss++;
                    limpiar4();
                    $('#detalle4').append(filaF);
                    }
                    else 
                    {
                        var filaF='<tr class="selected" id="filaF'+contsss+'"><td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarF('+contsss+');">X</button></td> <td><input type="hidden" name="nombref[]" value="'+nombref+'">'+nombref+'</td> <td><input type="hidden" name="apellidof[]" value="'+apellidof+'">'+apellidof+'</td> <td><input type="hidden" name="edad[]" value="'+edad+'">'+edad+'</td> <td><input type="hidden" name="telefonof[]" value="'+telefonof+'">'+telefonof+'</td> <td><input type="hidden" name="parentezco[]" value="'+parentezco+'">'+parentezco+'</td> <td><input type="hidden" name="ocupacion[]" value="'+ocupacion+'">'+ocupacion+'</td> <td><input type="hidden" name="emergencia[]" value="no">'+emr+'</td> </tr>';
                    contsss++;
                    limpiar4();
                    $('#detalle4').append(filaF);
                    }
                }
                else
                {
                    alert('Existen campos obligatorios');
                }   
            }
            function eliminarF(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaF" + index).remove();
                }
            }

            function agregar5()
            {
                empresa=$("#empresa").val();
                puesto=$("#puesto5").val();
                jefeinmediato=$("#jefeinmediato").val();
                motivoretiro=$("#motivoretiro").val();
                ultimosalario=$("#ultimosalario").val();
                fingresoex=$("#fingresoex").val();
                fsalidaex=$("#fsalidaex").val();

                if (empresa!="")
                {
                    var filaEl='<tr class="selected" id="filaEl'+contEx+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarEl('+contEx+');">X</button></td> <td><input type="hidden" name="empresa[]" value="'+empresa+'">'+empresa+'</td> <td><input type="hidden" name="puesto[]" value="'+puesto+'">'+puesto+'</td> <td><input type="hidden" name="jefeinmediato[]" value="'+jefeinmediato+'">'+jefeinmediato+'</td> <td><input type="hidden" name="motivoretiro[]" value="'+motivoretiro+'">'+motivoretiro+'</td> <td><input type="hidden" name="ultimosalario[]" value="'+ultimosalario+'">'+ultimosalario+'</td> <td><input type="hidden" name="fingresoex[]" value="'+fingresoex+'">'+fingresoex+'</td> <td><input type="hidden" name="fsalidaex[]" value="'+fsalidaex+'">'+fsalidaex+'</td> </tr>';
                    contEx++;
                    limpiar5();
                    $('#detalle5').append(filaEl);
                }
                else
                {
                    alert('Si esta agregando un Experiencia Laboral, todos los campos son obligatorios');
                }   
            }
            function eliminarEl(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaEl" + index).remove();
                }
            }

            function agregar6()
            {
                titulo=$("#titulo").val();
                establecimiento=$("#establecimiento").val();
                duracion=$("#duracion").val();
                periodo=$("#priodo").val();
                idnivels=$("#idnivel").val();
                idniveltx=$("#idnivel option:selected").text();

                fingreso=$("#dato2").val();
                fsalida=$("#dato3").val();

                fingresoDT=("00/00/0000");
                fsalidaDT=("00/00/0000");

                idpaisPA=$("#idpaisPA").val();
                iddepartamento1=$("#iddepartamento1").val();
                pidmunicipio=$("#pidmunicipio").val();
                municipio=$("#pidmunicipio option:selected").text();
                munid=("");
                if ((titulo!="") && (establecimiento!="") && (duracion!=""))
                {
                    if (fingreso!="" && fsalida!="") 
                    {
                        if (idpaisPA !="73") 
                        {
                                var filaA='<tr class="selected" id="filaA'+contAc+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarA('+contAc+');">X</button></td> <td><input type="hidden" name="titulo[]" value="'+titulo+'">'+titulo+'</td> <td><input type="hidden" name="establecimiento[]" value="'+establecimiento+'">'+establecimiento+'</td> <td><input type="hidden" name="duracion[]" value="'+duracion+'">'+duracion+'</td> <td><input type="hidden" name="periodo[]" value="'+periodo+'">'+periodo+'</td> <td><input type="hidden" name="nivelid[]" value="'+idnivels+'">'+idniveltx+'</td> <td><input type="hidden" name="fingreso[]" value="'+fingreso+'">'+fingreso+'</td> <td><input type="hidden" name="fsalida[]" value="'+fsalida+'">'+fsalida+'</td> <td><input type="hidden" name="pidmunicipio[]" value="'+munid+'"></td> <td><input type="hidden" name="idpaisPAAT[]" value="'+idpaisPA+'"></td> </tr>';
                                contAc++;
                                limpiar6();
                                $('#detalle6').append(filaA);
                        }
                        else
                        {
                            if(iddepartamento1!="1")
                            {
                                var fila='<tr class="selected" id="filaA'+contAc+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarA('+contAc+');">X</button></td> <td><input type="hidden" name="titulo[]" value="'+titulo+'">'+titulo+'</td> <td><input type="hidden" name="establecimiento[]" value="'+establecimiento+'">'+establecimiento+'</td> <td><input type="hidden" name="duracion[]" value="'+duracion+'">'+duracion+'</td> <td><input type="hidden" name="periodo[]" value="'+periodo+'">'+periodo+'</td> <td><input type="hidden" name="nivelid[]" value="'+idnivels+'">'+idniveltx+'</td> <td><input type="hidden" name="fingreso[]" value="'+fingreso+'">'+fingreso+'</td> <td><input type="hidden" name="fsalida[]" value="'+fsalida+'">'+fsalida+'</td> <td><input type="hidden" name="pidmunicipio[]" value="'+pidmunicipio+'">'+municipio+'</td> <td><input type="hidden" name="idpaisPAAT[]" value="'+idpaisPA+'"></td> </tr>';
                                contAc++;
                                limpiar6();
                                $('#detalle6').append(fila);
                            }
                            else
                            {
                                alert('Debe seleccionar almenos un departamento')
                            }
                        }
                    }
                    else
                    {
                        if (idpaisPA !="73") 
                        {
                                var filaA='<tr class="selected" id="filaA'+contAc+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarA('+contAc+');">X</button></td> <td><input type="hidden" name="titulo[]" value="'+titulo+'">'+titulo+'</td> <td><input type="hidden" name="establecimiento[]" value="'+establecimiento+'">'+establecimiento+'</td> <td><input type="hidden" name="duracion[]" value="'+duracion+'">'+duracion+'</td> <td><input type="hidden" name="periodo[]" value="'+periodo+'">'+periodo+'</td> <td><input type="hidden" name="nivelid[]" value="'+idnivels+'">'+idniveltx+'</td> <td><input type="hidden" name="fingreso[]" value="'+fingresoDT+'">'+fingresoDT+'</td> <td><input type="hidden" name="fsalida[]" value="'+fsalidaDT+'">'+fsalidaDT+'</td> <td><input type="hidden" name="pidmunicipio[]" value="'+munid+'"></td> <td><input type="hidden" name="idpaisPAAT[]" value="'+idpaisPA+'"></td> </tr>';
                                contAc++;
                                limpiar6();
                                $('#detalle6').append(filaA);
                        }
                        else
                        {
                            if(iddepartamento1!="1")
                            {
                                var filaA='<tr class="selected" id="filaA'+contAc+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarA('+contAc+');">X</button></td> <td><input type="hidden" name="titulo[]" value="'+titulo+'">'+titulo+'</td> <td><input type="hidden" name="establecimiento[]" value="'+establecimiento+'">'+establecimiento+'</td> <td><input type="hidden" name="duracion[]" value="'+duracion+'">'+duracion+'</td> <td><input type="hidden" name="periodo[]" value="'+periodo+'">'+periodo+'</td> <td><input type="hidden" name="nivelid[]" value="'+idnivels+'">'+idniveltx+'</td> <td><input type="hidden" name="fingreso[]" value="'+fingresoDT+'">'+fingresoDT+'</td> <td><input type="hidden" name="fsalida[]" value="'+fsalidaDT+'">'+fsalidaDT+'</td> <td><input type="hidden" name="pidmunicipio[]" value="'+pidmunicipio+'">'+municipio+'</td> <td><input type="hidden" name="idpaisPAAT[]" value="'+idpaisPA+'"></td> </tr>';
                                contAc++;
                                limpiar6();
                                $('#detalle6').append(filaA);
                            }
                            else
                            {
                                alert('Debe seleccionar almenos un departamento')
                            }
                        }
                    }
                }
                else
                {
                    alert('Revise los datos obligatorios')
                }   
            }
            function eliminarA(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaA" + index).remove();
                }
            }
            function agregar7()
            {

                idioma=$("#ididioma").val();
                idiomaTex=$("#ididioma option:selected").text();
                niveli=$("#niveli").val();
                if(!$('#niveli').val())
                {
                    alert('seleccione un nivel')
                }
                else
                {
                    var filaI='<tr class="selected" id="filaI'+contId+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarI('+contId+');">X</button></td> <td><input type="hidden" name="eidioma[]" value="'+idioma+'">'+idiomaTex+'</td> <td><input type="hidden" name="niveli[]" value="'+niveli+'">'+niveli+'</td> </tr>';
                    contId++;
                    $('#detalle7').append(filaI);
                }

            }
            function eliminarI(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaI" + index).remove();
                }
            }
            function agregar8()
            {

                licencia=$("#licenciaid").val();
                licenciatex=$("#licenciaid option:selected").text();
                vigencia=$("#vigencia").val();
                if(vigencia!="")
                {
                    var filaL='<tr class="selected" id="filaL'+contL+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarL('+contL+');">X</button></td> <td><input type="hidden" name="licenciape[]" value="'+licencia+'">'+licenciatex+'</td> <td><input type="hidden" name="vigencia[]" value="'+vigencia+'">'+vigencia+'</td> </tr>';
                    contL++;
                    limpiar7();
                    $('#detalle8').append(filaL);
                }
                else
                {
                    alert('Campo vigencia obligatorio')
                }
            }
            function eliminarL(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaL" + index).remove();
                }
            }

            function agregarTE()
            {
                formate=$("#format").val();
                paisid=$("#idpaist").val();
                finmotivo=$("#motivofint").val();
                paistext=$("#idpaist option:selected").text();
                
                if ((formate!="") && (finmotivo!="") && (paisid!=""))
                {
                    
                                var filaTE='<tr class="selected" id="filaTE'+contTE+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarTE('+contTE+');">X</button></td> <td><input type="hidden" name="formate[]" value="'+formate+'">'+formate+'</td> <td><input type="hidden" name="paisTe[]" value="'+paisid+'">'+paistext+'</td> <td><input type="hidden" name="finmotivo[]" value="'+finmotivo+'">'+finmotivo+'</td> </tr>';
                                contTE++;
                                limpiarTE();
                                $('#detalleTE').append(filaTE);   
                }
                else
                {
                    alert('Revise los datos obligatorios')
                }   
            }
            function eliminarTE(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaTE" + index).remove();
                }
            }

            function evaluar()
            {
                if (cont>0){
                    $("#guardar").show();
                }
                else{
                    $("#guardar").hide();
                }
            }
</script>
           
    </body>
</html>

