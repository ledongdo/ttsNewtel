<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="{{url('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
        <div class="info">
            <a href="{{route('logout')}}" class="d-block">logout</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{route('users.index')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  User
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('roles.index')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Role
                </p>
              </a>
            </li>

            </ul>
    </div>
  </aside>