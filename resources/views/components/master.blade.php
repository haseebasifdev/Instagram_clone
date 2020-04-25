<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <meta name="userid" content="{{auth()->id()}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-white sticky-top bg-white">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse container" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link to="/" class="nav-link">
                            <h5 class=" text-dark">Instagram Clone</h5>
                        </router-link>
                    </li>

                </ul>
                <form class="form-inline my-auto ">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <router-link to="/" class="nav-link"><i class="fas fa-home fa-lg"></i></router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-location-arrow fa-lg"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-compass fa-lg"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-heart fa-lg"></i></a>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/addpost"><i class="fas fa-plus-circle"></i>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/profiles/{{auth()->id()}}"><img  src="/images/download.jfif"
                                width="20px"></router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <div>
            {{$slot}}
        </div>
        <router-view></router-view>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>