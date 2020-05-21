<!-- Menu Lateral Esquerdo-->
<!-- Main Sidebar Container -->

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('painel.index')}}" class="brand-link">
      <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Projero Laravel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" >
          <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a>{{ $user -> name}}<br>
        <a href="" class="small">
        <small>{{ $user -> email}}</small> <br>
        <small>Membro desde {{ $user -> created_at }}</small></a>
        </a>
      </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('painel.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Painel 01</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link">
                  <i class="fa fa-home"></i>
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.lista')}}" class="nav-link">
                  <i class="fa fa-users"></i>
                  <p>Listar Usuarios</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.0" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
