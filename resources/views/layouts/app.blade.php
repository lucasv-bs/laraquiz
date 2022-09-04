<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @yield('styles')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('scripts')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link @if (request()->path() == '/') active @endif" aria-current="page"
                                href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (request()->path() == 'quizzes') active @endif" aria-current="page"
                                href="/quizzes">Quizzes</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link @if (request()->path() == 'quizzes/manage') active @endif" aria-current="page"
                                    href="/quizzes/manage">Manage my quizzes</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/quizzes/manage">
                                        Manage my quizzes
                                    </a>

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

        <footer class="text-center text-lg-start text-dark" style="background-color: #ECEFF1">
            <div class="container text-center text-md-start mt-5">
                <div class="row">
                    <div class="col-md-12 col-lg-6 mx-auto mt-3">
                        <p class="h6 fw-bold text-uppercase">
                            <a href="https://freepik.com/" class="text-body">Freepik</a> Images
                        </p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" style="background-color: #ECEFF1">
                                Home Page: <a class="text-dark" href="https://br.freepik.com/vetores-gratis/diferentes-pessoas-fazendo-perguntas_13454503.htm#query=quiz&position=43&from_view=search">Image by pikisuperstar</a> on Freepik
                            </li>
                            <li class="list-group-item" style="background-color: #ECEFF1">
                                Home Page: Image by <a class="text-dark" href="https://br.freepik.com/vetores-gratis/ilustracao-de-pessoas-planas-fazendo-perguntas_13379598.htm#query=quiz&position=40&from_view=search">Freepik</a>
                            </li>
                            <li class="list-group-item" style="background-color: #ECEFF1">
                                Quiz Card: <a class="text-dark" href="https://br.freepik.com/vetores-gratis/astronauta-fofo-confundir-desenho-vetorial-icone-ilustracao-ciencia-tecnologia-conceito-icone-isolado_26124607.htm#&position=6&from_view=detail#&position=6&from_view=detail">Image by catalyststuff</a> on Freepik
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12 col-lg-6 mx-auto mt-3">
                        <p class="h6 fw-bold text-uppercase">Help me keep improving</p>
                        <p>
                            Found something I can fix or improve, please let me know via 
                            <a class="text-dark" href="https://github.com/lucasv-bs">GitHub</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2022 Copyright:
                <a class="text-dark" href="https://github.com/lucasv-bs">Lucas Vinicius</a>
            </div>
        </footer>
    </div>
</body>

</html>
