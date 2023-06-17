<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="csrf-token"
      content="{{ csrf_token() }}"
    />

    <title>@yield('title', $title ?? 'User Dashboard')</title>

    <link
      rel="stylesheet"
      href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('/vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}"
    />

    <link
      rel="stylesheet"
      href="{{ asset('/vendor/adminlte/dist/css/adminlte.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"
    />

    <link
      rel="shortcut icon"
      href="{{ asset('/favicons/favicon.ico') }}"
    />
    @yield('css')
  </head>

  <body class="layout-fixed layout-navbar-fixed sidebar-mini">
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
              <i class="fas fa-bars"></i>
              <span class="sr-only">Toggle navigation</span>
            </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>

          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <span> {{ auth()->user()?->name }} </span>
            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <li class="user-footer">
                <a
                  class="btn btn-default btn-flat float-right btn-block"
                  href="#"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                  <i class="fa fa-fw fa-power-off text-red"></i>
                  Log Out
                </a>
                <form
                  id="logout-form"
                  action="{{ route('logout') }}"
                  method="POST"
                  style="display: none"
                >
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="http://localhost:8000/home" class="brand-link">
          <img
            src="{{ config('adminlte.book') }}"
            alt="book"
            class="brand-image elevation-0"
            style="opacity: 0.8"
          />

          <span class="brand-text font-weight-light">
            {!! config('adminlte.logo') !!}
          </span>
        </a>

        <div class="sidebar">
          <nav class="pt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
            >
            @include('user.sidebar')
            </ul>
          </nav>
        </div>
      </aside>

      <div class="content-wrapper pt-3">
        <div class="content">
          <div class="container-fluid">
           @yield('content')
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('/vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
  </body>
</html>