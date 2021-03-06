<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHOrACmCggmP6IU0vusRmpX70qCBxMufY&libraries=places"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        @include('layouts.components.navbar')

        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 d-none d-md-block">
                        @if (Auth::check())
                        @include('layouts.components.user-sidebar')
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-12">
                    @yield('content')
                    </div>
                    <div class="col-3">
                    @yield('sidebar-right')
                    </div>
                </div>
            </div>
            
        </main>
    </div>
</body>

@yield('scripts')
</html>
