<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
    @yield('before_head')
</head>

<body class="antialiased">
    @include('Frontend.partials._header')

    <main>
        @yield('main')
    </main>
    <!--include footer-->
    @include('Frontend.partials._footer')
    <!--include Javascript -->
    <script src="{{ mix('js/all.js') }}"></script>
    @yield('before_body')
</body>

</html>
