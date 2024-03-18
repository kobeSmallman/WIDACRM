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
    <div class="card-body">
        <div id="toggle-filters" style="display: none;">
            <!-- Filter Form Row -->
            <div class="row filters-row">
                <!-- Request Status Filter -->
                <div class="col-sm-3 filter-col">
                    <div class="form-group">
                        <label>Request Status:</label>
                        <select class="form-control select2" id="Request_Status">
                            <option value="">All</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <!-- Order Status Filter -->
                <div class="col-sm-3 filter-col">
                    <div class="form-group">
                        <label>Order Status:</label>
                        <select class="form-control select2" id="Order_Status">
                            <option value="">All</option>
                            <option value="Completed">Completed</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <!-- Created By Filter -->
                <div class="col-sm-3 filter-col">
                    <div class="form-group">
                        <label>Created By:</label>
                        <input type="text" class="form-control" id="Created_By" placeholder="Creator's Name">
                    </div>
                </div>
                <!-- Date Range Filter for Request Date -->
                <div class="col-sm-3 filter-col">
                    <div class="form-group">
                        <label>Request Date Range:</label>
                        <input type="text" class="form-control daterange" id="Request_Date_Range" placeholder="YYYY-MM-DD - YYYY-MM-DD">
                    </div>
                </div>
                <!-- Date Range Filter for Order Date -->
                <div class="col-sm-3 filter-col">
                    <div class="form-group">
                        <label>Order Date Range:</label>
                        <input type="text" class="form-control daterange" id="Order_Date_Range" placeholder="YYYY-MM-DD - YYYY-MM-DD">
                    </div>
                </div>
                <!-- Date Range Filter for Quotation Date -->
                <div class="col-sm-3 filter-col">
                    <div class="form-group">
                        <label>Quotation Date Range:</label>
                        <input type="text" class="form-control daterange" id="Quotation_Date_Range" placeholder="YYYY-MM-DD - YYYY-MM-DD">
                    </div>
                </div>
                <!-- Client Name Filter -->
                <div class="col-sm-3 filter-col">
                    <div class="form-group">
                        <label>Client Name:</label>
                        <input type="text" class="form-control" id="Client_Name" placeholder="Client Name">
                    </div>
                </div>
                <!-- Client ID Filter -->
                <div class="col-sm-2 filter-col">
    <div class="form-group">
        <label>Client ID:</label>
        <input type="number" class="form-control" id="Client_ID" placeholder="Client ID">
    </div>
</div>
<div class="col-sm-1 filter-col">
    <div class="form-group">
        <label>&nbsp;</label> <!-- Non-breaking space to align with other input labels -->
        <button class="btn btn-secondary" id="reset-filters" style="width: 100%;">Reset</button>
    </div>

                </div>
            </div>
        </div>
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
                            <a href="{{ route('orders.edit', $order->Order_ID) }}" class="btn btn-default btn-sm" style="color: gray;">
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
    // DataTables initialization with custom layout for the "Toggle Filters" button
    var table = $('#orders-table').DataTable({
        pagingType: "full_numbers",
        pageLength: 15,
        lengthMenu: [5, 10,15, 30, 45, 60, 80, 100, 150, 200],
        ordering: true,
        info: true,
        responsive: true,
        dom: 
            "<'row'<'col-sm-12 d-flex justify-content-between'<'d-flex flex-row'Bl><'d-flex flex-row'f>>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'ip>>",
        buttons: [
            "copyHtml5",
            "csvHtml5",
            "excelHtml5",
            {
                extend: "pdfHtml5",
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: ":visible"
                }
            },
            "print",
            "colvis"
        ],
       
        initComplete: function() {
            // Toggle Filters button
            var toggleButtonHtml = '<button class="btn btn-secondary toggle-filters-btn" onclick="$(\'#toggle-filters\').toggle();" style="margin-left:10px;"><i class="fas fa-filter"></i> Toggle Filters</button>';
            $(toggleButtonHtml).insertAfter('#orders-table_wrapper .dt-buttons');

            // Set up text input filters
            this.api().columns().every(function() {
                var column = this;
                
                // Skip the Manage column
                if (column.index() === 0) return;

                var input = $('<input type="text" placeholder="Search '+column.header().textContent+'" />')
                    .appendTo($(column.footer()).empty())
                    .on('keyup change clear', function() {
                        if (column.search() !== this.value) {
                            column.search(this.value).draw();
                        }
                    });
            });

          
            // Request Status filter setup
            $('#Request_Status').on('change', function() {
                table.column(5).search(this.value).draw();
            });

            // Order Status filter setup
            $('#Order_Status').on('change', function() {
                table.column(7).search(this.value).draw();
            });

            // Created By filter setup
            $('#Created_By').on('keyup change', function() {
                table.column(3).search(this.value).draw();
            });

            // Client Name filter setup
            $('#Client_Name').on('keyup change', function() {
                table.column(2).search(this.value).draw();
            });

            // Client ID filter setup
            $('#Client_ID').on('keyup change', function() {
                table.column(2).search(this.value).draw();
            });

            // Request Date Range filter setup
            $('#Request_Date_Range').on('keyup change', function() {
                // Assuming you have a date range picker attached to this input
                var dates = this.value.split(' - ');
                var searchValue = dates.map(function(date) {
                    return $.fn.dataTable.util.escapeRegex(date);
                }).join(' to ');
                table.column(4).search(searchValue).draw();
            });

            // Order Date Range filter setup
            $('#Order_Date_Range').on('keyup change', function() {
                // Same as above for date range handling
                var dates = this.value.split(' - ');
                var searchValue = dates.map(function(date) {
                    return $.fn.dataTable.util.escapeRegex(date);
                }).join(' to ');
                table.column(6).search(searchValue).draw();
            });

            // Quotation Date Range filter setup
            $('#Quotation_Date_Range').on('keyup change', function() {
                // Same as above for date range handling
                var dates = this.value.split(' - ');
                var searchValue = dates.map(function(date) {
                    return $.fn.dataTable.util.escapeRegex(date);
                }).join(' to ');
                table.column(8).search(searchValue).draw();
            });
            $('#reset-filters').click(function() {
    // Clear individual column search values
    table.columns().search('').draw();

    // Reset the value of all filter inputs/selects
    $('#toggle-filters select').val('').change();
    $('#toggle-filters input').val('');

    // Additional reset actions if necessary
});
        }
    });
       

    // Event listener for delete button
    $('#orders-table tbody').on('click', '.delete-order-btn', function(e) {
    e.preventDefault();
    var orderId = $(this).data('id');
    var token = $("meta[name='csrf-token']").attr("content");
    
    // Confirm deletion and proceed with AJAX request
    if (confirm('Are you sure you want to delete this order and its related products?')) {
        $.ajax({
            url: "/orders/" + orderId, // Make sure this is the correct URL pattern as defined in your web routes
            type: 'DELETE',
            data: {
                "_token": token, // CSRF token must be included in the data for DELETE requests
                "_method": 'DELETE', // Explicitly tell Laravel to treat this request as a DELETE
                "id": orderId, // Including the order ID in the data (not necessary if it's in the URL)
            },
            success: function(response) {
                // You may want to check if the response has success message
                table.row($(e.target).closest('tr')).remove().draw();
                alert('Order deleted successfully');
            },
            error: function(xhr, textStatus, errorThrown) {
                // It's a good practice to handle errors based on the status code or error message
                console.error(xhr.responseText); // or `errorThrown` for the message
                alert('Failed to delete the order');
            }
        });
    }
});

});
</script>

