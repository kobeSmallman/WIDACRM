<x-layout>
 <!-- Content Header (Page header) -->
    <!-- This section provides the header of the Clients page, displaying the title and breadcrumb navigation links. -->
<div class="content-header">
      <!-- Begin Page Content -->
    <!-- This section starts the main content area, including a card that lists all clients with functionality to add, edit, and delete them. -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Clients</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Clients</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid"> 
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">List of Clients</h3> 
            <div class="ml-auto">
                <a href="{{ route('clients.addClient') }}" class="btn btn-primary">Add New Client</a>
            </div>
        </div>
   <!-- Card Body -->
            <!-- This is where the clients are listed in a table format. Features include managing each client, such as editing or deleting their records. -->
        <div class="card-body">
            <table id="tblClients" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 70px !important;">Manage</th>
                        <th>Client Name</th>
                        <th>Main Contact</th>
                        <th>Shipping Address</th>
                        <th>Billing Address</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Lead Status</th>
                        <th>Buyer Status</th> 
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($clients as $client)
                        <tr>
                            <td>
                                <a href="{{ route('clients.editClient', $client->Client_ID)  }}" class="btn btn-default btn-sm" style="color: gray;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="deleteForm{{ $client->Client_ID }}" action="{{ route('clients.deleteClient', $client->Client_ID) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-default btn-sm delete-btn" data-client-id="{{ $client->Client_ID }}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('clients.editClient', $client->Client_ID) }}">
                                    {{ $client->Company_Name }} ({{ $client->Client_ID }})
                                </a>
                            </td>
                            <td>{{ $client->Main_Contact }}</td>
                            <td>{{ $client->Shipping_Address }}</td>
                            <td>{{ $client->Billing_Address }}</td>
                            <td>
                                <a href="mailto:{{ $client->Email }}?from={{ Auth::user()->Employee_Email }}">
                                    {{ $client->Email }}
                                </a>
                            </td>
                            <td>{{ $client->Phone_Number }}</td>
                            <td>{{ $client->Lead_Status }}</td>
                            <td>{{ $client->Buyer_Status }}</td>
                            <td>{{ $client->Remarks }}</td>
                                
                        </tr>
                        @endforeach
                </tbody> 
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>   
   <!-- Success Message -->
    <!-- JavaScript alert for displaying success messages using SweetAlert2, triggered by session status. -->
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

 <!-- Error Message -->
    <!-- JavaScript alert for displaying error messages using SweetAlert2, triggered by session status. -->
@if(session('error'))
    <script> 
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'ERROR MESSAGE',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif  
  <!-- DataTables Script -->
    <!-- Initialization script for DataTables. This script makes the table sortable, searchable, and paginated with additional buttons like export and print. -->

<script>

    $(document).ready(function() {   
        $("#tblClients").DataTable({
            "aaSorting": [],
            "columnDefs": [
                { "orderable": false, "targets": [0,4] }
            ],
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false, 
            "buttons": ["excel", "pdf", "print", "colvis"]
            
        }).buttons().container().appendTo('#tblClients_wrapper .col-md-6:eq(0)');

    });

    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const clientId = button.getAttribute('data-client-id');
                const deleteForm = document.querySelector(`#deleteForm${clientId}`);

                Swal.fire({
                    title: 'CONFIRMATION MESSAGE',
                    text: 'Do you want to delete this client?',
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
