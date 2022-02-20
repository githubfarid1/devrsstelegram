<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="rsstelegram" content="rsstelegram, telegram, rss, upwork, fiverr, frelancer">
    <meta name="author" content="rsstelegram">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
    <title>rsstelegram.com</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!--frd-->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">



    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Pavo</a> -->

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="/"><img src="{{ asset('images/rsstelegram.png') }}"
                    alt="alternative"></a>

            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ route('home') }}">{{ __('auth.home') }}<span
                                    class="sr-only">(current)</span></a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ route('register') }}">{{ __('auth.register') }}
                                <span class="sr-only">(current)</span></a>
                        </li>
                    @endauth
                </ul>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h1 class="h1-large">RSS + Telegram</h1>
                        <p class="p-large" style="font-size:x-large; font-style:italic; color: rgb(248, 247, 247);">
                            <em>"{{ __('welcome.motto') }}"</em>
                        </p>
                        @auth
                            <a class="btn-solid-lg" href="{{ route('home') }}"><i
                                    class="fab fa-telegram"></i>{{ __('auth.home') }}</a>
                        @else
                            <a class="btn-solid-lg secondary" href="{{ route('login') }}"><i
                                    class="fab fa-telegram"></i>{{ __('auth.login') }}</a>
                            <a class="btn-solid-lg" href="{{ route('register') }}"><i
                                    class="fab fa-telegram"></i>{{ __('auth.register') }}</a>
                        @endauth
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('images/header-smartphone.png') }}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                @if (App::getLocale() === 'id')
                    <div class="col-lg-12">
                        @php
                            $isMobile = \Jenssegers\Agent\Facades\Agent::isMobile();
                        @endphp
                        <p>Video Proses Pendaftaran sampai Bot RSSTelegram berjalan</p>
                        @if (!$isMobile)
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/KUD4oM5lekM?rel=0" allowfullscreen></iframe>
                            </div>
                        @else
                            <a href="https://www.youtube.com/watch?v=KUD4oM5lekM">Klik disini</a>
                        @endif
                    </div>
                @endif
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="social-container">
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-youtube fa-stack-1x"></i>
                            </a>
                        </span>
                    </div> <!-- end of social-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->
    @include('layouts.copyright')
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap framework -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!-- Custom scripts -->
</body>

</html>
