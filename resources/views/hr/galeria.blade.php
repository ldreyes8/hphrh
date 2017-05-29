<div class="tab-pane active" id="profile">
    @if (isset($usuario))
                      <div class="panel-heading">

            @foreach($usuario as $user)
                @if ($user->fotoperfil==="")
  

                    <div class="col-sm-6 col-md-4">
                        
                        <img  src="{{asset('imagenes/avatar.jpg')}}" alt="user-img" class="img-circle" width="75px height 75px" id="fotografia_usuario">
                        <div class="caption">
                            <h3>{{$user->name}}</h3>
                            <p>{{$user->email}}<!--<br>{{$user->celcorporativo}} --><br>{{$user->puesto}}<br>{{$user->afiliado}}<br></p>            
                        </div>
                    </div>
                  
                @else
                    <div class="col-sm-6 col-md-4">
                   
                        <img  src="{{asset('fotografias/'.$user->fotoperfil)}}" alt="user-img" class="img-circle"  width="75px height 75px" id="fotografia_usuario">
                        <div class="caption">
                            <h3>{{$user->name}}</h3>
                            <p>{{$user->email}}<!--<br>{{$user->celcorporativo}} --><br>{{$user->puesto}}<br>{{$user->afiliado}}<br></p>            
                        </div>
                    </div>            
                @endif    
            @endforeach
            </div>
        @endif
        
                       
</div>
 