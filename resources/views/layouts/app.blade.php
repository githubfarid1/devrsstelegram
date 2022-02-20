<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!--frd-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    {{-- Configured Scripts --}}
    @include('adminlte::plugins', ['type' => 'js'])

    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

    <!--frd end-->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!--frd-->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    {{-- Configured Stylesheets --}}
    @include('adminlte::plugins', ['type' => 'css'])

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!--frd-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">



	<!-- Favicon  -->
    <link rel="icon" href="images/favicon.png">

    <!--frd end-->
</head>
<body style="background-color: #009fd4">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light" style="z-index: 10000;">
            <div class="container">
                @auth

                    <a class="navbar-brand logo-image" href="{{ url('/home') }}">
                        <img src="{{ asset('images/rsstelegram.png') }}" alt="alternative">
                    </a>
                @else
                    <a class="navbar-brand logo-image" href="{{ url('/') }}">
                        <img src="{{ asset('images/rsstelegram.png') }}" alt="alternative">
                    </a>
                @endauth
                <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse offcanvas-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link page-scroll" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link page-scroll" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link page-scroll dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (!auth()->user()->isAdmin())
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            {{ __('Dashboard') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('telegrams.edit', Auth::user()->telegram()->get()->toArray()[0]['id']) }}">
                                            {{ __('Setting') }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('editpassword')}}">
                                        {{ __('Update Password') }}
                                    </a>
                                    @if (auth()->user()->isAdmin())
                                        <a class="dropdown-item" href="{{ route('users.index') }}">
                                            {{ __('User Manager') }}
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.copyright');
    <script src="{{ asset('js/scripts.js') }}"></script> <!-- Custom scripts -->

</body>
</html>
