{{-- order.blade.php --}}
<x-layout>
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Orders</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Orders Table -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Current Orders</h6>
        <button id="createOrder" class="btn btn-success float-right">Create New Order</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="ordersTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Client Name</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <!-- All other fields from the Client and Product tables -->
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {{-- Rows will be populated by the DataTables script --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Create/Edit Order Form Modal -->
    <div class="modal fade" id="orderFormModal" tabindex="-1" role="dialog" aria-labelledby="orderFormModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
    <h5 class="modal-title" id="orderFormModalLabel">Order Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="orderForm">
        @csrf
        <input type="hidden" id="order_id" name="order_id"> <!-- Hidden field for order ID (used in edit) -->
        <!-- Fields for order details -->
        <div class="form-group">
            <label for="client_id">Client ID:</label>
            <input type="text" class="form-control" id="client_id" name="client_id" required>
        </div>
        <!-- ... All other fields for the order ... -->
        <!-- Client details section -->
        <h4>Client Details</h4>
        <div class="form-group">
            <label for="company_name">Company Name:</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required>
        </div>
        <!-- ... All other fields for the client ... -->
        <!-- Product details section -->
        <h4>Product Details</h4>
        <div id="products_container">
            <!-- Product items will be dynamically added here -->
        </div>
        <button type="button" class="btn btn-info" id="addProductButton">Add Product</button>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
<script>
$(document).ready(function() {
    // DataTables Initialization
    var table = $('#ordersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.all') }}",
        columns: [
            { data: 'Order_ID' },
            { data: 'client.Name' },
            { data: 'client.Company_Name' },
            { data: 'client.Email' },
            { data: 'client.Phone_Number' },
            // Additional columns as needed
            {
                data: null,
                className: "dt-center",
                defaultContent: '<button class="btn btn-primary editor-edit">Edit</button> <button class="btn btn-danger editor-delete">Delete</button>',
                orderable: false
            }
        ]
    });

    // Dynamic Product Addition
    $('#addProductButton').click(function() {
        var productInput = `
            <div class="product-entry">
                <input type="text" class="form-control mb-2" name="products[]" placeholder="Product Name" required>
                <input type="number" class="form-control mb-2" name="quantities[]" placeholder="Quantity" required>
                <input type="number" class="form-control mb-2" name="prices[]" placeholder="Price" step="0.01" required>
                <button type="button" class="btn btn-danger removeProductButton">Remove</button>
            </div>`;
        $('#products_container').append(productInput);
    });

    // Remove Product Entry
    $(document).on('click', '.removeProductButton', function() {
        $(this).closest('.product-entry').remove();
    });

    // Form Submission for Creating/Updating Orders
    $('#orderForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var formUrl = $('#order_id').val() ? "{{ route('orders.update', ['order' => '']) }}/" + $('#order_id').val() : "{{ route('orders.store') }}";
        var formMethod = $('#order_id').val() ? 'PUT' : 'POST';

        $.ajax({
            url: formUrl,
            method: 'POST', // Always POST for compatibility with Laravel's method field
            data: formData + "&_method=" + formMethod, // Include method spoofing for PUT
            success: function(response) {
                $('#orderFormModal').modal('hide');
                table.ajax.reload(null, false); // Reload DataTable without resetting paging
                alert('Order saved successfully.');
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseJSON.message);
            }
        });
    });

    // Edit Button Click
    $('#ordersTable').on('click', 'button.editor-edit', function() {
        var data = table.row($(this).parents('tr')).data();
        // Populate form fields with data
        // Example:
        $('#order_id').val(data.Order_ID);
        // Populate other fields as needed
        $('#orderFormModal').modal('show');
    });

    // Delete Button Click
    $('#ordersTable').on('click', 'button.editor-delete', function() {
        var orderId = table.row($(this).parents('tr')).data().Order_ID;
        if (confirm('Are you sure you want to delete this order?')) {
            $.ajax({
                url: "{{ route('orders.destroy', ['order' => '']) }}/" + orderId,
                method: 'POST',
                data: {
                    "_method": "DELETE",
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    table.ajax.reload(null, false); // Reload DataTable without resetting paging
                    alert('Order deleted successfully.');
                },
                error: function(xhr) {
                    alert('An error occurred: ' + xhr.responseJSON.message);
                }
            });
        }
    });

    // Create New Order Button Click
    $('#createOrder').click(function() {
        $('#orderForm')[0].reset(); // Reset form fields
        $('#order_id').val(''); // Clear the order ID field for a new order
        $('#products_container').empty(); // Clear dynamically added product fields
        $('#orderFormModal').modal('show'); // Show the form modal
    });
});
</script>

