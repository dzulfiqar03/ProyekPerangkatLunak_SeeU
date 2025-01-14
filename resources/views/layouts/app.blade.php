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
    <link rel="shortcut icon" href="{{ Vite::asset('resources/images/Logo/mainLogo-light.png') }}" type="image/png">
    <link rel="icon" href="{{ Vite::asset('resources/images/Logo/mainLogo-light.png') }}" type="image/png">
    <title>{{ $pageTitle }}</title>


    @include('components.link.head')
    @yield('linkHead')
</head>

<body @if ($currentRouteName !== 'guest' && $currentRouteName !== 'gstDetail') class=" overflow-visible mainColor" @endif>

    @if ($currentRouteName !== 'guest' && $currentRouteName !== 'gstDetail')
        <div id="app m-0">

            <div class="wrapper">

                {{-- Header --}}

                @if ($currentRouteName !== 'guest' && $currentRouteName !== 'gstDetail')
                    @include('components.nav')

                    {{-- sidebar --}}
                    @include('components.sidebar')
                @endif

            </div>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper @if (Request::is('dashboard')) h-screen @endif ">

                <!-- Main content -->
                @yield('content')
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
    @else
        <!-- Main content -->
        @yield('content')
        <!-- /.content -->

    @endif

    @include('components.link.body')
    @yield('linkBody')


    @include('sweetalert::alert')

    @stack('scripts')

</body>

</html>
