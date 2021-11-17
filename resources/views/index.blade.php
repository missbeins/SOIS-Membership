<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SOIS:Membership') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

</head>

<body class="antialiased">
    <header>
        <div class="container-fluid navcon pl-0">
            <nav class="navbar navbar-light bg-light">
                <span class="navbar-brand upperbrand" href="#">
                    <img src="/images/pup-logo-Polytechnic_University_of_the_Philippines.png" width="30" height="30"
                        class="d-inline-block align-top" alt="">
                    {{ __('Polytechnic University of the Philippines - Tagiug') }}
                </span>
                <form class="form-inline my-2 my-lg-0">

                    @if (Route::has('login'))

                        @auth
                            <!-- Authentication Links -->
                            <a href="{{ route('logout') }}" class="nav-item nav-link navitems"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                             <!-- Authentication Links -->
                             <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline"
                             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="nav-item nav-link uppernavitems ml-4">{{ __('Login') }}</a>
                        @endauth


                    @endif
                </form>
            </nav>
            <nav class="navbar navbar-expand-lg ">
                <a class="navbar-brand lowerbrand" href="#">
                    <img src="/images/pup-logo-Polytechnic_University_of_the_Philippines.png" width="50" height="50"
                        class="d-inline-block align-top" alt="">
                    {{ __('Student Organization Information System : Membership') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a href="#" class="nav-item nav-link lowernavitems">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-item nav-link lowernavitems">{{ __('About') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-item nav-link lowernavitems">{{ __('Contacts') }}</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="jumbotron headertext">
                <h1 class="display-4">Welcome, Iskolar!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling
                    extra attention to featured content or information.</p>
                <hr class="my-4 hrcolor">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.
                </p>
                <a class="btn btn-warning btn-md headerbtn" href="#" role="button">Learn more</a>
            </div>
        </div>
    </header>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
</body>

</html>
