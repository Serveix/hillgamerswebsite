<!DOCTYPE html>
<html lang="es">

<head>
    <title>HillGamers: @yield('title')</title>
    <meta name="description" content="¡Servidor de Minecraft HillGamers con survival, residencias, parcelas y más!">
    <meta name="keywords" content="Team Hill, Hill gamers, minecraft, server, survival">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//use.fontawesome.com" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico|Roboto:400,500,700|Poppins:500&display=swap" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
    @yield('styles')
</head>

<body>
    @include('includes.navbar')
        @yield('content')


    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
