<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kanzu') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/articles') }}">
                    {{ config('app.name', 'Kanzu') }}
                </a>
                @if(Auth::guest())
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <li class="dropdown" style="float: right;">
                        <a href="/categories">Categories</a>&nbsp;&nbsp;&nbsp;
                        <a href="/articles">Articles</a>&nbsp;&nbsp;&nbsp;
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
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
                    </li>
                @endif

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->                        
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<style type="text/css">
    .navbar-laravel {
        background-color: #b0b1bf;
    }
    /* the brand name on top*/
    .navbar-light .navbar-brand{
        color: #fff;
    }
    .nav-link{
        color: #fff;
        float: left;
        padding: 14px 15px;
        font-size: 18px;
        line-height: 22px;
        height: 50px;
    }
    .dropdown{
        color: #fff;
        padding: 14px 15px;
        font-size: 18px;
        line-height: 22px;
        height: 50px;
    }
    .dropdown a{
        /*color: #fff;*/
        font-size: 14px;
        font-weight: bolder;
    }
    /* the username link on the top*/
    .navbar-light .navbar-nav .nav-link {
        color: #fff;
    }
</style>
</html>
