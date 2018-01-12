<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/toastr.css') }}">
</head>
<body>
<div id="app">
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{ route('home.password') }}">Reset Password</a></li>
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">Task</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li><a class="dropdown-button" href="#" data-activates="dropdown1">{{ Auth::user()->name }}<i
                                    class="material-icons right"></i></a></li>
                    @endguest
            </ul>
        </div>
    </nav>
    <div class="section-padding">
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/toastr.min.js') }}"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };


    @if(count($errors->all()))
          @foreach($errors->all() as $error)
                toastr.error('{{$error}}', {timeOut: 5000})
          @endforeach
    @endif

    @if(Session::has('error'))
        toastr.error("{{Session::get('error')}}", {timeOut: 5000})
    @elseif(Session::has('success'))
        toastr.success("{{Session::get('success')}}", {timeOut: 5000})
    @endif
</script>
</body>
</html>
