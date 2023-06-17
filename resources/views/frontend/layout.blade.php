<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $title ?? config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}">
        <img src="{{ asset('images/booki.jpg') }}" class="nav-logo" alt="Logo">
        <span>Bookie</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('category') }}">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('new') }}">New Arrivals</a>
          </li>
        </ul>
        <form class="d-flex ms-auto" method="GET" action="{{ route('search') }}">
          <input class="form-control me-2" name="q" type="search" placeholder="Search" aria-label="Search" value="{{ request()->q ?? '' }}">
          <button class="btn btn-success" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </form>
        <ul class="navbar-nav ps-2">
          @auth
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.index') }}">
              Cart ({{ \App\Models\Cart::where('user_id',auth()->id())->count() }})
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @if(auth()->user()->role == "Admin")
              <li><a class="dropdown-item" href="{{ route('admin.index') }}">Admin</a></li>
              @else
              <li><a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a></li>
              <li><a class="dropdown-item" href="{{ route('profile.orders') }}">My Orders</a></li>
              @endif
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#!" onclick="document.getElementById('logout-form').submit()">Log Out</a></li>
            </ul>

            <form id="logout-form" style="display: none" action="{{ route('logout') }}" method="post">
              @csrf
            </form>
          </li>
          @else
          <li class="nav-item me-2">
            <a class="btn btn-info" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-warning" href="{{ route('register') }}">Register</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

    @yield('content')

    <footer class="pt-2 pb-4 bg-black text-light px-5 mt-4">
        <div class="container">
            <div class="row pt-4">
                <div class="col-md-4 col-sm-12 col-12 pb-3">
                 
                    <h5> <img src="{{ asset('images/booki.jpg') }}" class="nav-logo" alt="Logo">-
                      ABOUT BOOKie</h5>
                    <p style="text-align: justify">Bookie is an online bookstore,
                        physically based in Chitwan, Nepal, with
                        an aim to create the largest community
                        of book readers in Nepal.News and events
                        At Bookie, you can browse and buy books online at the lowest everyday prices.</p>
                </div>
                <div class="col-md-4 col-sm-6 col-6 pb-3">
                    <h5>QUICK LINKS</h5>
                    <ul>
                        <li><a href="{{ route('category') }}">All Categories</a></li>
                        <li><a href="{{ route('new') }}">New Arrivals</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6 col-6">
                    <h5>OTHERS</h5>
                    <ul>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/contact">Contact Us</a></li>
                    </ul>

                </div>




            </div>
        </div>




        <hr class="mb-3" />
        <div class="text-center">
            &copy; {{ date("Y") }} - Bookie
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>