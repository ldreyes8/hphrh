@if (Auth::user()->fotoperfil==="")
    <img  src="{{asset('imagenes/avatar.jpg')}}" alt="user-img" class="img-circle" width="118px height 118px">
@else
    <img  src="{{asset('assets/images/users/'.Auth::user()->fotoperfil)}}" alt="user-img" class="img-circle">
    @endif