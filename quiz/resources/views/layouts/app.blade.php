<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> -->

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/extra.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
</head>
<body class="grey lighten-2">
    @auth
    <nav>
      <div class="nav-wrapper orange">
        <a href="#!" class="brand-logo right" style="margin-right: 24px;">QUIZZ</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        @if(Auth::user()->id == 1)
        <li><a href="{{ route('form_categories.index') }}">Mis categorías</a></li>
        <li><a href="{{ route('forms.index') }}">Mis formularios</a></li>
        @endif
        <li><a href="{{ route('quiz.index') }}">Resolver formularios</a></li>
        <div class="divider no-margin"></div>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>

    <ul id="slide-out" class="sidenav sidenav-fixed gr" style="width: 250px;">
        @if(Auth::user()->id == 1)
        <li><a href="{{ route('form_categories.index') }}">Mis categorías</a></li>
        <li><a href="{{ route('forms.index') }}">Mis formularios</a></li>
        @endif
        <li><a href="{{ route('informacion.index') }}">Informacion</a></li>
        <li><a href="{{ route('quiz.index') }}">Resolver formularios</a></li>
        <div class="divider no-margin"></div>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>

    <main class="row">
        @yield('content')
    </main>
    @endauth
    
    @guest
        @yield('content')
    @endguest
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    
    @if (Route::currentRouteName()=='form_categories.index')
        <script src="{{ asset('js/form_categories.js') }}"></script>
    @endif

    <script src="{{ asset('js/quiz.js') }}"></script>
    <script src="{{ asset('js/forms.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // M.AutoInit();
        });
    </script>
</body>
</html>
