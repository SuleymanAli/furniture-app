<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    @yield('css')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    a,a:hover {
        text-decoration: inherit;
        color: inherit;
    }

    p {
        padding: 0;
        margin: 0; 
    }

    html, body {
        height: 100%;
    }

    #container {
        min-height: 75%;
    }

    #main {
       overflow: auto;
       /*padding-bottom: 100px;*/
   }

   #footer {
    position: relative;
    height: 50px;
    /*margin-top: -100px;*/
    clear: both;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}
</style>
<!-- Custom Styles -->
@yield('css')
</head>
<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">
            <a href="/">Woodpacker</a>
        </h5>
        
        @if (Request::is('product') || Request::is('search'))
        <form class="form-inline mr-md-auto col-4" action="{{ route('search') }}" method="GET">
            <input class="form-control mr-sm-2 col-9" type="text" placeholder="Search" aria-label="Search" name="query" value="{{ request()->input('query') }}">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                Search
            </button>
        </form>
        @endif
        
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark {{ Request::is('/') || Request::is('home') ? "bg-info" : null }}" href="/">
                Home
            </a>
            <a class="p-2 text-dark {{ Request::is('product') ? "bg-info" : null }}" href="/product">
                Products
            </a>
            <a class="p-2 text-dark {{ Request::is('cart') ? "bg-info" : null }}" href="/cart">
                Cart
                @if (request()->session()->has('cart'))
                <span class="badge badge-warning">
                    {{  request()->session()->get('cart')->totalQty }}
                </span>
                @endif
            </a>
            @if (Auth::check())
            @if (auth()->user()->hasAnyRole('admin'))
            <a class="p-2 text-dark {{ Request::is('admin') ? "bg-info" : null }}" href="/admin">
                Admin
            </a>
            @endif
            @endif
            <a href="{{ route('lang', 'en') }}" class="{{ App::getLocale() == 'en' ? 'bg-info' : ''}} ml-2 p-1">
                En
            </a>
            
            <a href="{{ route('lang', 'az') }}" class="{{ App::getLocale() == 'az' ? 'bg-info' : ''}} mx-1 p-1">
                Az
            </a>
            <a href="{{ route('lang', 'de') }}" class="{{ App::getLocale() == 'de' ? 'bg-info' : ''}} mr-2 p-1">
                De
            </a>
        </nav>
        <ul class="navbar-nav">
            <li class="nav-item dropdown mr-2">

                @if(Auth::check())

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Hi, {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.profile') }}">
                    Your Profile
                </a>

                <a class="dropdown-item" href="/wishlist">
                    Wish List
                    @if (request()->session()->has('wish'))
                    <span class="badge badge-warning">
                        {{  count(request()->session()->get('wish')->items) }}
                    </span>
                    @endif
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
            </div>

            @else

            <a href="{{ route('register') }}" class="btn btn-outline-primary">Sign up</a>
            <a href="{{ route('login') }}" class="btn btn-primary mr-md-4">Login</a>

            @endif

        </li>
    </ul>
</div>

<div class="container" id="container">
    <div class="row">
        @include('partials._messages')
    </div>
    <div class="row py-4" id="main">
        @yield('content')
    </div>
</div>
<div class="container" id="footer">
    <footer class="pt-4 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <small class="d-block mb-3 text-muted">&copy; 2017-2019</small>
            </div>
            <div class="col-12 col-md">
                <ul class="list-unstyled text-small text-right">
                    <li>
                        <a class="text-muted" href="/contact">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</div>

@yield('js')
</body>
</html>
