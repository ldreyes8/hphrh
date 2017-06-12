@extends('layouts.index')
@section('contenido')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-sm-12">
                   <!-- <h4 class=" m-t-0 header-title"><b>Bootstrap Carousel</b></h4>-->
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6">
                    @if (isset($tablero))
                        <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                            <ol class="carousel-indicators">
                                @for($i =0; $i<count($tablero); $i++)
                                    @if($i == 0)
                                        <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                    @else
                                        <li data-target="#carousel-example-captions" data-slide-to="' . $i . '"></li>
                                    @endif
                                @endfor
                          
                            </ol>
                            <div role="listbox" class="carousel-inner">
                                @for($i =0; $i<count($tablero); $i++)
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
</div>
@endsection
