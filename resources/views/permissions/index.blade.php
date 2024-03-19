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
            <h3 class="card-title mb-0">List of Permissions</h3> 
            <div class="ml-auto">
                <a href="" class="btn btn-primary">New Client</a>
            </div>
        </div>
 
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tblPermissions" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 70px !important;">Edit</th>
                        <th>Client Name</th>
                        <th>Main Contact</th>
                        <th>Shipping Address</th>
                        <th>Billing Address</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Lead Status</th>
                        <th>Buyer Status</th> 
                    </tr>
                </thead>
                <tbody>  
                    <tr>
                        <td>
                            <form id="" action=" " method="POST" style="display: inline;">
                           
                                <button type="button" class="btn btn-default btn-sm delete-btn" data-client-id=" ">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                        <td><a href=" "> </td>
                        <td> </td>  
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                            
                    </tr> 
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
        $("#tblPermissions").DataTable({
            "aaSorting": [],
            "columnDefs": [
                { "orderable": false, "targets": [0,4] }
            ],
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false, 
            "buttons": ["excel", "pdf", "print", "colvis"]
            
        }).buttons().container().appendTo('#tblPermissions_wrapper .col-md-6:eq(0)');

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
