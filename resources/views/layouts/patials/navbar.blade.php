<nav class="main-header navbar navbar-expand bg-color-secondary navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu text-white">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('u3.jpg') }}"
                class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline text-white">User name<span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-primary">
                <img src="{{ asset('u3.jpg') }}"
                class="img-circle elevation-2" alt="User Image">
                <p>
                  <small>mkcentral@gmail.com</small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        this.closest('form').submit();" class="btn btn-default btn-flat float-right">Déconnexion</a>
                </form>

              </li>
            </ul>
          </li>
    </ul>
</nav>
