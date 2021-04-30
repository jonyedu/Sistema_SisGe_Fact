<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SisGe_Fact') }}</title>

    <!-- Icono de la Pestaña -->
    <link rel="shortcut icon" href="{{ asset('icons/logo/SisGeFact.jpg') }}">

    <!-- Plantilla General de los CSS -->
    <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">

    <!-- Evitar ataques X-CSRF-TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>

<body>
    <li hidden>
        <a style="padding: .5rem 1rem;display: contents;" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <!-- Main Sidebar Container -->
    <div id="app">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
            <index></index>
            </div>
        </div>

    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2020-20121 <a href="https://www.SisGe_Fact.org/inicio.html">SisGe_Fact</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 0.0.1
        </div>
    </footer>


    <!-- App JS de Vue -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Plantilla General de los JS -->
    <script src="{{ asset('js/plantilla.js') }}"></script>

    @yield('scripts')
    <script>
        $(document).ready(function() {
            $().ready(function() {
                $('[data-widget="pushmenu"]').PushMenu('collapse')
            });
        });
    </script>
    @yield('end_scripts')
</body>


</html>
