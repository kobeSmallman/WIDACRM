<x-layout> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">System Users</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid"> 
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of System Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <a class="btn btn-primary mb-3 mr-3" id="show-alert">Sample Alert</a>

                <a href="{{ route('systemusers.registration') }}" class="btn btn-primary mb-3">New Employee</a>

                <table id="tblSystemUsers" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 70px !important;">Manage</th>
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
                                    <a href="{{ route('systemusers.profile', $employee->Employee_ID) }}" class="btn btn-default btn-sm">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-sm">
                                    <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                </td>
                                <td>{{ $employee->Employee_ID }}</td>
                                <td>{{ $employee->First_Name }} {{ $employee->Last_Name }}</td>
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
</x-layout>


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

    $('.delete-vendor-btn').click(function() {
            var vendorId = $(this).data('id');
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: '/vendors/' + vendorId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        // Reload the page or remove the row from the table
                        table.row($(this).parents('tr')).remove().draw();
                    }
                });
            }
        });

    document.getElementById('show-alert').addEventListener('click', () => {
        Swal.fire({
            title: 'Hello, Laravel 10!',
            text: 'Sweetalert2 is now integrated into your Laravel 10 Vite project!',
            icon: 'success',
    });
});
</script>

