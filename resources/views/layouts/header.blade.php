<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sleek - Admin Dashboard Template') }}</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

    <!-- Styles -->
    {{-- For Later --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flag-icons/css/flag-icon.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/ladda/ladda.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />

    <!-- SLEEK CSS -->
    <link href="{{ asset('assets/css/sleek.css')}}" id="sleek-css" rel="stylesheet"  />

    <!-- FAVICON -->
    <link href="{{ asset('assets/img/favicon.png')}}" rel="shortcut icon" />
    <script src="{{ asset('assets/plugins/nprogress/nprogress.js')}}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    {{-- <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />--}}
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>
