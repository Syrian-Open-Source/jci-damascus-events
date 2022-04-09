<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{isRtlDirection() ? 'rtl': 'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta property="og:image" content="{{ asset('images/logo.png') }}" />
    <meta property="og:site_name" content="{{env('APP_NAME')}}" />
    <meta property="og:title" content="{{env('APP_NAME')}}" />
    <meta property="og:url" content="{{env('APP_URL')}}" />
    <meta property="og:type" content="website" />
    <meta name="title" property="og:title" content="{{env('APP_NAME')}}" />
    <meta property="og:description" content="{{trans('global.texts.events_system_description')}}"/>
    <meta property="og:image:width" content="530">
    <meta property="og:image:height" content="300">
    <meta name="facebook:card" content="{{trans('global.texts.site_description')}}" />
    <meta name="facebook:title" content="{{env('APP_NAME')}}" />
    <meta name="facebook:image:src" content="{{ asset('images/logo.png') }}">
    <meta name="facebook:domain" content="{{env('APP_URL')}}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @if(isRtlDirection())
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css"
              integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q"
              crossorigin="anonymous">
    @else
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body class="antialiased whitesmoke">

<div class="main">
    @include('layouts.header')
    @include('layouts.sessions')
    @yield('content')
    @include('components.contribution-section')
    @include('layouts.footer')
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
@stack('custom-scripts')
</body>
</html>
