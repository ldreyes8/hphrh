<div class="tab-pane active" id="profile">
    @if (isset($usuario))
        @foreach($usuario as $user)
            @if ($user->fotoperfil==="")
                <img  src="{{asset('imagenes/avatar.jpg')}}" alt="user-img" class="img-circle" width="118px height 118px" id="fotografia_usuario">
                <div class="caption">
                    <h3>{{$user->name}}</h3>
                </div>
        
            @else
                <img  src="{{asset('fotografias/'.$user->fotoperfil)}}" alt="user-img" class="img-circle" width="118px height 118px" id="fotografia_usuario">
                <div class="caption">
                    <h3>{{$user->name}}</h3>
                </div>            
            @endif    
        @endforeach
    @endif
                       
</div>
 