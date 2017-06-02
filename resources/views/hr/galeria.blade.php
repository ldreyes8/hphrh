<div class="tab-pane active" id="profile">
    @if (isset($usuario))
                      <div class="panel-heading">

            @foreach($usuario as $user)
                @if ($user->fotoperfil==="")
  

                    <div class="col-sm-6 col-md-4">
                        <!--<li><a href="{{ url('/empleado/perfil')}}"><i class="md md-face-unlock"></i> Perfil</a></li>
                        -->
                        <img  src="{{asset('imagenes/avatar.jpg')}}" class="img-circle" alt="profile-image" width="75px" height ="75px" id="fotografia_usuario">
                        <div class="caption">
                            <h3>{{$user->name}}</h3>
                            <p>{{$user->email}}<br>{{$user->puesto}}<br>{{$user->afiliado}}<br>{{$user->celcorporativo}}<br></p>            
                        </div> 
                    </div>
                  
                @else
                    <div class="col-sm-6 col-md-4">
                   
                        <img  src="{{asset('fotografias/'.$user->fotoperfil)}}" class="img-circle" alt="profile-image" width="75px" height ="75px" id="fotografia_usuario">
                        <div class="caption">
                            <h3>{{$user->name}}</h3>
                            <p>{{$user->email}}<br>{{$user->puesto}}<br>{{$user->afiliado}}<br>{{$user->celcorporativo}}<br></p>            
                        </div>
                    </div>            
                @endif    
            @endforeach
            </div>
        @endif
        
                       
</div>
 