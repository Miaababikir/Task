@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="collection with-header">
            <li class="collection-header"><h4>Dashboard</h4></li>
            <li class="collection-item">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
            </li>
        </ul>

        <div id="images">
            <div class="row">
                <div class="col s6 center-align" v-for="image in images" >
                    <img :src.sync="image" alt="image" width="300px" height="300px">
                </div>
            </div>
        </div>

    </div>
@endsection
