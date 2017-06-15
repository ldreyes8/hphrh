@extends('layouts.index')
@section('estilos')
    @parent
<style type="text/css">
    .cover .cover-image {
        z-index: -1;
        position: absolute;
        top: 0px;
        width: 100%;
        height: 100%;
  background-size: cover;
  background-position: center;
    }
    .cover .cover-image.background-image-fixed,
    .cover .cover-image.cover-image-fixed {
    background-attachment: fixed;
    }
    .cover {
    padding: 30px 15px;
      margin-bottom: 30px;
      color: inherit;
      background-color: #eeeeee;
      margin-bottom: 0px !important;
      padding: 0px 0px;
      background-color: transparent;
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-align-items: center;
      align-items: center;
      overflow: hidden;
      position: relative;
      min-height: 100%;
    }
</style>
    <link href="{{asset('assets/css/mockup1.css')}}" rel="stylesheet" type="text/css">

@endsection
@section ('contenido')

<div class="col-sm-12">
    <div class="card-box">
        <div class="row"> 
            <div class="col-md-12">
                @if (isset($tableroini))
                    <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                        <ol class="carousel-indicators">
                            @for($i =0; $i < count($tableroini); $i++)
                                @if($i == 0)
                                    <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                @else
                                    <li data-target="#carousel-example-captions" data-slide-to="' . $i . '"></li>
                                @endif
                            @endfor 
                        </ol>
                        <div role="listbox" class="carousel-inner">
                            @for($i =0; $i< count($tableroini); $i++)
                                @if($i == 0)
                                    <div class="item active">
                                @else
                                    <div class="item">
                                @endif
                                        <img src="{{asset('tablero/'.$tableroini[$i]->imagen)}}" alt="First slide image">
                                    </div>
                            @endfor
                        </div>
                        <a href="#carousel-example-captions" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a>
                        <a href="#carousel-example-captions" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-sm-6">
        <div class="card-box">
            <div class="row"> 
                <div class="col-md-12">
                    <h4 class=" m-t-0 header-title"><b>Noticias</b></h4>
                    @if (isset($tablero))
                        <div id="carousel-example-captions1" data-ride="carousel" class="carousel slide">
                            <ol class="carousel-indicators">
                                @for($i =0; $i < count($tablero); $i++)
                                    @if($i == 0)
                                        <li data-target="#carousel-example-captions1" data-slide-to="0" class="active"></li>
                                    @else
                                        <li data-target="#carousel-example-captions1" data-slide-to="' . $i . '"></li>
                                    @endif
                                @endfor 
                            </ol>
                            <div role="listbox" class="carousel-inner">
                                @for($i =0; $i < count($tablero); $i++)
                                    @if($i == 0)
                                        <div class="item active">
                                    @else
                                        <div class="item">
                                    @endif
                                            <img src="{{asset('tablero/'.$tablero[$i]->imagen)}}" alt="First slide image">
                                            <div class="carousel-caption">
                                                <h3 class="text-white font-600">{{$tablero[$i]->titulo}}</h3>
                                                
                                                <p>El programa Salud a mi Casa se enfoca en atender al sector más vulnerable de la población a través de soluciones de bajo costo que satisfacen las necesidades básicas de toda familia, éste se conforma por nuestro “kit saludable” que consta de; un filtro purificador de agua, una estufa mejorada libre de humo y la instalación de una letrina de pozo ventilado, los cuales contribuyen a la reducción de enfermedades respiratorias, gastrointestinales y contaminación del entorno, mejorando considerablemente la salud de todos los miembros de la familia.</p>
                                                <p align="right">www.habitatguate.org</p>
                                            </div>
                                        </div>
                                @endfor
                            </div>
                            <a href="#carousel-example-captions1" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a>
                            <a href="#carousel-example-captions1" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a>
                        </div>
                    @endif
                </div>       
            </div>
        </div>
    </div>
    <div class="row port">
        <div class="portfolioContainer">
            <div class="col-sm-6  col-md-6 webdesign illustrator">
                @if (isset($cumpledia))
                    <div class="col-md-12">
                        <!--<h4 class=" m-t-0 header-title"><b>H&aacute;bitat guatemala felicita a los cumpleañeros de este d&iacute;a.</b></h4>-->
                        <div class="panel-heading">
                            @foreach($cumpledia as $user)
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    @if ($user->fotoperfil==="")
                                        <img  src="{{asset('imagenes/avatar.jpg')}}" class="img-circle" alt="profile-image" width="70px" height ="70px" id="fotografia_usuario">
                                        <div class="caption">
                                            <h5>{{$user->nombre1.' '. $user->apellido1}}</h5>
                                        </div>
                                    @else
                                        <img  src="{{asset('fotografias/'.$user->fotoperfil)}}" class="img-circle" alt="profile-image" width="70px" height ="70px" id="fotografia_usuario">
                                        <div class="caption">
                                            <h4>{{$user->nombre1.' '. $user->apellido1}}</h4>
                                        </div>              
                                    @endif
                                </div>    
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="col-md-12">
                    <h4 class=" m-t-0 header-title"><b>H&aacute;bitat guatemala felicita a los cumpleañeros de este mes.</b></h4>
                    @if (isset($persona))
                        <div class="panel-heading">
                            @foreach($persona as $user)
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    @if ($user->fotoperfil==="")
                                        <img  src="{{asset('imagenes/avatar.jpg')}}" class="img-circle" alt="profile-image" width="60px" height ="60px" id="fotografia_usuario">
                                        <div class="caption">
                                            <h5>{{$user->nombre1.' '. $user->apellido1}}</h5>
                                        </div>
                                    @else
                                        <img  src="{{asset('fotografias/'.$user->fotoperfil)}}" class="img-circle" alt="profile-image" width="60px" height ="60px" id="fotografia_usuario">
                                        <div class="caption">
                                            <h5>{{$user->nombre1.' '. $user->apellido1}}</h5>
                                        </div>              
                                    @endif
                                </div>    
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
            


@endsection



