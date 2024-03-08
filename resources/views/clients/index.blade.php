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
            <a href="{{ route('clients.addClient') }}" class="btn btn-primary mb-3">New Client</a>
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
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($clients as $client)
                        <tr>
                            <td> 
                                <a href="" class="btn btn-default btn-sm">
                                <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="btn btn-default btn-sm">
                                <i class="fa-regular fa-trash-can"></i>
                                </a>
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

<!-- 
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Main Contact</th>
                <th>Shipping Address</th>
                <th>Billing Address</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Lead Status</th>
                <th>Buyer Status</th>
                <th>Orders</th> {{-- New column for orders --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->Company_Name }}</td>
                <td>{{ $client->Main_Contact }}</td>
                <td>{{ $client->Shipping_Address }}</td>
                <td>{{ $client->Billing_Address }}</td>
                <td>{{ $client->Email }}</td>
                <td>{{ $client->Phone_Number }}</td>
                <td>{{ $client->Lead_Status }}</td>
                <td>{{ $client->Buyer_Status }}</td>
                <td>
                    @foreach ($client->orders as $order)
                        <details>
                            <summary>Order ID: {{ $order->Order_ID }}</summary>
                            <div>
                                @foreach ($order->products as $product)
                                    <p>{{ $product->Product_Name }} - Quantity: {{ $product->Quantity }}</p>
                                @endforeach
                            </div>
                        </details>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> -->

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

</script>

</x-layout>
