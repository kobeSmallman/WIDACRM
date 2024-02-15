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


        <!-- New Order Form -->
     <!-- New Order Form -->
<!-- New Order Form -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add New Order</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('orders.store') }}" method="POST" id="newOrderForm">
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
            <!-- Client Selection Dropdown from createRequest -->
            <div class="mb-3">
                <label for="clientSelect" class="form-label">Select Client:</label>
                <select id="clientSelect" name="client_id" class="form-control" onchange="handleClientSelection()">
                    <option value="">Select a Client</option>
                    @foreach ($clients as $Client)
                        <option value="{{ $Client->Client_ID }}">{{ $Client->Client_ID }} - {{ $Client->Company_Name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product Requests Container -->
            <div id="productRequestsContainer">
                        <!-- Dynamic product requests will be added here -->
                    </div>

            <!-- Add Request Button -->
            <button type="button" class="btn btn-info mt-3" id="addRequestButton">Add Another Request</button>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-3">Submit Order and Requests</button>
            
        </form>
    </div>
</div>
</form>
</div>
</div>
</div>
<!-- /.container-fluid -->
</x-layout>
<script>
    let productRequestIndex = 0;

    function addProductRequestForm() {
        const container = document.getElementById('productRequestsContainer');
        const html = `
            <div class="product-request-form mb-3" data-index="${productRequestIndex}">
                <!-- Dynamic Request Form Fields -->
                <!-- ... -->
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        productRequestIndex++;
    }

    function handleClientSelection() {
        // Implement any additional logic when client is selected, e.g., setting status to lead
    }

    document.getElementById('addRequestButton').addEventListener('click', addProductRequestForm);

    // Add the first product request form on initial page load
    window.addEventListener('DOMContentLoaded', (event) => {
        addProductRequestForm();
    });
</    // ... (continuing from the previous JavaScript code)

// Add the first product request form on initial page load
window.addEventListener('DOMContentLoaded', (event) => {
    addProductRequestForm();
});

// Function to handle client selection and set to lead if necessary
function handleClientSelection() {
    const clientSelect = document.getElementById('clientSelect');
    const selectedClient = clientSelect.value;
    // Implement logic as required when a client is selected
    // For example, you might want to set a client's status to 'lead'
    // or fetch and display the client's previous orders for reference
}
</script>
<script>
    let productRequestIndex = 0;
    let actualRequestCount = 1; // Keep track of the actual number of requests

    function addProductRequestForm() {
        const container = document.getElementById('productRequestsContainer');
        const isCancelable = actualRequestCount > 1; // Only allow canceling if more than one request exists
        const cancelButtonHTML = isCancelable ? `<button type="button" class="btn btn-danger cancelRequestButton" onclick="removeProductRequestForm(${productRequestIndex})">Cancel Request</button>` : '';

        const html = `
            <div class="product-request-form mb-3" data-index="${productRequestIndex}">
                <h5>Product Request ${actualRequestCount}</h5>
                <div class="mb-3">
                    <label>Product Name:</label>
                    <input type="text" class="form-control" name="product_requests[${productRequestIndex}][name]" required>
                </div>
                <div class="mb-3">
                    <label>Product Description:</label>
                    <textarea class="form-control" name="product_requests[${productRequestIndex}][description]" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label>Product Price ($):</label>
                    <input type="number" class="form-control" name="product_requests[${productRequestIndex}][price]" required>
                </div>
                <div class="mb-3">
                    <label>Quantity:</label>
                    <input type="number" class="form-control" name="product_requests[${productRequestIndex}][quantity]" required>
                </div>
                ${cancelButtonHTML}
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        productRequestIndex++; // Increment the index for unique naming
        actualRequestCount++; // Increment the actual count of product requests
    }

    function removeProductRequestForm(index) {
        const requestForm = document.querySelector(`.product-request-form[data-index="${index}"]`);
        if (requestForm) {
            requestForm.remove();
            actualRequestCount--; // Decrement the actual count of product requests
        }
        // Re-adjust indexes for remaining product requests
        document.querySelectorAll('.product-request-form').forEach((form, newIndex) => {
            form.setAttribute('data-index', newIndex);
            form.querySelector('h5').textContent = `Product Request ${newIndex + 1}`;
        });
        productRequestIndex = actualRequestCount - 1; // Adjust the index for new additions
    }

    document.getElementById('addRequestButton').addEventListener('click', addProductRequestForm);

    // Add the first product request form by default and ensure it's not cancelable
    window.addEventListener('DOMContentLoaded', (event) => {
        addProductRequestForm();
    });
</script>

