<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRM | WIDA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ (auth()->user()->Role_ID == 1) ? route('admin.dashboard') : route('employee.dashboard') }}" class="brand-link">
    <img src="dist/img/WIDALogo.png" alt="WIDA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">CRM</span>
</a>


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Link to User Profile -->
        <!-- Sidebar user panel (optional) -->

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if ($employee->profile_image)
            <img class="profile-user-img img-fluid img-circle"
              src="data:image/jpeg;base64,{{ $employee->profile_image }}" alt="User profile picture">
            @else
            <img class="profile-user-img img-fluid img-circle" src="{{ asset('default/path/to/default_image.jpg') }}"
              alt="Default profile picture">
            @endif

          </div>

          <div class="info">
            <a href="{{ route('profile', ['employee' => Auth::user()->Employee_ID]) }}" class="username">
              {{ Auth::user()->First_Name }} {{ Auth::user()->Last_Name }}
            </a>
          </div>
          <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-default btn-flat">Sign out</button>
        </form>
    </div>
        </div>


        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-open">
    @php
        $dashboardRoute = (auth()->user()->Role_ID == 1) ? 'admin.dashboard' : 'employee.dashboard';
    @endphp
    <a href="{{ route($dashboardRoute) }}" class="nav-link">
        <i class="nav-icon fa-solid fa-house"></i>
        <p>Home</p>
    </a>
</li>


            <li class="nav-header">TRANSACTION</li>
     
<li class="nav-item">
    <a href="{{ route('clients.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Clients</p>
    </a>
</li>

            <li class="nav-item">
      
            <a href="{{ route('createRequest') }}" class="nav-link">
    <i class="nav-icon fa-solid fa-ticket"></i>
    <p>Requests</p>
</a>

</li>


            <li class="nav-item">
    <a href="{{ route('takeNotes') }}" class="nav-link">
        <i class="nav-icon fa-solid fa-note-sticky"></i>
        <p>Notes</p>
    </a>
</li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-solid fa-box"></i>
                <p>
                  Vendors
                </p>
              </a>

            </li>

            <li class="nav-header">ADMINISTRATION</li>
            <li class="nav-item">
              <a href="{{ route('system-users') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-address-card"></i>
                <p>
                  System Users
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li>


            <li class="nav-item">
    <a href="{{ route('permissions') }}" class="nav-link">
        <i class="nav-icon fa-solid fa-user-lock"></i>
        <p>Permissions</p>
    </a>
</li>


            <li class="nav-header">REPORTS</li>
              <li class="nav-item">
              <a href="{{ route('clientsummary.index') }}" class="nav-link">
                  <i class="nav-icon fa-solid fa-table-list"></i>
                  <p>Client Summary</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('ordersummary.index') }}" class="nav-link">
                  <i class="nav-icon fa-solid fa-table-list"></i>
                  <p>Order Summary</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('vendorsummary.index') }}" class="nav-link">
                  <i class="nav-icon fa-solid fa-table-list"></i>
                  <p>Vendor Summary</p>
                </a>
              </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">        
          {{ $slot }}
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2024 <a href="">Hexabridge Technologies</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 0.0.1


      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->



  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


  <!-- JavaScript to dynamically add active class to the navigation link -->


  <script>

  $(document).ready(function() {
    var currentRoute = "{{ Route::currentRouteName() }}";
    console.log("Current Route: ", currentRoute);

    // Extract the part before the dot (.)
    var currentRouteWithoutIndex = currentRoute.split('.')[0];

    $('.nav-link').each(function() {
        var href = $(this).attr('href');
        console.log("Href: ", href);

        // Check if the href contains the currentRoute without the '.index'
        if (currentRouteWithoutIndex && href && href.includes(currentRouteWithoutIndex)) {
            $(this).addClass('active');
        }
    });
});
  </script>





</body>

</html>