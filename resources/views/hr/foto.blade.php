@if (Auth::user()->fotoperfil==="")
    <img  src="{{asset('imagenes/avatar.jpg')}}" alt="user-img" class="img-circle" width="118px height 118px" id="fotografia_usuario">
@else
    <img  src="{{asset('fotografias/'.Auth::user()->fotoperfil)}}" alt="user-img" class="img-circle" width="118px height 118px" id="fotografia_usuario">
@endif