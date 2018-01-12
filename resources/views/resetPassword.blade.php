@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="center-align">Resetting Password</h2>

        <form class="col s12" method="POST" action="{{ route('home.reset') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12">
                    <input id="oldPassword" type="password" class="validate" name="oldPassword" placeholder="Password"
                           required>
                    <label for="password">Your Old Password</label>
                </div>
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate" name="password"
                           placeholder="New Password" required>
                    <label for="password-confirm">New Password</label>
                </div>
                <div class="col s12 center-align">
                    <div class="row">
                        <div class="col s12 spacing">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection