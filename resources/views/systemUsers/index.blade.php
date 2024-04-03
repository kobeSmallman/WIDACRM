<x-layout> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">System Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li> 
                        <li class="breadcrumb-item active">System Users</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
 
    <div class="container-fluid"> 
        <div class="card"> 
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">List of System Users</h3> 
                <div class="ml-auto">
                    <a href="{{ route('systemusers.registration') }}" class="btn btn-primary">New Employee</a>
                </div>
            </div>
  
            <div class="card-body"> 
                <table id="tblSystemUsers" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 70px !important;">Manage</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th>Status</th>
                            <!-- Add more headers if needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeEmployees as $employee)
                            <tr>
                                <td> 
                                    <a href="{{ route('systemusers.profile', $employee->Employee_ID) }}" class="btn btn-default btn-sm">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <!-- <a href="#" class="btn btn-default btn-sm">
                                    <i class="fa-regular fa-trash-can"></i>
                                    </a> -->
                                </td>
                                <td>{{ $employee->Employee_ID }}</td>
                                <td><a href="{{ route('systemusers.profile', $employee->Employee_ID) }}">{{ $employee->First_Name }} {{ $employee->Last_Name }}</a></td>
                                <td>{{ $employee->Department }}</td>
                                <td>{{ $employee->Position }}</td>
                                <td>{{ $employee->Employee_Email }}</td>
                                <td>{{ $employee->Employee_Status }}</td>  
                            </tr>
                        @endforeach
                    </tbody> 
                </table>
            </div> 
        </div>
    </div>      

</x-layout>


@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'INFORMATION MESSAGE',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif  

<script> 
   $(document).ready(function() {   
        $("#tblSystemUsers").DataTable({
            "aaSorting": [],
            "columnDefs": [
                { "orderable": false, "targets": [0,4] }
            ],
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false, 
            "buttons": ["excel", "pdf", "print", "colvis"]
            
        }).buttons().container().appendTo('#tblSystemUsers_wrapper .col-md-6:eq(0)');

    });

     
</script>

