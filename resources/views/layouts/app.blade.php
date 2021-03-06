<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta name="robots" content="noindex, nofollow">
    <!--для закрытых страниц-->
    <meta name="robots" content="noindex, follow">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @yield('navbar')

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            @if('user' == session('profile_role') || !(Auth::user()->hasRole('moderator') ||  (Auth::user()->hasRole('admin'))))
                                <a class="navbar-brand" href="{{ route('profile') }}">
                                    {{ trans('ru.profile') }}
                                </a>
                            @endif
                            @if('user' == session('author') || Auth::user()->hasRole('author'))
                                <a class="navbar-brand" href="{{ route('admin_blog') }}">
                                    {{ trans('ru.blog') }}
                                </a>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ session('profile_email') ?? Auth::user()->email }} <span class="caret"></span>
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
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <!-- Status -->
            @if (!empty($errors) && (count($errors) > 0))
                <div class="alert alert-danger">
                    <p class="error">
                        @foreach ($errors->toArray() as $key=>$error)
                        {!! str_replace($key, '<strong>' . trans('admin.' . $key) . '</strong>', $error[0]) !!}</br>
                        @endforeach
                    </p>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        <!-- End status-->
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->

    @if((Route::currentRouteName() ==  'edit_profile') || (Route::currentRouteName() ==  'events'))
        <script src="{{ asset('js/admin.js') }}"></script>
    @endif
    <!-- TinyMCE -->
    @yield('tiny')
    <!-- TinyMCE -->
    {{--Cropper--}}
    @yield('cropper')
    {{--Cropper--}}
</body>
</html>
