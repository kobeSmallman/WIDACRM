<!DOCTYPE html>
<html lang="en">

<head>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WIDACRM</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/WIDA/WIDA.ico') }}">

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

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">

  <!-- Page IDs -->
  @php
  $clientPageId = 1;
  $vendorPageId = 2;
  $notesPageId = 3;
  $ordersPageId = 4;
  $paymentsPageId = 5;
  $systemUsersPageId = 6;
  $permissionsPageId = 7;
  $reportsPageId = 8;
  $EmployeeActivityId = 9;

  $administrationPages = [$systemUsersPageId, $permissionsPageId,  $EmployeeActivityId];
  $transactionPages = [$clientPageId, $vendorPageId, $notesPageId, $ordersPageId, $paymentsPageId, $reportsPageId];
  @endphp


  @vite('resources/js/app.js')
  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  @stack('scripts')
 
    
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
background-color: #fefefe; /* White background */
margin: 5% auto; /* Centered vertically and horizontally */
padding: 20px; /* Padding around the content */
border: 1px solid #888; /* Gray border */
width: 70%; /* Width of the content relative to viewport width */
box-sizing: border-box; /* Include padding and border in the element's width and height */
resize: both; /* Allow the element size to be changed */
overflow: auto; /* Allow scrolling within the modal */
max-height: 80vh; /* Maximum height of the modal content */
}

.modal-header {
cursor: move; /* Indicates the header is draggable */
padding: 10px; /* Padding inside the header */
background-color: #5D6D7E; /* Color that blends with the sidebar */
color: white; /* White text color for contrast */
width: 100%; /* Full width of the modal-content */
box-sizing: border-box; /* Include padding in the element's width */
}

.close {
color: black; /* White 'x' button for contrast */
float: right; /* Positioned to the right */
font-size: 28px; /* Large 'x' icon */
font-weight: bold; /* Make 'x' bold */
}

.close:hover,
.close:focus {
  color: red;
  /* Darken 'x' on hover/focus */
  text-decoration: none;
  /* No underline */
  cursor: pointer;
  /* Pointer cursor on hover/focus */
}

/* Button styles */
#myBtn {
  display: block; /* The button should take the full width of the sidebar */ 
  margin: 10px auto; /* Center the button with some margin above and below */
  transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out; /* Smooth transitions for hover effects */
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* Subtle shadow to lift the button off the sidebar */
  width: 70%; /* Set a specific width */
}

#myBtn:hover { 
transform: translateY(-2px); /* Small lift effect on hover */
box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.3); /* Enhanced shadow on hover for a "pop" effect */
}
 /* Assuming the sidebar width threshold is 50px */
/* Hide text if the viewport width indicates the sidebar is likely collapsed */

/* Show the button text when the sidebar is expanded or hovered. This is specifically for the New Note label */
#myBtn:hover .btn-text {
    display: inline;
}

/* This assumes the sidebar-collapse class is added to the body when the sidebar is collapsed. This is specifically for the New Note label*/
body.sidebar-collapse .btn-text {
    display: none; /* Hide the text */
}

</style>
</head>


<body class="hold-transition sidebar-mini layout-fixed {{ session('dark_mode') ? 'dark-mode' : '' }}">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
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

            <a href="mailto:{{ Auth::user()->Employee_Email }}" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> Email
            </a>


            <a href="{{ route('site.settings') }}" class="dropdown-item">
              <i class="fas fa-cog mr-2"></i> Settings
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
        <img src="{{ asset('dist/img/WIDA/wida100x100.png') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
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

            <!-- Administration Category -->
            @if(collect($administrationPages)->intersect($employee->permissions->pluck('Page_ID'))->count() > 0)
            <li class="nav-header">ADMINISTRATION</li>

            @if($employee->permissions->contains('Page_ID', $systemUsersPageId))
            <li class="nav-item">
              <a href="{{ route('systemusers') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-address-card"></i>
                <p>System Users</p>
              </a>
            </li>
            @endif

            @if($employee->permissions->contains('Page_ID', $permissionsPageId))
            <li class="nav-item">
              <a href="{{ route('permissions') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-user-lock"></i>
                <p>Permissions</p>
              </a>
            </li>
            @endif


            @if($employee->permissions->contains('Page_ID', $EmployeeActivityId)) 
            <li class="nav-item">
              <a href="{{ route('employee-activity') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-user-clock"></i>
                <p>Employee Activity</p>
              </a>
            </li>
            @endif

         
            @endif



            @if(collect($transactionPages)->intersect($employee->permissions->pluck('Page_ID'))->count() > 0)
            <li class="nav-header">TRANSACTIONS</li>

            @if($employee->permissions->contains('Page_ID', $clientPageId))
            <li class="nav-item">
              <a href="{{ route('clients') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Clients</p>
              </a>
            </li>
            @endif


            @if($employee->permissions->contains('Page_ID', $vendorPageId))
            <li class="nav-item">
              <a href="{{ route('vendors.index') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-box"></i>
                <p>Vendors</p>
              </a>
            </li>
            @endif

            @if($employee->permissions->contains('Page_ID', $notesPageId))
            <li class="nav-item">
              <a href="{{ route('notes.create') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-note-sticky"></i>
                <p>Notes</p>
              </a>
            </li>
            @endif

            @if($employee->permissions->contains('Page_ID', $ordersPageId))
            <li class="nav-item">
              <a href="{{ route('orders.index') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-ticket"></i>
                <p>Orders</p>
              </a>
            </li>
            @endif

            @if($employee->permissions->contains('Page_ID', $paymentsPageId))
            <li class="nav-item">
              <a href="{{ route('payment.index') }}" class="nav-link">
                <i class="nav-icon fas fa-regular fa-credit-card"></i>
                <p>Payments</p>
              </a>
            </li>
            @endif
            @endif
            @if($employee->permissions->contains('Page_ID', $reportsPageId))
            <li class="nav-header">REPORTS</li>
            <li class="nav-item">
              <a href="{{ route('reports.index') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-file-contract"></i>
                <p>Reports</p>
              </a>
            </li>
            @endif
            <li class="nav-header">OTHERS</li>

            <li class="nav-item">
              <a href="{{ route('agreement.show') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-file-contract"></i>
                <p>Agreement Form</p>
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
            <div class="modal-header" id="dragHandle">Click and hold to drag</div>
            <span class="close">&times;</span>

            <!-- Note Title Input --> 
            <div class="row">
              <label for="noteTitle" class="col-sm-2 col-form-label text-right">Title:</label>
              <div class="col-sm-9">
                <input type="text" id="noteTitle" name="noteTitle" class="form-control" placeholder="Enter note title" style="width:100%;" />
              </div>
            </div> 

            <!-- Client Selection Dropdown --> 
            <div class="row mt-2">
              <label for="clientSelect" class="col-sm-2 col-form-label text-right">Client:</label> 
              <div class="col-sm-9">
                <select id="clientSelect" class="form-control">
                  <option value="">Select a client</option> 

                  @foreach ($clients as $client)
                  <option value="{{ $client->Client_ID }}">{{ $client->Company_Name }}</option>
                  @endforeach
                </select> 
              </div>
            </div> 
             
            <!-- Interaction Type Dropdown -->
            <div class="row mt-2"> 
              <label for="interactionType" class="col-sm-2 col-form-label text-right">Interaction:</label>
              <div class="col-sm-9">
                <select id="interactionType" class="form-control">
                  <option value="">Select an interaction type</option>
                  <option value="call">Call</option>
                  <option value="email">Email</option>
                  <option value="in_person">In Person</option>
                </select>
              </div>
            </div> 
 
            <input type="hidden" id="createdBy" name="createdBy" value="{{ auth()->user()->Employee_ID }}">

            <!-- Image Upload --> 
            <div class="row mt-2">
              <label for="imageUpload" class="col-sm-2 col-form-label text-right">Image:</label>
              <div class="col-sm-9">
                <input type="file" id="imageUpload" class="form-control" multiple="">
              </div>
            </div>  

            <!-- Note Content --> 
            <div class="row mt-2">
              <label for="noteContent" class="col-sm-2 col-form-label text-right">Note:</label>
              <div class="col-sm-9">
                 <textarea id="noteContent" class="form-control" rows="6"></textarea>
              </div>
            </div> 
 
            <div class="row mt-2">
              <label class="col-sm-2"></label>
              <div class="col-sm-9">
                <button class="btn btn-primary" onclick="saveNote()" style="width: 100%">Save Note</button>
              </div>
            </div>  

          </div>
        </div>
    <button id="myBtn" class="btn btn-primary">
    <i class="fa-solid fa-pen-to-square"></i> <span class="btn-text">New Note</span>
  </button> 



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

  <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
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

 <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>



  <!-- JavaScript to dynamically add active class to the navigation link -->


  <script> 
    $(function () {
        bsCustomFileInput.init();
    });
 
    $(document).ready(function() {
      var currentRoute = "{{ Route::currentRouteName() }}";

      // Extract the part before the dot (.)
      var currentRouteWithoutIndex = currentRoute.split('.')[0];

      $('.nav-link').each(function() {
        var href = $(this).attr('href');

        // Check if the href contains the currentRoute without the '.index'
        if (currentRouteWithoutIndex && href && href.includes(currentRouteWithoutIndex)) {
          $(this).addClass('active');
        }
      });
    });

    // Add an event listener for when the DOM content is fully loaded ///// This is for the notes 
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
    const clientSelect = document.getElementById('clientSelect').value;
    const interactionType = document.getElementById('interactionType').value;
    const createdBy = document.getElementById('createdBy').value;
    const noteText = document.getElementById('noteContent').value; // Ensure to reference this correctly
    const imageFiles = document.getElementById('imageUpload').files;
    const noteTitle = document.getElementById('noteTitle').value;

    // Validation
    if (!clientSelect || !interactionType || !createdBy || !noteText) {
        alert('Please fill in all fields.');
        return false;
    }

    // Create FormData object to send data as form/multipart
    const formData = new FormData();
    formData.append('Client_ID', clientSelect);
    formData.append('Interaction_Type', interactionType);
    formData.append('Created_By', createdBy);
    formData.append('Description', noteText);
    formData.append('Title', noteTitle);

    // Send a POST request with the form data
    fetch('/notes/store', { // Ensure the URL is correct for your application's routing
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token header
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Success', 'The note has been saved successfully.', 'success');
            // Check if there are any image files to upload
            if (imageFiles.length > 0 && data.noteId) {
                const imageFormData = new FormData();
                for (let i = 0; i < imageFiles.length; i++) {
                    imageFormData.append('images[]', imageFiles[i]);
                }
                // Proceed to upload images
                return fetch(`/notes/${data.noteId}/images`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Include CSRF token header
                    },
                    body: imageFormData
                })
                .then(imageResponse => imageResponse.json())
                .then(imageData => {
                    if (imageData.success) {
                        console.log('Images uploaded successfully');
                    } else {
                        throw new Error('Image upload failed: ' + imageData.message);
                    }
                });
            } else {
                console.log('No images to upload.');
                return Promise.resolve({ success: true, message: "No images to upload." }); // Successfully resolve if no images
            }
        } else {
            throw new Error('Note saving failed: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'There was a problem saving the note or uploading images.', 'error');
    });

    // Prevent form from submitting normally
    return false;

        // Clear the saved note content as it's now been saved
        try {
            localStorage.removeItem('savedNote');
            localStorage.setItem('modalState', 'closed');  
        } catch (error) { 
             
        } 

        // Close the modal
        closeModal();
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
