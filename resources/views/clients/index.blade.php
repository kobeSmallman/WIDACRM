<x-layout>

<!-- Content Header (Page header) -->
<div class="content-header">
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
        <div class="card-header">
            <h3 class="card-title">List of Clients</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <a href="{{ route('clients.addClient') }}" class="btn btn-primary mb-3">Add New Client</a>
            <table id="tblClients" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 70px !important;">Delete</th>
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
                            <td><a href="{{ route('clients.editClient', $client->Client_ID) }}">{{ $client->Company_Name }}</td>
                            <td>{{ $client->Main_Contact }}</td>
                            <td>{{ $client->Shipping_Address }}</td>
                            <td>{{ $client->Billing_Address }}</td>
                            <td>{{ $client->Email }}</td>
                            <td>{{ $client->Phone_Number }}</td>
                            <td>{{ $client->Lead_Status }}</td>
                            <td>{{ $client->Buyer_Status }}</td>
                                
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
