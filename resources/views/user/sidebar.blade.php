 
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('/user') ? 'active' : '' }} " href="{{ url('/user') }}">
      <i class="nav-icon fas fa-tachometer-alt"></i>

      <p>Dashboard</p>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-user"></i>

      <p>Profile</p>
    </a>
  </li>


  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="far fa-calendar-check"></i>

      <p>Appointment</p>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-envelope-open-text"></i>

      <p>Mail</p>
    </a>
  </li>