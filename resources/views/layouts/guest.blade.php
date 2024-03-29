<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SisGe_Fact') }}</title>

    <!-- Icono de la Pestaña -->
    <link rel="shortcut icon" href="{{ asset('icons/logo/SisGeFact.jpg') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Estilo del Login CoreUI -->
    <link rel="stylesheet" href="css/simple-line-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>

</head>

<body>
    <div id="app" class="app flex-row align-items-center">

            @auth
            <!-- <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a> -->
            @else
                @yield('content')

                @if (Route::has('register'))
                    @yield('contentRegister')
                <!-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a> -->
                @endif
            @endif



    </div>

</body>

</html>
