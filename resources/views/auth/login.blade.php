@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h4 class="center-align">Login</h4>
            <form class="col s6 offset-s3" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12 {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input placeholder="Email" id="email" name="email" type="text" class="validate"
                               value="{{ old('email') }}" required autofocus>
                        <label for="email">E-Mail Address</label>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="input-field col s12 {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="validate" name="password" placeholder="Password"
                               required>
                        <label for="password">Password</label>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="col s12">
                        <p>
                            <input type="checkbox" class="filled-in" id="remember"
                                   name="remember" {{ old('remember') ? 'checked' : '' }} />
                            <label for="remember">Remember Me</label>
                        </p>
                    </div>
                    <div class="col s12 center-align">
                        <div class="row">
                            <div class="col s12 spacing">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                            <div class="col s12">
                                <a class=" btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
