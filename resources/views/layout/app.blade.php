<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
            <a class="p-2 text-dark {{ Request::is('order') ? "bg-info" : null }}" href="/order">
                Order
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
                <a class="dropdown-item" href="{{ route('product.index') }}">Products</a>
                <a class="dropdown-item" href="{{ route('category.index') }}">Categories</a>
                {{-- <a class="dropdown-item" href="{{ route('tags.index') }}">Tags</a> --}}
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

{{-- <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Pricing</h1>
    <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
</div> --}}
<div class="container">
    <div class="row">
        @include('partials._messages')
    </div>
    <div class="row py-4">
        @yield('content')
    </div>
</div>
<div class="container">
        {{-- <div class="card-deck mb-3 text-center">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Free</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>10 users included</li>
                        <li>2 GB of storage</li>
                        <li>Email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Pro</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>20 users included</li>
                        <li>10 GB of storage</li>
                        <li>Priority email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Enterprise</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>30 users included</li>
                        <li>15 GB of storage</li>
                        <li>Phone and email support</li>
                        <li>Help center access</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
                </div>
            </div>
        </div> --}}

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
                    <small class="d-block mb-3 text-muted">&copy; 2017-2019</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Features</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Cool stuff</a></li>
                        <li><a class="text-muted" href="#">Last time</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Resource</a></li>
                        <li><a class="text-muted" href="#">Final resource</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Team</a></li>
                        <li><a class="text-muted" href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    @yield('js')
</body>
</html>
