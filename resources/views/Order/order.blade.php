<x-layout>
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="mb-3">
                <a href="{{ route('orders.create') }}" class="btn btn-primary">Create New Order</a>
            </div>

            <!-- Orders Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Orders</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="orders-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Manage</th>
                                <th>Order ID</th>
                                <th>Client ID</th>
                                <th>Created By</th>
                                <th>Request Date</th>
                                <th>Request Status</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Quotation Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                            <td>
                            <a href="{{ route('orders.profile', $order->Order_ID) }}" class="btn btn-default btn-sm" style="color: gray;">
        <i class="fas fa-edit"></i>
    </a>
    <!-- Delete button -->
    <button type="button" class="btn btn-default btn-sm delete-order-btn" data-id="{{ $order->Order_ID }}" style="color: gray;">
        <i class="fas fa-trash"></i>
    </button>
</td>
<td>  <a href="{{ route('orders.profile', $order->Order_ID) }}">{{ $order->Order_ID }}</a></td>
    <td>{{ $order->client->Company_Name ?? 'Unknown Client' }} ({{ $order->Client_ID }})</td>
    <td>{{ optional($order->creator)->First_Name ?? 'Unknown' }} ({{ $order->Created_By }})</td>
    <td>{{ optional($order->Request_DATE)->format('Y-m-d') ?: 'N/A' }}</td>
    <td>{{ $order->Request_Status }}</td>
    <td>{{ optional($order->Order_DATE)->format('Y-m-d') ?: 'N/A' }}</td>
    <td>{{ $order->Order_Status }}</td>
    <td>{{ optional($order->Quotation_DATE)->format('Y-m-d') ?: 'N/A' }}</td>
</tr>
@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</x-layout>

<script>
$(document).ready(function() {
    var table = $('#orders-table').DataTable({
        "pagingType": "full_numbers",
        "pageLength": 15,
        "lengthMenu": [15, 30, 45, 60],
        "ordering": true,
        "info": true,
        "responsive": true,
        "dom": 'lBfrtip',
        "buttons": ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"]
    });

    $('.delete-order-btn').click(function() {
        var orderId = $(this).data('id');
        if (confirm('Are you sure you want to delete this order?')) {
            // Implement the delete functionality here
            // For example, using AJAX to send a request to your Laravel backend
            console.log("Deleting order ID: " + orderId);
            // Refresh or update the DataTable row here after successful deletion
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('.delete-order-btn').click(function(e) {
        e.preventDefault();
        var orderId = $(this).data('id');
        var token = $("meta[name='csrf-token']").attr("content");

        if (confirm('Are you sure you want to delete this order and its related products?')) {
            $.ajax({
                url: "/orders/" + orderId,
                type: 'DELETE',
                data: {
                    "id": orderId,
                    "_token": token,
                },
                success: function(response) {
                    alert('Order deleted successfully');
                    location.reload(); // Or you can remove the row from the DataTable without reloading
                },
                error: function(response) {
                    alert('Failed to delete the order');
                }
            });
        }
    });
});
</script>
