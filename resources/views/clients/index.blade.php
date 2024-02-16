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

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Clients</h3> <br><br>
                <button class="btn btn-primary" type="button" id="toggleClientFormButton">Add New Client</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                

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
            <!-- Add more headers if needed -->
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
        <!-- Add more data columns if needed -->
    </tr>
@endforeach

    </tbody>
</table>


                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>




<!-- Main content -->



<!-- New Client Form -->
<div id="newClientForm" class="new-client-form">
    <form action="{{ route('clients.store') }}" method="POST" class="client-form">
        @csrf
        <div class="form-group">
            <label for="Company_Name">Company Name:</label>
            <input type="text" id="Company_Name" name="Company_Name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Main_Contact">Main Contact:</label>
            <input type="text" id="Main_Contact" name="Main_Contact" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Lead_Status">Lead Status:</label>
            <input type="text" id="Lead_Status" name="Lead_Status" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Buyer_Status">Buyer Status:</label>
            <input type="text" id="Buyer_Status" name="Buyer_Status" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Shipping_Address">Shipping Address:</label>
            <input type="text" id="Shipping_Address" name="Shipping_Address" class="form-control" required>
        </div>
        <div class="form-group">
        <label for="Billing_Address">Billing Address:</label>
            <input type="text" id="Billing_Address" name="Billing_Address" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Phone_Number">Phone Number:</label>
            <input type="text" id="Phone_Number" name="Phone_Number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Email">Email:</label>
            <input type="email" id="Email" name="Email" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Confirm</button>
        </div>
    </form>
</div>
</div>





 

<script>
$(document).ready(function() {
     
     $("#example1").DataTable({
       "responsive": true, "lengthChange": false, "autoWidth": false,
       "buttons": ["excel", "pdf", "print", "colvis"]
     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 
    
     });

    function toggleClientForm() {
        var form = document.getElementById('newClientForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }

    document.getElementById('toggleClientFormButton').addEventListener('click', function() {
        var form = document.getElementById('newClientForm');
        form.classList.toggle('visible');
    });
</script>

 
<!-- Include this style block in your <head> section or an external stylesheet -->
<style>
    .new-client-form {
        display: none;
        margin-top: 1rem;
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .new-client-form.visible {
        display: block;
    }

    .client-form .form-group {
        margin-bottom: 1rem;
    }

    .client-form .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 0.5rem;
        
       line-height: 1.5;
        font-size: 1rem;
    }

    .client-form .form-control:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .client-form .btn-success {
        color: #fff;
        background-color: blue;
        border-color: #28a745;
    }

    .client-form .btn-success:hover {
        color: #fff;
        background-color: blue;
        border-color: #1e7e34;
    }
</style>
</x-layout>
