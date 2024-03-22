<x-layout>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Permissions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Permissions</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid"> 
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">List of Users</h3>  
        </div>  
        
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tblEmployees" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 50px !important;">Manage</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Status</th>
                        <!-- Add more headers if needed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activeEmployees as $employee)
                        <tr>
                            <td> 
                                <a href="{{ route('permissions.edit', $employee->Employee_ID) }}" class="btn btn-default btn-sm">
                                <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td>{{ $employee->Employee_ID }}</td>
                            <td><a href="{{ route('permissions.edit', $employee->Employee_ID) }}">{{ $employee->First_Name }} {{ $employee->Last_Name }}</a></td>
                            <td>{{ $employee->Department }}</td>
                            <td>{{ $employee->Position }}</td>
                            <td>{{ $employee->Employee_Status }}</td>  
                        </tr>
                    @endforeach
                </tbody> 
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>   

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
        $("#tblEmployees").DataTable({
            "aaSorting": [], 
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false, 
            "buttons": ["excel", "pdf", "print", "colvis"]
            
        }).buttons().container().appendTo('#tblEmployees_wrapper .col-md-6:eq(0)');

    });

    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const clientId = button.getAttribute('data-client-id');
                const deleteForm = document.querySelector(`#deleteForm${clientId}`);

                Swal.fire({
                    title: 'CONFIRMATION MESSAGE',
                    text: 'Do you want to delete this permission?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.submit();
                    }
                });
            });
        });
    });

</script>

</x-layout>
