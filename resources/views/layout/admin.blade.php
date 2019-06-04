<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Dashboard Template · Bootstrap</title>

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

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
</head>
<body>
  <nav class="navbar navbar-dark bg-dark flex-md-nowrap p-2 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
      Furniture App
    </a>
    <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
    {{-- <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
      </li>
    </ul> --}}
    <ul class="navbar-nav">
      <li class="nav-item dropdown mr-2">

        @if(Auth::check())

        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        Hi, {{ Auth::user()->name }}
      </a>
      <div class="dropdown-menu dropdown-menu-right" style="position: absolute;" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('product.index') }}">Products</a>
        <a class="dropdown-item" href="{{ route('category.index') }}">Categories</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
      </div>

      @else

      <a href="{{ route('register') }}" class="btn btn-outline-warning mr-2">Sign up</a>
      <a href="{{ route('login') }}" class="btn btn-warning mr-md-4">Login</a>

      @endif

    </li>
  </ul>
</nav>

<div class="container">
  <div class="row pt-5">
    <nav class="col-md-2 d-none d-md-block sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="/admin">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="/category">
              <span data-feather="file-text"></span>
              Category
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/">
              <span data-feather="file-text"></span>
              Front Site
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="col-md-10">
      <div class="row">
        @include('partials._messages')
      </div>
      <div class="row px-4">
        @yield('content')
      </div>
    </div>
  </div>
</div>
<!-- Custom Scripts -->
@yield('js')
</body>
</html>