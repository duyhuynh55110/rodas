<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

        @yield('style')

        {!! Assets::headerJs() !!}
        {!! Assets::headerScript() !!}
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            @include("Admin::layouts.admin.components.navbar")
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            @include("Admin::layouts.admin.components.sidebar")
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @include("Admin::layouts.admin.components.breadcrumbs")
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            @include("Admin::layouts.admin.components.footer")
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <script src="{{ assetAdmin('js/app.js') }}"></script>
        {!! Assets::js() !!}
        {!! Assets::script() !!}
        @yield('javascript')
    </body>
</html>
