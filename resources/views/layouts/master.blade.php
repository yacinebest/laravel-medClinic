@extends('layouts.appMaster')
@section('appMasterContent')
    {{-- <script>
        NProgress.configure({showSpinner: false
        });
        NProgress.start();

    </script> --}}

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">

        <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        @extends('layouts.leftsidebar')

        <div class="page-wrapper">
            <!-- NAVBAR -->
            <header class="main-header " id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    <!-- search form -->
                    <div class="search-form d-none d-lg-inline-block">
                        <div class="input-group">
                            <button type="button" name="search" id="search-btn" class="btn btn-flat">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc." autofocus autocomplete="off" />
                        </div>
                        <div id="search-results-container">
                            <ul id="search-results"></ul>
                        </div>
                    </div>

                    <div class="navbar-right ">
                        <ul class="nav navbar-nav">
                            {{-- NOTIFICATIONS --}}
                            {{-- <li class="dropdown notifications-menu">
                                <button class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="mdi mdi-bell-outline"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-header">You have 5 notifications</li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-account-plus"></i> New user registered
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-account-remove"></i> User deleted
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 07 AM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-chart-areaspline"></i> Sales report is ready
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 12 PM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-account-supervisor"></i> New client
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-server-network-off"></i> Server overloaded
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 05 AM</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-footer">
                                        <a class="text-center" href="#"> View All </a>
                                    </li>
                                </ul>
                            </li> --}}
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    {{-- <img src="public/assets/img/user/user.png​" class="user-image" alt="User Image" /> --}}
                                    <span class="d-none d-lg-inline-block">
                                        @if(Auth::guard('doctor')->check())
                                        {{ Auth::guard('doctor')->user()->first_name . " " . Auth::guard('doctor')->user()->last_name }}
                                        @elseif(Auth::guard('secretary')->check())
                                        {{ Auth::guard('secretary')->user()->first_name . " " . Auth::guard('secretary')->user()->last_name }}
                                        @endif
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <!-- User image -->
                                    <li class="dropdown-header">
                                        {{-- <img src="{​​​​{​​​​ asset('assets/img/user/user.png') }​​​​}​​​​" class="img-circle" alt="User Image" /> --}}
                                        <div class="d-inline-block">
                                            @if(Auth::guard('doctor')->check())
                                            {{ Auth::guard('doctor')->user()->first_name . " " . Auth::guard('doctor')->user()->last_name }}
                                            @elseif(Auth::guard('secretary')->check())
                                            {{ Auth::guard('secretary')->user()->first_name . " " . Auth::guard('secretary')->user()->last_name }}
                                            @endif
                                            <small class="pt-1">
                                                @if(Auth::guard('doctor')->check())
                                                {{ Auth::guard('doctor')->user()->email}}
                                                @elseif(Auth::guard('secretary')->check())
                                                {{ Auth::guard('secretary')->user()->email}}
                                                @endif
                                            </small>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="mdi mdi-account"></i> My Profile
                                        </a>
                                    </li>

                                    <li class="dropdown-footer">

                                        <a class="dropdown-item" href="{{
                                        Auth::guard('doctor')->check() ? route('doctorLogout') : (Auth::guard('secretary')->check() ? route('secretaryLogout') : '#' )
                                        }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-logout"></i>{{ __('Log Out') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{
                                        Auth::guard('doctor')->check() ? route('doctorLogout') : (Auth::guard('secretary')->check() ? route('secretaryLogout') : '#')
                                        }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>


            </header>


            @yield('mainContent')

            {{-- FOOOTER --}}
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard Bootstrap Template by
                        <a class="text-primary" href="http://www.iamabdus.com/" target="_blank">Abdus</a>.
                    </p>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;

                </script>
            </footer>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/jekyll-search.min.js') }}"></script>

<script src="{{ asset('assets/js/sleek.js') }}"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
