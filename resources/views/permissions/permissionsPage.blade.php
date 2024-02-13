<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Permissions</title>
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">

  <style>
    .details-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .details-list li {
        margin-bottom: 10px;
    }

    .details-list li p {
        margin: 0;
        color: #333;
    }

    #dataTable_filter {
        margin-bottom: 20px;
    }

    .summary-toggle {
        cursor: pointer;
        color: #007bff;
        text-decoration: underline;
    }

    .summary-toggle:hover {
        color: #0056b3;
    }

    .card-header {
        background-color: #4e73df;
        color: white;
    }

    .card-body {
        background-color: #f8f9fc;
    }

    .card {
        border: none;
    }
  </style>
</head>
<body>

<x-layout>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Permissions</h1>
    <p class="mb-4">Manage permissions for each page and view which employees have access.</p>

    <!-- Search Filter -->
    <div id="dataTable_filter" class="dataTables_filter">
      <label>Search Permissions:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label>
    </div>

    <!-- Permissions Table -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pages and Permissions</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Page ID</th>
                <th>Page Name</th>
                <th>Permissions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pages as $page)
                <tr>
                  <td>{{ $page->Page_ID }}</td>
                  <td>{{ $page->Page_Name }}</td>
                  <td>
                    <details>
                      <summary class="summary-toggle">View Permissions</summary>
                      <ul class="details-list">
                        @foreach ($page->permissions as $permission)
                          <li>
                            <p>Permission ID: {{ $permission->Permission_ID }}</p>
                            <p>Employee ID: {{ $permission->Employee_ID }}</p>
                            <p>Page ID: {{ $permission->Page_ID }}</p>
                            <p>Full Access: {{ $permission->Full_Control ? 'Yes' : 'No' }}</p>
                            <p>Read: {{ $permission->Read }}</p>
                            <!-- Display employee details -->
                            <p>Name: {{ $permission->employee->First_Name }} {{ $permission->employee->Last_Name }}</p>
                            <p>Department: {{ $permission->employee->Department }}</p>
                            <p>Position: {{ $permission->employee->Position }}</p>
                          </li>
                        @endforeach
                      </ul>
                    </details>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</x-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Make sure to include jQuery -->
<script>
$(document).ready(function() {
  $("#dataTable_filter input").on("keyup", function     var value = $(this).val().toLowerCase();
    $("#dataTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>
<script src="{{ asset('path/to/bootstrap.bundle.js') }}"></script> <!-- Bootstrap Bundle JS for Bootstrap components to function -->
</body>
</html>

