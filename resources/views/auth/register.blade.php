@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Register</h4>
            <form class="col s12" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12 {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input placeholder="Name" id="name" name="name" type="text" class="validate"
                               value="{{ old('name') }}" required autofocus>
                        <label for="name">Name</label>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
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
                    <div class="input-field col s12">
                        <input id="password-confirm" type="password" class="validate" name="password_confirmation"
                               placeholder="Confirm Password" required>
                        <label for="password-confirm">Confirm Password</label>
                    </div>
                    <div class="col s12 center-align">
                        <div class="row">
                            <div class="col s12 spacing">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
