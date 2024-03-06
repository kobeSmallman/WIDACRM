<!DOCTYPE html>
<html lang="en">

<head>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WIDACRM</title>
  <link rel="icon" type="image/x-icon" href="dist/img/WIDA/WIDA.ico">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,700&display=fallback">

  <!-- Google Font: Montserrat -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">



  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  @stack('scripts')
</head>


<body class="hold-transition sidebar-mini {{ session('dark_mode') ? 'dark-mode' : '' }}">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars" style="transform: rotate(90deg);"></i>
          </a>

        </li>

      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- User Account Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            @if ($employee->profile_image)
            <img src="data:image/jpeg;base64,{{ $employee->profile_image }}" class="user-image img-circle elevation-2" alt="User Image" style="width: 32px; height: 32px; object-fit: cover;">
            @else
            <img src="{{ asset('default/path/to/default_image.jpg') }}" class="user-image img-circle elevation-2" alt="User Image" style="width: 32px; height: 32px; object-fit: cover;">
            @endif
            <span>{{ Auth::user()->First_Name }} {{ Auth::user()->Last_Name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <!-- Dropdown links -->
            <a href="{{ route('profile', ['employee' => Auth::user()->Employee_ID]) }}" class="dropdown-item">
              <i class="fas fa-user-edit mr-2"></i> Edit Profile
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-inbox mr-2"></i> Inbox
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-tasks mr-2"></i> Tasks
            </a>
            <a href="#" class="dropdown-item">
              <i class="fas fa-comments mr-2"></i> Chats
            </a>
            <a href="{{ route('site.settings') }}" class="dropdown-item">
              <i class="fas fa-comments mr-2"></i> Settings
            </a>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ (auth()->user()->Role_ID == 1) ? route('admin.dashboard') : route('employee.dashboard') }}" class="brand-link">
        <img src="dist/img/WIDA/wida100x100.png" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold" style="color: #5a75f7">WIDA</span>
        <span class="brand-text font-weight-normal" style="margin-left:-4px">CRM</span>
      </a>


      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              @php
              $dashboardRoute = (auth()->user()->Role_ID == 1) ? 'admin.dashboard' : 'employee.dashboard';
              @endphp
              <a href="{{ route($dashboardRoute) }}" class="nav-link" style="margin-top: 10px; margin-bottom: 10px;">
                <i class="nav-icon fa-solid fa-house"></i>
                <p>Dashboard</p>
              </a>
            </li>


            <li class="nav-header">TRANSACTION</li>

            <li class="nav-item">
              <a href="{{ route('clients.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Clients</p>
              </a>



            <li class="nav-item">
              <a href="{{ route('notes.create') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-note-sticky"></i>
                <p>Notes</p>
              </a>
            </li>



            <li class="nav-item">

              <a href="{{ route('orders.index') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-ticket"></i>
                <p>Orders</p>
              </a>

            </li>
            <!-- Update this in your sidebar menu blade file where you list your navigation links -->

            <li class="nav-item">
              <a href="{{ route('vendors.index') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-box"></i>
                <p>Vendors</p>
              </a>
            </li>


            <li class="nav-header">ADMINISTRATION</li>
            <li class="nav-item">
              <a href="{{ route('system-users') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-address-card"></i>
                <p>
                  System Users
                  <span class="badge badge-info right"></span>
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
            <li class="nav-item">
    <a href="{{ route('faq.show') }}" class="nav-link">
        <i class="nav-icon fas fa-question-circle"></i>
        <p>FAQ</p>
    </a>
</li>

          </ul>
          
        </nav>
        <!-- /.sidebar-menu -->

        <!-- Button to Open Modal -->
        <div id="noteModal" class="modal" style="display:none;">
          <div class="modal-content">
            <div class="modal-header" id="dragHandle">Drag me</div>
            <span class="close">&times;</span>
            <textarea id="noteContent" style="width:100%; height:200px;"></textarea>
            <button onclick="saveNote()">Save Note</button>
          </div>
        </div>
        <button id="myBtn">Take Note</button>

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
      <strong>Copyright &copy; 2024 <a href="" style="color: #5a75f7">Hexabridge Technologies</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 0.0.1


      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->



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
    // Example with jQuery AJAX


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

    // Add an event listener for when the DOM content is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
      // Get references to the modal elements
      const modal = document.getElementById("noteModal"); // The modal dialog
      const btn = document.getElementById("myBtn"); // The button that opens the modal
      const span = document.getElementsByClassName("close")[0]; // The 'close' button inside the modal
      const noteContent = document.getElementById("noteContent"); // The textarea for note content
      const dragHandle = document.getElementById("dragHandle"); // The draggable area at the top of the modal

      // Opens the modal window
      function openModal() {
        modal.style.display = "block"; // Show the modal
        const savedNote = localStorage.getItem('savedNote'); // Retrieve saved note content from localStorage
        if (savedNote) {
          noteContent.value = savedNote; // If there is saved content, display it in the textarea
        }
        localStorage.setItem('modalState', 'open'); // Save the state of the modal as open
      }

      // Automatically open the modal if it was previously left open
      if (localStorage.getItem('modalState') === 'open') {
        openModal();
      }

      // Closes the modal window
      function closeModal() {
        modal.style.display = "none"; // Hide the modal
        // Optionally update modalState in localStorage here if desired
        localStorage.setItem('modalState', 'closed'); // Consider adding this line if you want to explicitly set the modal's state to closed
      }

      // Event listeners for opening and closing the modal
      btn.onclick = openModal; // When the 'Take Note' button is clicked, open the modal
      span.onclick = closeModal; // When the 'close' span is clicked, close the modal

      // Close the modal if the user clicks outside of it
      window.onclick = function(event) {
        if (event.target === modal) {
          closeModal();
        }
      }

      // Save the note content to localStorage and close the modal
      window.saveNote = function() {
        console.log('Note saved:', noteContent.value); // Log the saved note for debugging
        localStorage.removeItem('savedNote'); // Clear previous saved note
        closeModal(); // Close the modal
      }

      // Autosave note content as the user types
      noteContent.addEventListener('input', function() {
        localStorage.setItem('savedNote', noteContent.value); // Save current content to localStorage
      });

      // Dragging functionality for the modal
      let isDragging = false; // Flag to track dragging state

      // Allow the modal to be dragged by the mouse
      dragHandle.addEventListener('mousedown', function(e) {
        let shiftX = e.clientX - modal.offsetLeft; // Horizontal position where the drag started
        let shiftY = e.clientY - modal.offsetTop; // Vertical position where the drag started

        // Function to move the modal as the mouse is moved
        function onMouseMove(e) {
          modal.style.left = e.pageX - shiftX + 'px';
          modal.style.top = e.pageY - shiftY + 'px';
        }

        // Stop moving the modal when the mouse button is released
        function onMouseUp() {
          document.removeEventListener('mousemove', onMouseMove);
          modal.onmouseup = null;
          isDragging = false; // Reset dragging state
        }

        // Attach event listeners for moving and stopping
        document.addEventListener('mousemove', onMouseMove);
        document.addEventListener('mouseup', onMouseUp, {
          once: true
        });

        e.preventDefault(); // Prevent default drag behavior
      });

      // Prevent the modal content from being selected during drag
      dragHandle.ondragstart = function() {
        return false;
      };

      // Re-open the modal if it was previously open (useful for page reloads)
      if (localStorage.getItem('modalState') === 'open') {
        openModal();
      }
    });
  </script>



  @vite(['resources/js/app.js'])

  {{-- Stack for pushing additional scripts specific to a page --}}
  @stack('scripts')
</body>

</html>

<style>
  .modal {
    display: none;
    /* Initially hidden */
    position: fixed;
    /* Fixed positioning relative to the viewport */
    z-index: 1;
    /* Ensures modal is on top of other content */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Allows scrolling if modal content is too tall */
  }

  .modal-content {
    background-color: #fefefe;
    /* White background */
    margin: 15% auto;
    /* Centered vertically and horizontally */
    padding: 20px;
    /* Padding around the content */
    border: 1px solid #888;
    /* Gray border */
    width: 50%;
    /* Half the width of the viewport */
    position: absolute;
    /* Absolute positioning within the modal */
    left: 50%;
    /* Horizontally centered */
    top: 50%;
    /* Vertically centered */
    transform: translate(-50%, -50%);
    /* Adjust the position to truly center the element */
  }

  .modal-header {
    cursor: move;
    /* Indicates the header is draggable */
    padding: 10px;
    /* Padding inside the header */
    background-color: #f3f3f3;
    /* Light gray background */
    color: #333;
    /* Dark text color */
    width: 100%;
    /* Full width of the modal-content */
  }

  .close {
    color: #aaa;
    /* Light gray 'x' button */
    float: right;
    /* Positioned to the right */
    font-size: 28px;
    /* Large 'x' icon */
    font-weight: bold;
    /* Make 'x' bold */
  }

  .close:hover,
  .close:focus {
    color: black;
    /* Darken 'x' on hover/focus */
    text-decoration: none;
    /* No underline */
    cursor: pointer;
    /* Pointer cursor on hover/focus */
  }
</style>