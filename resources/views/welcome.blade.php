<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <title>Clinique Medical</title>


        <!--====== Favicon Icon ======-->
        <link type="image/png" href="{{ asset('assets/img/favicon.png')}}" rel="shortcut icon" />

        <!--====== Bootstrap css ======-->
        <link rel="stylesheet" href="{{  asset('assets/smartopl/assets/css/bootstrap.min.css') }}">

        <!--====== Line Icons css ======-->
        <link rel="stylesheet" href="{{  asset('assets/smartopl/assets/css/LineIcons.css') }}">

        <!--====== Magnific Popup css ======-->
        <link rel="stylesheet" href="{{  asset('assets/smartopl/assets/css/magnific-popup.css') }}">

        <!--====== Slick css ======-->
        <link rel="stylesheet" href="{{  asset('assets/smartopl/assets/css/slick.css') }}">

        <!--====== Animate css ======-->
        <link rel="stylesheet" href="{{  asset('assets/smartopl/assets/css/animate.css') }}">

        <!--====== Default css ======-->
        <link rel="stylesheet" href="{{  asset('assets/smartopl/assets/css/default.css') }}">

        <!--====== Style css ======-->
        <link rel="stylesheet" href="{{  asset('assets/smartopl/assets/css/style.css') }}">
    </head>
    <body>

        <div class="preloader">
            <div class="loader">
                <div class="ytp-spinner">
                    <div class="ytp-spinner-container">
                        <div class="ytp-spinner-rotator">
                            <div class="ytp-spinner-left">
                                <div class="ytp-spinner-circle"></div>
                            </div>
                            <div class="ytp-spinner-right">
                                <div class="ytp-spinner-circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="header-area">
            <div class="navbar-area" style="background-color: #4c84ff;">
                <div class="container">
                    <div class="row">
                        <!--====== SAIDEBAR PART START ======-->
                            <div class="sidebar-right">
                                <div class="sidebar-close">
                                    <a class="close" href="#close"><i class="lni-close"></i></a>
                                </div>
                                <div class="sidebar-content">
                                    <div class="sidebar-logo text-center">
                                        <a href="{{ route('welcome') }}">
                                            <img src="{{  asset('assets/img/sleek-icon.png') }}" class="w-100" alt="Logo">
                                        </a>
                                    </div>
                                    <div class="sidebar-menu">
                                        <ul>
                                            <li><a href="{{ route('welcome') }}">Home</a></li>

                                            @if(Auth::guard('doctor')->check())
                                                <li><a href="{{ route('doctorHome') }}">Home Docteur</a></li>
                                            @elseif(Auth::guard('secretary')->check())
                                                <li><a href="{{ route('secretaryHome') }}">Home Secretaire</a></li>
                                            @else
                                                <li><a href="{{ route('doctorLogin') }}">Login Docteur</a></li>
                                                <li><a href="{{ route('secretaryLogin') }}">Login Secretaire</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay-right"></div>
                        <!--====== SAIDEBAR PART ENDS ======-->

                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand text-white" href="{{ route('welcome') }}">
                                    <img src="{{  asset('assets/img/sleek-icon.png') }}" alt="Logo">
                                    MedClinic
                                </a>

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarEight" aria-controls="navbarEight" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarEight">
                                    <ul class="navbar-nav ml-auto">

                                        <li class="nav-item active">
                                            <a class="page-scroll" href="{{ route('welcome') }}">Home</a>
                                        </li>
                                        @if(Auth::guard('doctor')->check())
                                            <li class="nav-item">
                                                <a class="page-scroll" href="{{ route('doctorHome') }}">Home Docteur</a>
                                            </li>
                                        @elseif(Auth::guard('secretary')->check())
                                            <li class="nav-item">
                                                <a class="page-scroll" href="{{ route('secretaryHome') }}">Home Secretaire</a>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a class="page-scroll" href="{{ route('doctorLogin') }}">Login Docteur</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="page-scroll" href="{{ route('secretaryLogin') }}">Login Secretaire</a>
                                            </li>
                                            {{-- @if (Route::has('register'))
                                                <a href="{{ route('register') }}">Register</a>
                                            @endif --}}
                                        @endif
                                    </ul>
                                </div>

                                <div class="navbar-btn d-none mt-15 d-lg-inline-block">
                                    <a class="menu-bar" href="#side-menu-right"><i class="lni-menu"></i></a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div id="home" class="slider-area">
                <div class="bd-example">
                    <div id="carouselOne" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselOne" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselOne" data-slide-to="1"></li>
                            <li data-target="#carouselOne" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">

                            @php
                                $hasOneActive = false;
                                $classActive = 'active';
                            @endphp
                            @foreach(['assets/smartopl/assets/images/med-slider1.jpg',
                                        'assets/smartopl/assets/images/med-slider2.jpg' ,
                                        'assets/smartopl/assets/images/slider-3.jpg'
                                        ] as $currentImg )
                                <div class="carousel-item bg_cover {{ $classActive }}" style="background-image: url( {{  asset($currentImg)}} )">
                                    <div class="carousel-caption">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-xl-6 col-lg-7 col-sm-10">
                                                    <h2 class="carousel-title" style="color:#4c84ff;">Soins médicaux efficaces et uniques</h2>
                                                    <ul class="carousel-btn rounded-buttons">
                                                        <li><a class="main-btn rounded-three" href="{{ route('doctorLogin') }}">DOCTEUR</a></li>
                                                        <li><a class="main-btn rounded-one bg-info" href="{{ route('secretaryLogin') }}">SECRETAIRE</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    if(!$hasOneActive ){
                                        $hasOneActive = true;
                                        $classActive = '';
                                    }
                                @endphp
                            @endforeach



                        </div>

                        <a class="carousel-control-prev" href="#carouselOne" role="button" data-slide="prev">
                            <i class="lni-arrow-left-circle"></i>
                        </a>

                        <a class="carousel-control-next" href="#carouselOne" role="button" data-slide="next">
                            <i class="lni-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>

        </section>

        <section id="about" class="about-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="section-title text-center mt-30 pb-40">
                            <h4 class="title wow fadeInUp text-primary" data-wow-duration="1.5s" data-wow-delay="0.6s">Au service de votre santé avec excellence!</h4>
                            <p class="text wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">Nous consacrons notre travail à vous aider à vivre une vie saine.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer id="footer" class="footer-area">
            <section id="contact" class="contact-area bg-white">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9 text-center">
                            <h2 class="title text-uppercase wow fadeInDown pb-20" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInDown;">À propos de nous</h2>
                            <p class="big-text opacity-80 wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce aliquet tortor eu eros vestibulum, non placerat libero blandit.
                                Vivamus in tellus sed elit maximus dignissim. Proin non dolor erat. Nunc luctus sem quis risus dapibus, nec mattis quam scelerisque.
                                Vestibulum vulputate velit eget congue ullamcorper. Nullam placerat nibh in vehicula hendrerit.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="footer-copyright" style="background-color: #4c84ff;">
                <div class="container">
                    <div class="row align-items-center">
                        <!--  copyright -->
                        <div class="col-lg-5">
                            <div class="copyright text-center text-lg-left mt-10">
                                <p class="text">Crafted by <a class="text-white" rel="nofollow" href="https://uideck.con">UIdeck</a> and UI Elements from <a class="text-white" rel="nofollow" href="https://ayroui.com">Ayro UI</a></p>
                            </div>
                        </div>

                        <!-- footer logo -->
                        <div class="col-lg-2">
                            <div class="footer-logo text-center mt-10">
                                <a href="{{ route('welcome') }}" class="text-white">
                                    <img src="{{  asset('assets/img/sleek-icon.png') }}" alt="Logo">
                                </a>
                            </div>
                        </div>
                        <!-- social -->
                        <div class="col-lg-5">
                            <ul class="social text-center text-lg-right mt-10">
                                <li><a href="https://facebook.com/uideckHQ"><i class="lni-facebook-filled text-white"></i></a></li>
                                <li><a href="https://twitter.com/uideckHQ"><i class="lni-twitter-original text-white"></i></a></li>
                                <li><a href="https://instagram.com/uideckHQ"><i class="lni-instagram-original text-white"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>


        <!--====== jquery js ======-->
        <script src="{{  asset('assets/smartopl/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
        <script src="{{  asset('assets/smartopl/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

        <!--====== Bootstrap js ======-->
        <script src="{{  asset('assets/smartopl/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{  asset('assets/smartopl/assets/js/bootstrap.min-min.js') }}"></script>
        <script src="{{  asset('assets/smartopl/assets/js/popper.min.js') }}"></script>
        <script src="{{  asset('assets/smartopl/assets/js/popper.min-min.js') }}"></script>

        <!--====== Slick js ======-->
        <script src="{{  asset('assets/smartopl/assets/js/slick.min.js') }}"></script>

        <!--====== Isotope js ======-->
        <script src="{{  asset('assets/smartopl/assets/js/isotope.pkgd.min.js') }}"></script>

        <!--====== Images Loaded js ======-->
        <script src="{{  asset('assets/smartopl/assets/js/imagesloaded.pkgd.min.js') }}"></script>

        <!--====== Magnific Popup js ======-->
        <script src="{{  asset('assets/smartopl/assets/js/jquery.magnific-popup.min.js') }}"></script>

        <!--====== Scrolling js ======-->
        <script src="{{  asset('assets/smartopl/assets/js/scrolling-nav.js') }}"></script>
        <script src="{{  asset('assets/smartopl/assets/js/jquery.easing.min.js') }}"></script>

        <!--====== wow js ======-->
        <script src="{{  asset('assets/smartopl/assets/js/wow.min.js') }}"></script>

        <!--====== Main js ======-->
        <script src="{{  asset('assets/smartopl/assets/js/main.js') }}"></script>
    </body>
</html>
