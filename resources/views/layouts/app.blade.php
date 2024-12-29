@php
$currentRouteName = Route::currentRouteName();
@endphp


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    @include('components.link.head')
    @yield('linkHead')
</head>

<body class="overflow-visible mainColor">
    <div id="app m-0">

        <div class="wrapper">

            {{-- Header --}}
            @include('components.nav')

            {{-- sidebar --}}
            @include('components.sidebar')

        </div>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper @if (Request::is('admin'))
                                  h-screen
                                @endif ">

            <!-- Main content -->
                    @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>


    @include('components.link.body')
    @yield('linkBody')

    
  
</body>

</html>
