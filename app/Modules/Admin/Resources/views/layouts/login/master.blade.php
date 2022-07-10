<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="refresh" content="900">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        @hasSection('title')
            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
        <title>{{ config('app.name') }}</title>
        @endif
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ assetAdmin('css/app.css') }}">
        {!! Assets::css() !!}
        {!! Assets::headerJs() !!}
        {!! Assets::headerScript() !!}
    </head>
    <body class="hold-transition login-page">
        @yield('content')
        <!-- ./wrapper -->
        {!! Assets::js() !!}
        {!! Assets::script() !!}
        @yield('javascript')
    </body>
</html>
