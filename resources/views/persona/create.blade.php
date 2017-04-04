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


    <body class="fixed-left">
        
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
                    <div class="container" >                       
                        <div class="row">
                        {!!Form::open(array('url'=>'persona','method'=>'POST','autocomplete'=>'off','files'=>'true','enctype'=>'multipart/form_data'))!!}
                        {{Form::token()}}
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card-box p-b-0">
                                    <h4 class="text-dark  header-title m-t-0">Solicitud de empleo</h4>
                                    <h5 >Campos obligatorios *</h5>
                                    <p class="text-muted m-b-25 font-13">
                                        
                                    </p>

                                    <div id="progressbarwizard" class="pull-in">
                                        <ul>
                                            <li><a href="#generales" data-toggle="tab">Datos generales</a></li>
                                            <li><a href="#familia" data-toggle="tab">Datos familiares</a></li>
                                            <li><a href="#academico" data-toggle="tab">Informacion academicos</a></li>
                                            <li><a href="#laboral" data-toggle="tab">Experiencia laboral</a></li>
                                            <li><a href="#referencia" data-toggle="tab">Referencias(No familiares)</a></li>
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
                                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="identificacion">Identicación *</label>
                                                            <input type="text" name="identificacion" required value="{{old('identificacion')}}" maxlength="13" onkeypress="return valida(event)"  class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="nombre1">Primer nombre *</label>
                                                            <input type="text" name="nombre1" required value="{{old('nombre1')}}" class="form-control" onkeypress="return validaL(event)" maxlength="12">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="nombre2">Segundo nombre</label>
                                                            <input type="text" name="nombre2" class="form-control" onkeypress="return validaL(event)" maxlength="12">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="nombre3">Tercer nombre</label>
                                                            <input type="text" name="nombre3" class="form-control" onkeypress="return validaL(event)" maxlength="12">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="apellido1">Primer apellido *</label>
                                                            <input type="text" name="apellido1" required value="{{old('apellido1')}}" class="form-control" onkeypress="return validaL(event)" maxlength="15">
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
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="telefono">Telefono </label>
                                                            <input type="text" maxlength="8" name="telefono" onkeypress="return valida(event)" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="celular">Celular *</label>
                                                            <input type="text" maxlength="8" name="celular" required value="{{old('celular')}}" onkeypress="return valida(event)" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="fechanac">Fecha de nacimiento *</label>
                                                            <input id="dato1" type="text" class="form-control" name="fechanac">
                                                        </div>
                                                    </div>    
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                       <div class="form-group">
                                                            <label for="avenida">Avenida</label>
                                                            <input type="text"  name="avenida" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                       <div class="form-group">
                                                            <label for="calle">Calle</label>
                                                            <input type="text" name="calle" class="form-control">
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                       <div class="form-group">
                                                            <label for="nomenclatura">Nomenclatura</label>
                                                            <input type="text" name="nomenclatura" class="form-control">
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                       <div class="form-group">
                                                            <label for="zona">Zona</label>
                                                            <input type="text" maxlength="2" name="zona" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                       <div class="form-group">
                                                            <label for="barriocolonia">Barrio o colonia</label>
                                                            <input type="text-area" name="barriocolonia" class="form-control">
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
                                                            {!! Form::select('idmunicipio',['placeholder'=>'Selecciona'],null,['id'=>'idmunicipio','class'=>'form-control'])!!}
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                       <div class="form-group">
                                                            <label for="nit">Nit *</label>
                                                            <input type="text" name="nit" required value="{{old('nit')}}" class="form-control" maxlength="9">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="afiliacionigss">Afiliacion igss</label>
                                                            <input type="text" name="afiliacionigss" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="numerodependientes">Numero dependientes</label>
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
                                                    <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group" ></div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <label for="otrosingresos">Otros ingresos</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Q</i></span>
                                                            <input type="text" min="0" name="otrosingresos" class="form-control" onkeypress="return valida(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <label for="pretension">Pretension *</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Q</i></span>
                                                            <input type="text" onkeypress="return valida(event)" min="0" name="pretension" value="{{old('pretension')}}" class="form-control">
                                                            <span class="input-group-addon">.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Estado civil</label>
                                                            <select name="idcivil" class="form-control selectpicker" data-live-search="true">
                                                                @foreach($estadocivil as $cat)
                                                                    <option value="{{$cat->idcivil}}">{{$cat->estado}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>              
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Puesto</label>
                                                            <select name="idpuesto" class="form-control selectpicker" data-live-search="true">
                                                                @foreach($puestos as $cat)
                                                                    <option value="{{$cat->idpuesto}}">{{$cat->nombre}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>¿En qué afiliado le gustaría aplicar?</label>
                                                            <select name="idafiliado" class="form-control selectpicker" data-live-search="true">
                                                                @foreach($afiliados as $cat)
                                                                    <option value="{{$cat->idafiliado}}">{{$cat->nombre}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!--<div class="col-lg-4">                                        
                                                    <div class="col-lg-8">
                                                        <div class="card-box">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group ">
                                                                    <label >Datos ive</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>¿Usted es una persona expuesta publicamente?</label>
                                                                    <label ><input type="radio" name="ive" value="Si">Si</label>
                                                                    <label ><input type="radio" name="ive" value="No">No</label>
                                                                </div>
                                                            </div> 
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>¿Tiene ?</label>
                                                                    <label ><input type="radio" name="parientepolitico" value="Si">Si</label>
                                                                    <label ><input type="radio" name="parientepolitico" value="No">No</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                </div>
                                                <ul class="pager m-b-0 wizard">
                                                    <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light">Atras</a></li>
                                                    <li class="next"><a href="#" class="btn btn-primary waves-effect waves-light">Siguiente</a></li>
                                                </ul>
                                            </div>
                                        <!--Datos familia -->
                                            <div class="tab-pane p-t-10 fade" id="familia">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="nombref">Nombres de familiar *</label>
                                                            <input type="text" id="nombref" name="nombref" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="apellidof">Apellidos de familiar *</label>
                                                            <input type="text" id="apellidof" name="apellidof" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="edad">Edad</label>
                                                            <input type="number" min="1" max="110" id="edad" name="edad" class="form-control" onkeypress="return valida(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
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
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="ocupacion">Ocupacion</label>
                                                            <input type="text" id="ocupacion" name="ocupacion" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="telefonof">Telefono de familiar</label>
                                                            <input type="text" id="telefonof" name="telefonof" class="form-control" maxlength="8" onkeypress="return valida(event)">
                                                            <label class="radio-inline">LLamar en caso de emergencias </label>
                                                            <input type="checkbox" id="emergencia" name="emergencia" value="Si">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <label ></label>
                                                        <div class="form-group">
                                                            <button type="button" id="bt_add4" class="btn btn-primary">Agregar</button>
                                                        </div>                 
                                                    </div>
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                        <table id="detalle4" class="table table-striped table-bordered table-condensed table-hover">
                                                            <thead style="background-color:#A9D0F5">
                                                                <th>Nombre</th>
                                                                <th>Apellido</th>
                                                                <th>Edad</th>
                                                                <th>Telefono</th>
                                                                <th>Parentezco</th>
                                                                <th>Ocupacion</th>
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
                                                    <div class="col-lg-8">
                                                        <div class="card-box">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group ">
                                                                    <label for="">Datos Academicos</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="titulo">Titulo *</label>
                                                                    <input type="text" id="titulo" name="titulo" class="form-control" onkeypress="return validaL(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="establecimiento">Establecimiento *</label>
                                                                    <input type="text" name="establecimiento" id="establecimiento" class="form-control" onkeypress="return validaL(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="duracion">Duracion</label>
                                                                    <input type="text" name="duracion" id="duracion" class="form-control" onkeypress="return valida(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="nivel">Nivel</label>
                                                                    <input type="text" name="nivel" id="nivel" class="form-control" onkeypress="return validaL(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group ">
                                                                    <label for="fingreso">Fecha de ingreso</label>
                                                                    <input type="text" id="fingreso" onkeypress="return valida(event)" name="fingreso" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group ">
                                                                    <label for="fsalida">Fecha de salida</label>
                                                                    <input type="text" id="fsalida" onkeypress="return valida(event)" name="fsalida" class="form-control">
                                                                </div>
                                                            </div>      
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Departamento</label>
                                                                    <select name="iddepartamento1" id="iddepartamento1" class="form-control selectpicker" data-live-search="true" data-style="btn-info">
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
                                                        
                                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                <label ></label>
                                                                <div class="form-group">
                                                                    <button type="button" id="bt_add6" class="btn btn-primary">Agregar</button>
                                                                </div>                 
                                                            </div>
                                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                                <table id="detalle6" class="table table-striped table-bordered table-condensed table-hover">
                                                                    <thead>
                                                                        <th>Titulo</th>
                                                                        <th>Establecimiento</th>
                                                                        <th>Duracion</th>
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
                                                                    </tfoot>
                                                                    <tbody>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="card-box">  
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group ">
                                                                    <label for="">Idiomas que domina</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Idioma</label>
                                                                    <select name="ididioma" id="ididioma" class="form-control selectpicker" data-live-search="true" >
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
                                                                    <button type="button" id="bt_add7" class="btn btn-primary">+</button>
                                                                </div>                 
                                                            </div>
                                                            <div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
                                                                <table id="detalle7" class="table table-striped table-bordered table-condensed table-hover">
                                                                    <thead>
                                                                        <th>Idioma</th>
                                                                        <th>Nivel</th>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tfoot>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            
                                                        </div>
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
                                                            <input type="text" id="empresa" name="empresa" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="puesto">Puesto</label>
                                                            <input type="text" id="puesto" name="puesto" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="jefeinmediato">Jefe inmediato</label>
                                                            <input type="text" id="jefeinmediato" name="jefeinmediato" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="motivoretiro">Motivo de retiro</label>
                                                            <input type="text" id="motivoretiro" name="motivoretiro" class="form-control" onkeypress="return validaL(event)">
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
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="nombrer">Nombre completo *</label>
                                                            <input type="text" id="nombrer" name="nombrer" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="telefonor">Telefono *</label>
                                                            <input type="text" id="telefonor"  maxlength="8" name="telefonor" class="form-control" onkeypress="return valida(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="profesion">Profesion</label>
                                                            <input type="text" id="profesion" name="profesion" class="form-control" onkeypress="return validaL(event)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Tipo de referencia *</label>
                                                            <select name="tiporeferencia" id="tiporeferencia" class="form-control">
                                                                <option value="Personal">Personal</option>
                                                                <option value="Laboral">Laboral</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                        <label ></label>
                                                        <div class="form-group">
                                                            <button type="button" id="bt_add3" class="btn btn-primary">Agregar</button>
                                                        </div>                 
                                                    </div>
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                        <table id="detalle3" class="table table-striped table-bordered table-condensed table-hover">
                                                            <thead style="background-color:#A9D0F5">
                                                                <th>Nombre</th>
                                                                <th>Telefono</th>
                                                                <th>Profesion</th>
                                                                <th>Tipo referencia</th>
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
                                                                    <input type="text" id="nombre" name="nombre" class="form-control" onkeypress="return validaL(event)">
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
                                                            <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Tipo licencia</label>
                                                                    <select name="licencia" id="licencia" class="form-control selectpicker" data-live-search="true" >
                                                                        @foreach($licencia as $cat)
                                                                            <option value="{{$cat->idlicencia}}">{{$cat->tipolicencia}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="vigencia">Vigencia</label>
                                                                    <input type="text" id="vigencia" name="vigencia" maxlength="4" onkeypress="return valida(event)" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                <label ></label>
                                                                <div class="form-group">
                                                                    <button type="button" id="bt_add8" class="btn btn-primary">Agregar</button>
                                                                </div>                 
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group ">
                                                                    <h4>INFORMACIÓN REQUERIDA POR IVE</h4>
                                                                    <h6>Si tiene deudas con uno o varios acreedores por favor consignelo en el siguiente espacio, esta información es para cumplir con los requerimientos de IVE según la legislación actual y serán tratados confidencialmente.</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="acreedor">Acreedor</label>
                                                                    <input type="text" id="acreedor" name="acreedor" class="form-control" onkeypress="return validaL(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                                <label for="amortizacionmensual">Amortizacion mensual</label>
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
                                                            <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                                                                <label ></label>
                                                                <div class="form-group">
                                                                    <button type="button" id="bt_add2" class="btn btn-primary">Agregar</button>
                                                                </div>                 
                                                            </div>
                                                            <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>¿Usted es una persona expuesta publicamente?</label>
                                                                    <label ><input type="radio" name="ive" value="Si" onclick="Finiquito(this)">Si</label>
                                                                    <label ><input type="radio" name="ive" value="No" onclick="Finiquito(this)">No</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-4 col-sm-6 col-xs-12" id="Dfini" style="display: none;">
                                                                <div class="form-group">
                                                                    <label for="archivo">Finiquito</label>
                                                                    <input type="file" name="archivo" class="form-control">
                                                                </div>
                                                            </div> 
                                                            <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>¿Tiene algun pariente politico?</label>
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
                                                    <div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
                                                        <label for="montodeuda">Hago constar que toda la información consignada, es verídica y autorizo a Fundación Hábitat para la Humanidad, confirmar los datos indicados.</label>
                                                        <input type="checkbox" class="checkbox-danger" id="confirma" onchange="javascript:showContent()">
                                                    </div>

                                                            

                                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                                <label></label>
                                                                <table id="detalle" class="table table-striped table-bordered table-condensed table-hover">
                                                                    <thead style="background-color: #A9D0F5">
                                                                        <th>Nombre del padecimiento</th>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <th></th>
                                                                    </tfoot>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>

                                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                                <label></label>
                                                                <table id="detalle8" class="table table-striped table-bordered table-condensed table-hover">
                                                                    <thead style="background-color: #A9D0F5">
                                                                        <th class="col-lg-3">Licencia</th>
                                                                        <th class="col-lg-3">Vigencia</th>
                                                                        <th class="col-lg-6">-</th>
                                                                    </thead>
                                                                    <tfoot>
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
                                                                        <th>Acreedor</th>
                                                                        <th>Mensualidad</th>
                                                                        <th>Acreedor</th>
                                                                    </thead>
                                                                    <tfoot>
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
    <!--<script src="{{asset('assets/js/datos.js')}}"></script>-->


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

                $("#telefono").validate({rules:{}});

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
        //variables 
            var cont=0;
            var conts=0;
            var contss=0;
            var contsss=0;
            var contEx=0;
            var contAc=0;
            var contId=0;
            var contL=0;
            $("#gdr").hide();
        //confirmacion de formulario
            function showContent() {
                check = document.getElementById("confirma");
                if (check.checked) {
                    $("#gdr").show();
                }
                else {
                    $("#gdr").hide();
                }
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
                $("#puesto").val("");
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
                $("#nivel").val("");
                $("#fingreso").val("");
                $("#fsalida").val("");
            }
            function limpiar7()
            {
                $("#vigencia").val("");
            }
        //Funciones agregar
            function agregar1()
            {

                nombre=$("#nombre").val();

                if (nombre!="")
                {
                    var fila='<tr class="selected" id="fila'+cont+'"><td><input type="hidden" name="nombre[]" value="'+nombre+'">'+nombre+'</td>  </tr>';
                    cont++;
                    limpiar1();
                    //evaluar();
                    $('#detalle').append(fila);
                }
                else
                {
                    alert('Ingrese un padecimiento')
                }   
            }

            function agregar2()
            {
                acreedor=$("#acreedor").val();
                amortizacionmensual=$("#amortizacionmensual").val();
                montodeuda=$("#montodeuda").val();
                if (acreedor!="")
                {
                    var fila='<tr class="selected" id="fila'+conts+'"> <td><input type="hidden" name="acreedor[]" value="'+acreedor+'">'+acreedor+'</td> <td><input type="hidden" name="amortizacionmensual[]" value="'+amortizacionmensual+'">'+amortizacionmensual+'</td> <td><input type="hidden" name="montodeuda[]" value="'+montodeuda+'">'+montodeuda+'</td> </tr>';
                    conts++;
                    limpiar2();
                    $('#detalles').append(fila);
                }
                else
                {
                    alert('Campo acreedor requerido')
                }   
            }

            function agregar3()
            {

                nombrer=$("#nombrer").val();
                telefonor=$("#telefonor").val();
                profesion=$("#profesion").val();
                tiporeferencia=$("#tiporeferencia").val();
                //alert(tiporeferencia);

                if (nombrer!="")
                {
                    var fila='<tr class="selected" id="fila'+contss+'"> <td><input type="hidden" name="nombrer[]" value="'+nombrer+'">'+nombrer+'</td> <td><input type="hidden" name="telefonor[]" value="'+telefonor+'">'+telefonor+'</td> <td><input type="hidden" name="profesion[]" value="'+profesion+'">'+profesion+'</td> <td><input type="hidden" name="tiporeferencia[]" value="'+tiporeferencia+'">'+tiporeferencia+'</td> </tr>';
                    contss++;
                    limpiar3();
                    $('#detalle3').append(fila);
                }
                else
                {
                    alert('Existen campos obligatorios')
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
                //alert(emergencia);

                

                if (nombref!="")
                {
                    if ( $('#emergencia').is(':checked'))
                    {
                        var fila='<tr class="selected" id="fila'+contsss+'"> <td><input type="hidden" name="nombref[]" value="'+nombref+'">'+nombref+'</td> <td><input type="hidden" name="apellidof[]" value="'+apellidof+'">'+apellidof+'</td> <td><input type="hidden" name="edad[]" value="'+edad+'">'+edad+'</td> <td><input type="hidden" name="telefonof[]" value="'+telefonof+'">'+telefonof+'</td> <td><input type="hidden" name="parentezco[]" value="'+parentezco+'">'+parentezco+'</td> <td><input type="hidden" name="ocupacion[]" value="'+ocupacion+'">'+ocupacion+'</td> <td><input type="hidden" name="emergencia[]" value="'+emergencia+'">'+emrg+'</td> </tr>';
                    contsss++;
                    limpiar4();
                    $('#detalle4').append(fila);
                    }
                    else 
                    {
                        var fila='<tr class="selected" id="fila'+contsss+'"> <td><input type="hidden" name="nombref[]" value="'+nombref+'">'+nombref+'</td> <td><input type="hidden" name="apellidof[]" value="'+apellidof+'">'+apellidof+'</td> <td><input type="hidden" name="edad[]" value="'+edad+'">'+edad+'</td> <td><input type="hidden" name="telefonof[]" value="'+telefonof+'">'+telefonof+'</td> <td><input type="hidden" name="parentezco[]" value="'+parentezco+'">'+parentezco+'</td> <td><input type="hidden" name="ocupacion[]" value="'+ocupacion+'">'+ocupacion+'</td> <td><input type="hidden" name="emergencia[]" value="no">'+emr+'</td> </tr>';
                    contsss++;
                    limpiar4();
                    $('#detalle4').append(fila);
                    }
                }
                else
                {
                    alert('Existen campos obligatorios')
                }   
            }

            function agregar5()
            {
                empresa=$("#empresa").val();
                puesto=$("#puesto").val();
                jefeinmediato=$("#jefeinmediato").val();
                motivoretiro=$("#motivoretiro").val();
                ultimosalario=$("#ultimosalario").val();
                fingresoex=$("#fingresoex").val();
                fsalidaex=$("#fsalidaex").val();
                //alert(tiporeferencia);

                if (empresa!="")
                {
                    var fila='<tr class="selected" id="fila'+contEx+'"> <td><input type="hidden" name="empresa[]" value="'+empresa+'">'+empresa+'</td> <td><input type="hidden" name="puesto[]" value="'+puesto+'">'+puesto+'</td> <td><input type="hidden" name="jefeinmediato[]" value="'+jefeinmediato+'">'+jefeinmediato+'</td> <td><input type="hidden" name="motivoretiro[]" value="'+motivoretiro+'">'+motivoretiro+'</td> <td><input type="hidden" name="ultimosalario[]" value="'+ultimosalario+'">'+ultimosalario+'</td> <td><input type="hidden" name="fingresoex[]" value="'+fingresoex+'">'+fingresoex+'</td> <td><input type="hidden" name="fsalidaex[]" value="'+fsalidaex+'">'+fsalidaex+'</td> </tr>';
                    contEx++;
                    limpiar5();
                    $('#detalle5').append(fila);
                }
                else
                {
                    alert('Campos requerido')
                }   
            }

            function agregar6()
            {
                titulo=$("#titulo").val();
                establecimiento=$("#establecimiento").val();
                duracion=$("#duracion").val();
                nivel=$("#nivel").val();
                fingreso=$("#fingreso").val();
                fsalida=$("#fsalida").val();
                pidmunicipio=$("#pidmunicipio").val();
                municipio=$("#pidmunicipio option:selected").text();
                //pidmunicipio=$("#pidmunicipio option:selected").text();

                if (titulo!="")
                {
                    var fila='<tr class="selected" id="fila'+contAc+'"> <td><input type="hidden" name="titulo[]" value="'+titulo+'">'+titulo+'</td> <td><input type="hidden" name="establecimiento[]" value="'+establecimiento+'">'+establecimiento+'</td> <td><input type="hidden" name="duracion[]" value="'+duracion+'">'+duracion+'</td> <td><input type="hidden" name="nivel[]" value="'+nivel+'">'+nivel+'</td> <td><input type="hidden" name="fingreso[]" value="'+fingreso+'">'+fingreso+'</td> <td><input type="hidden" name="fsalida[]" value="'+fsalida+'">'+fsalida+'</td> <td><input type="hidden" name="pidmunicipio[]" value="'+pidmunicipio+'">'+municipio+'</td> </tr>';
                    contAc++;
                    limpiar6();
                    $('#detalle6').append(fila);
                }
                else
                {
                    alert('Ingrese un titulo')
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
                    var fila='<tr class="selected" id="fila'+contId+'"><td><input type="hidden" name="eidioma[]" value="'+idioma+'">'+idiomaTex+'</td> <td><input type="hidden" name="niveli[]" value="'+niveli+'">'+niveli+'</td> </tr>';
                    contId++;
                    $('#detalle7').append(fila);
                    //alert('valor seleccionado')
                }

            }
            function agregar8()
            {

                licencia=$("#licencia").val();
                licenciatex=$("#licencia option:selected").text();
                vigencia=$("#vigencia").val();
                if(vigencia!="")
                {
                    var fila='<tr class="selected" id="fila'+contL+'"><td><input type="hidden" name="licenciaid[]" value="'+licencia+'">'+licenciatex+'</td> <td><input type="hidden" name="vigencia[]" value="'+vigencia+'">'+vigencia+'</td> </tr>';
                    contL++;
                    limpiar7();
                    $('#detalle8').append(fila);
                }
                else
                {
                    alert('Campo vigencia obligatorio')
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
