<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rental System') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Book Rental
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <form action="{{ route('search') }}" class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                name="search">
                            <button class="btn btn-outline-light text-white  btn-sm" type="submit">Search</button>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @if (Auth::user() && Auth::user()->is_librarian)
                            <li class="nav-item dropdown pt-1">
                                <a class="nav-link dropdown-toggle " data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false">Librarian Actions</a>
                                <ul class="dropdown-menu">

                                    <li>
                                        <a class="dropdown-item" href="{{ route('books.create') }}">
                                            <i class="bi bi-plus-circle  me-1"></i>
                                            Add Book
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('genres.create') }}">
                                            <i class="bi bi-plus-circle  me-1"></i>
                                            Add Genre
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('genres.index') }}">
                                            <i class="bi bi-list-ul me-1"></i>Genres
                                            List</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('borrows.index') }}">
                                            <i class="bi bi-journal-check me-1"></i>Rentals
                                            List</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user())
                            <li class="nav-item pt-1">
                                <a class="nav-link"
                                    href="{{ route('borrows.index', ['my_rentals' => true]) }}">My Rentals </a>
                            </li>
                        @endif

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item pt-1">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif


                            @if (Route::has('register'))
                                <li class="nav-item pt-1">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown pt-1">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" v-pre>
                                    {{ Auth::user()->name }}
                                </a>



                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="bi bi-person-fill me-1"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                        <i class="bi bi-door-closed-fill me-1"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
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
            <div class="h-100 pb-5 container">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
