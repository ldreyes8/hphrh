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
@endsection
@section ('contenido')
<!--
        <div class="parallax pattern-image">
            <img src="https://ununsplash.imgix.net/photo-1427434846691-47fc561d1179?fit=crop&fm=jpg&h=700&q=75&w=1050"/>
        </div>
        <div class="cover-image" style="background-image: url(https://unsplash.imgix.net/photo-1418065460487-3e41a6c84dc5?q=25&amp;fm=jpg&amp;s=127f3a3ccf4356b7f79594e05f6c840e);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="text-inverse">Heading</h1>
                        <p class="text-inverse">Lorem ipsum dolor sit amet, consectetur adipisici eli.</p>
                        <br>
                        <br>
                        <a class="btn btn-lg btn-primary">Click me</a>
                    </div>
                </div>
            </div>
        </div>
        -->
        <div class="col-sm-6">
                    <div class="card-box">
                        <div class="row"> 
                            <div class="col-md-12">
                                <h4 class=" m-t-0 header-title"><b>Noticias</b></h4>
                                @if (isset($tablero))
                                    <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                                        <ol class="carousel-indicators">
                                            @for($i =0; $i < count($tablero); $i++)
                                                @if($i == 0)
                                                    <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                                @else
                                                    <li data-target="#carousel-example-captions" data-slide-to="' . $i . '"></li>
                                                @endif
                                            @endfor 
                                        </ol>
                                        <div role="listbox" class="carousel-inner">
                                            @for($i =0; $i< count($tablero); $i++)
                                                @if($i == 0)
                                                    <div class="item active">
                                                @else
                                                    <div class="item">
                                                @endif
                                                        <img src="{{asset('tablero/'.$tablero[$i]->imagen)}}" alt="First slide image">
                                                        <div class="carousel-caption">
                                                            <h3 class="text-white font-600">{{$tablero[$i]->titulo}}</h3>
                                                            <p>{{$tablero[$i]->post}}</p>
                                                        </div>
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
<!--
                <div class="col-sm-6">
                    <div class="card-box">
                        <div class="row"> 
                            <div class="col-md-12">
                                <h4 class=" m-t-0 header-title"><b>Noticias</b></h4>
                                @if (isset($tablero))
                                    <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                                        <ol class="carousel-indicators">
                                            @for($i =0; $i < count($tablero); $i++)
                                                @if($i == 0)
                                                    <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                                @else
                                                    <li data-target="#carousel-example-captions" data-slide-to="' . $i . '"></li>
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
                                                            <p>{{$tablero[$i]->post}}</p>
                                                        </div>
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

                <div class="col-sm-6">
                    <div class="card-box">
                        <div class="row"> 
                            <div class="col-md-12">
                                <h4 class=" m-t-0 header-title"><b>Noticias</b></h4>
                                @if (isset($tablero))
                                    <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                                        <ol class="carousel-indicators">
                                            @for($i =0; $i < count($tablero); $i++)
                                                @if($i == 0)
                                                    <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                                @else
                                                    <li data-target="#carousel-example-captions" data-slide-to="' . $i . '"></li>
                                                @endif
                                            @endfor 
                                        </ol>
                                        <div role="listbox" class="carousel-inner">
                                            @for($i =0; $i< count($tablero); $i++)
                                                @if($i == 0)
                                                    <div class="item active">
                                                @else
                                                    <div class="item">
                                                @endif
                                                        <img src="{{asset('tablero/'.$tablero[$i]->imagen)}}" alt="First slide image">
                                                        <div class="carousel-caption">
                                                            <h3 class="text-white font-600">{{$tablero[$i]->titulo}}</h3>
                                                            <p>{{$tablero[$i]->post}}</p>
                                                        </div>
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
                -->
                <div class="row port">
                            <div class="portfolioContainer">
                                <div class="col-sm-6  col-md-6 webdesign illustrator">

              
                        <div class="col-md-12">
                            @if (isset($cumpledia))
                            <h4 class=" m-t-0 header-title"><b>H&aacute;bitat guatemala felicita a los cumpleañeros de este d&iacute;a.</b></h4>
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
                            @endif
                        </div>

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


