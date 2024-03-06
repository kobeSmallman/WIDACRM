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
        <!-- Button to toggle the order form -->
        <div class="mb-3">
            <button id="toggleOrderFormBtn" class="btn btn-primary">
                Add New Order
            </button>
        </div>

        <!-- New Order Form, initially hidden -->
        <div id="newOrderForm" style="display: none;" class="card card-info">
            <div class="card-header py-3">
                <h3 class="card-title">Add New Order</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="client_id">Client ID:</label>
                        <input type="text" class="form-control" id="client_id" name="client_id" required>
                    </div>
                    <div class="form-group">
                        <label for="created_by">Created By:</label>
                        <input type="text" class="form-control" id="created_by" name="created_by" required>
                    </div>
                    <div class="form-group">
                        <label for="request_date">Request Date:</label>
                        <input type="date" class="form-control" id="request_date" name="request_date" required>
                    </div>
                    <div class="form-group">
                        <label for="request_status">Request Status:</label>
                        <input type="text" class="form-control" id="request_status" name="request_status" required>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="order_date">Order Date:</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" required>
                    </div>
                    <div class="form-group">
                        <label for="order_status">Order Status:</label>
                        <input type="text" class="form-control" id="order_status" name="order_status" required>
                    </div>
                    <div class="form-group">
                        <label for="quotation_date">Quotation Date:</label>
                        <input type="date" class="form-control" id="quotation_date" name="quotation_date">
                    </div>
                    <div class="form-group">
                        <label for="csa_path">CSA Path:</label>
                        <input type="text" class="form-control" id="csa_path" name="csa_path">
                    </div>
                    <div class="form-group">
                        <label for="ssa_path">SSA Path:</label>
                        <input type="text" class="form-control" id="ssa_path" name="ssa_path">
                    </div>
                    <!-- Add Product Button -->
                    <button type="button" class="btn btn-info mt-3" id="addProductButton">Add Another Product</button>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-3">Submit Order</button>
                </form>
            </div>
        </div>

    <div class="container-fluid">
        <!-- Orders Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Current Orders</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Client ID</th>
                                <th>Created By</th>
                                <th>Request Date</th>
                                <th>Request Status</th>
                                <th>Remarks</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Quotation Date</th>
                                <th>CSA Path</th>
                                <th>SSA Path</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->Order_ID }}</td>
                                <td>{{ $order->Client_ID }}</td>
                                <td>{{ $order->Created_By }}</td>
                                <td>{{ $order->Request_DATE }}</td>
                                <td>{{ $order->Request_Status }}</td>
                                <td>{{ $order->Remarks }}</td>
                                <td>{{ $order->Order_DATE }}</td>
                                <td>{{ $order->Order_Status }}</td>
                                <td>{{ $order->Quotation_DATE }}</td>
                                <td>{{ $order->CSA_Path }}</td>
                                <td>{{ $order->SSA_Path }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</x-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('toggleOrderFormBtn').addEventListener('click', function() {
            var form = document.getElementById('newOrderForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
                this.textContent = 'Cancel Add New Order';
                this.classList.remove('btn-primary');
                this.classList.add('btn-danger');
            } else {
                form.style.display = 'none';
                this.textContent = 'Add New Order';
                this.classList.remove('btn-danger');
                this.classList.add('btn-primary');
            }
        });

        // Additional JavaScript for product request forms can be added here
    });
</script>
