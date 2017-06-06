<div class="tab-pane active" id="profile">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="dato_buscado" name="dato_buscado" onchange="buscarusuario();">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-flat" type="button" onclick="buscarusuario();" >Buscar!</button>
            </span>
        </div>
        
        <div><br><br></div>
        @if (isset($usuario))
            <div class="panel-heading">
                @foreach($usuario as $user)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        @if ($user->fotoperfil==="")
                            <img  src="{{asset('imagenes/avatar.jpg')}}" class="img-circle" alt="profile-image" width="75px" height ="75px" id="fotografia_usuario">
                            <div class="caption">
                                <h3>{{$user->name}}</h3>
                                <p>{{$user->email}}<br>{{$user->puesto}}<br>{{$user->afiliado}}<br>{{$user->celcorporativo}}<br></p>            
                            </div>
                        @else
                            <img  src="{{asset('fotografias/'.$user->fotoperfil)}}" class="img-circle" alt="profile-image" width="75px" height ="75px" id="fotografia_usuario">
                            <div class="caption">
                                <h3>{{$user->name}}</h3>
                                <p>{{$user->email}}<br>{{$user->puesto}}<br>{{$user->afiliado}}<br>{{$user->celcorporativo}}<br></p>            
                            </div>              
                        @endif
                    </div>    
                @endforeach
            </div>
            
            <?php
            echo str_replace('/?', '?', $usuario->render() )  ;
            ?>
            

        @endif
    
        <div class="row">

        @if (isset($usuario))
            <div>

            
            </div>

            @if(count($usuario)==0)
                <div class="box box-primary col-xs-12">
                    <div class='aprobado' style="margin-top:70px; text-align: center">
                        <label style='color:#177F6B'>
                            ... no se encontraron resultados para su busqueda...
                        </label>
                    </div>
                </div> 
            @endif
        @endif
        </div>
</div>
<script src="{{asset('assets/js/foto.js')}}"></script>
