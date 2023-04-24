<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Restauracje') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e6f454e6ac.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @if (auth()->check())
                    <ul class="navbar-nav me-auto">

                        @if(auth()->user()->roles->contains('role_name', 'szef') &&
                            auth()->user()->roles->contains('role_name', 'kierownik'))
                            <a class="navbar-brand" href="../konta">Zarządzanie kontami</a>
                        @endif

                            @if(!auth()->user()->roles->contains('role_name', 'pracownik') &&
                                !auth()->user()->roles->contains('role_name', 'recepcjonistka') &&
                                !auth()->user()->roles->contains('role_name','ksiegowa') &&
                                !auth()->user()->roles->contains('role_name','magazynier'))


                                <a class="navbar-brand" href="../konta">Zarządzanie kontami</a>
                                <a class="navbar-brand" href="../rezerwacje">Rezerwacje</a>
                                <a class="navbar-brand" href="../pracownicy">Lista pracowników</a>
                            @endif

                        <a class="navbar-brand" href="../korespondencja">Korespondencja uwag</a>

                        @if(!auth()->user()->roles->contains('role_name', 'kierownik') &&
                            !auth()->user()->roles->contains('role_name', 'pracownik')&&
                            !auth()->user()->roles->contains('role_name', 'magazynier'))

                            <a class="navbar-brand" href="../raporty">Raporty</a>
                        @endif

                        @if(auth()->user()->roles->contains('role_name','magazynier'))
                                <a class="navbar-brand" href="../dostawy">Dostawy</a>
                        @endif

                        @if(auth()->user()->roles->contains('role_name', 'recepcjonistka'))
                            <a class="navbar-brand" href="../raporty">Rezerwacje</a>
                        @endif

                        <a class="navbar-brand" href="../grafik">Grafik</a>

                    </ul>
                @endif


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        {{-- @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
