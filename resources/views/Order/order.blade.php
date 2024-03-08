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
                <a href="{{ route('orders.create') }}" class="btn btn-success">Create New Order</a>
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
                                <th>Order ID</th>
                                <th>Client ID</th>
                                <th>Created By</th>
                                <th>Request Date</th>
                                <th>Request Status</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Quotation Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->Order_ID }}</td>
                                    <td>{{ $order->Client_ID }}</td>
                                    <td>{{ $order->Created_By }}</td>
                                    <td>{{ optional($order->Request_DATE)->format('Y-m-d') ?: 'N/A' }}</td>
                                    <td>{{ $order->Request_Status }}</td>
                                    <td>{{ optional($order->Order_DATE)->format('Y-m-d') ?: 'N/A' }}</td>
                                    <td>{{ $order->Order_Status }}</td>
                                    <td>{{ optional($order->Quotation_DATE)->format('Y-m-d') ?: 'N/A' }}</td>
                                    <td>
                                    <!-- Inside your Orders Table -->
                                    <a href="/orders/{{ $order->Order_ID }}/profile" class="btn btn-info btn-sm">Edit</a>

                                    </td>
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
    $('#orders-table').DataTable({
        "pagingType": "full_numbers",
        "pageLength": 15,
        "lengthMenu": [15, 30, 45, 60],
        "ordering": true,
        "info": true,
        "responsive": true,
        "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            'colvis'
        ]
    });
});
</script>
