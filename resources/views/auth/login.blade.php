@extends('layouts.app')

@section('content')
<div class="wrapper-page">

            <div class="text-center">
              
                <a href="#"><img src="{{asset('assets/images/Habitat/habitat.png')}}" alt="" class="md md-equalizer" />
                </a>
            </div>

            <form class="form-horizontal m-t-20" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Mail">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            

                        <i class="md md-markunread form-control-feedback l-h-34"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        <i class="md md-vpn-key form-control-feedback l-h-34"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-right m-t-20">
                    <div class="col-xs-12">
                       <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                    </div>
                </div>

                <div class="form-group m-t-30">
                    <div class="col-sm-7">
                        <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your
                            password?</a>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="{{ route('register') }}" class="text-muted">Create an account</a>
                    </div>
                </div>
            </form>
        </div>
@endsection
