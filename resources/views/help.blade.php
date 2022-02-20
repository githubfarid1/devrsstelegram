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

        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

    <!-- Header -->
    <header id="header" class="header">
        <div class="container-sm border">
            <table class="table table-hover table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">How to Use RSSTelegram Application</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><a href="{{ route('help') }}#carousel1">User Registration</a></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><a href="{{ route('help') }}#carousel2">Get RSS from Upwork.com</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td><a href="{{ route('help') }}#carousel3">Create Telegram Channel AND Run the BOT</a></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Need Help ? <a href="{{ $walink }}" target="_blank"><button type="button" class="btn btn-danger">WhatsApp Me</button></a></td>
                    </tr>


                </tbody>
            </table>
            <br>
        </div>
        <div class="container-sm border" id="carousel1">
            <br>
            <h4 class="text-center" style="color: rgb(20, 11, 146);">
                User Registration
            </h4>
            <br>
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img style="margin:auto;" src="{{ asset('images/register/1-res-des.png') }}"
                            class="img-fluid d-block center" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/register/2-res-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/register/3-res-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/register/4-res-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div> <!-- end of container -->
        <br>
        <div class="container-sm border" id="carousel2">
            <br>
            <h4 class="text-center" style="color: rgb(20, 11, 146);">
                Get RSS from Upwork.com
            </h4>
            <br>

            <div id="carouselExampleCaptions2" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions2" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions2" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions2" data-slide-to="2"></li>
                    <li data-target="#carouselExampleCaptions2" data-slide-to="3"></li>
                    <li data-target="#carouselExampleCaptions2" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img style="margin:auto;" src="{{ asset('images/upwork/1-res-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/upwork/2-res-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/upwork/3-res-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/upwork/4-res-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/upwork/5-res-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div> <!-- end of container -->


        <br>
        <div class="container-sm border" id="carousel3">
            <br>
            <h4 class="text-center" style="color: rgb(20, 11, 146);">
                Create Telegram Channel AND Run the BOT
            </h4>
            <br>
            <div id="carouselExampleCaptions3" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions3" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="2"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="3"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="4"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="5"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="6"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="7"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="8"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="9"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="10"></li>
                    <li data-target="#carouselExampleCaptions3" data-slide-to="11"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img style="margin:auto;" src="{{ asset('images/telegram/1-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/2-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/3-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/4-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/5-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/6-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/7-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/8-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/9-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/10-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/11-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img style="margin:auto;" src="{{ asset('images/telegram/12-des.png') }}"
                            class="img-fluid d-block" alt="...">
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions3" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions3" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
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
