<x-layout>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New Order</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Order Creation Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">New Order Details</h3>
                </div>
                <form id="newOrderForm" method="POST" action="{{ route('orders.store') }}">
                    @csrf
                    <!-- Order Information -->
                    <div class="card-body">
                    <div class="form-group">
                            <label for="Client_ID">Client:</label>
                            <select class="form-control select2" id="Client_ID" name="Client_ID" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->Client_ID }}">{{ $client->Company_Name }} ({{ $client->Client_ID }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Created_By">Created By (Employee ID):</label>
                            <input type="text" class="form-control" id="Created_By" name="Created_By" value="{{ auth()->user()->Employee_ID }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Request_DATE">Request Date:</label>
                            <input type="date" class="form-control" id="Request_DATE" name="Request_DATE" required>
                        </div>
                        <div class="form-group">
                            <label for="Request_Status">Request Status:</label>
                            <select class="form-control select2" id="Request_Status" name="Request_Status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Remarks">Remarks:</label>
                            <textarea class="form-control" id="Remarks" name="Remarks" placeholder="Enter remarks"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Order_DATE">Order Date:</label>
                            <input type="date" class="form-control" id="Order_DATE" name="Order_DATE" required>
                        </div>
                        <div class="form-group">
                            <label for="Order_Status">Order Status:</label>
                            <select class="form-control select2" id="Order_Status" name="Order_Status" required>
                                <option value="Completed">Completed</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Quotation_DATE">Quotation Date:</label>
                            <input type="date" class="form-control" id="Quotation_DATE" name="Quotation_DATE">
                        </div>
                        <!-- Add any additional fields that are required for the Order -->
                    </div>

                    <!-- Dynamic Product Addition -->
                    <div class="card-body" id="productContainer">
                        <h4>Products</h4>
                        <!-- Placeholder for adding products dynamically -->
                    </div>

                    <div class="card-footer">
                        <button type="button" id="addProductButton" class="btn btn-info">Add Product</button>
                        <button type="submit" class="btn btn-success float-right">Create Order</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary float-right mr-2">Back to Orders</a>
                    </div>
</form>
</div>
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</x-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var vendors = @json($vendors); // Make sure $vendors is passed correctly to the view
    var productContainer = document.getElementById('productContainer');
    var addProductButton = document.getElementById('addProductButton');

    function addProductForm(productFormIndex) {
    var vendorOptions = vendors.map(function(vendor) {
        return `<option value="${vendor.Vendor_ID}">${vendor.Vendor_Name} (${vendor.Vendor_ID})</option>`;
    }).join('');

        var productFormHTML = `
    <div class="product-form" data-index="${productFormIndex}">
            <h5>Product ${productFormIndex}</h5>
            <div class="form-group">
                <label for="Product_Name_${productFormIndex}">Product Name:</label>
                <input type="text" class="form-control" id="Product_Name_${productFormIndex}" name="products[${productFormIndex}][Product_Name]" placeholder="Enter Product Name" required>
            </div>
            <div class="form-group">
                <label for="Quantity_${productFormIndex}">Quantity:</label>
                <input type="number" class="form-control" id="Quantity_${productFormIndex}" name="products[${productFormIndex}][Quantity]" placeholder="Enter Quantity" required>
            </div>
            <div class="form-group">
                <label for="Vendor_ID_${productFormIndex}">Vendor:</label>
                <select class="form-control select2" id="Vendor_ID_${productFormIndex}" name="products[${productFormIndex}][Vendor_ID]" required>
    ${vendorOptions}
</select>

            </div>
    <div class="form-group">
        <label for="Shipping_Status_${productFormIndex}">Shipping Status:</label>
        <select class="form-control select2" id="Shipping_Status_${productFormIndex}" name="products[${productFormIndex}][Shipping_Status]" required>
            <option value="Pending">Pending</option>
            <option value="Shipped">Shipped</option>
            <option value="Completed">Shipped</option>
            <!-- Add other statuses as needed -->
        </select>
    </div>
            <div class="form-group">
                <label for="Shipped_Qty_${productFormIndex}">Shipped Quantity:</label>
                <input type="number" class="form-control" id="Shipped_Qty_${productFormIndex}" name="products[${productFormIndex}][Shipped_Qty]" placeholder="Enter Shipped Quantity" required>
            </div>
            <div class="form-group">
                <label for="Product_Price_${productFormIndex}">Product Price:</label>
                <input type="text" class="form-control" id="Product_Price_${productFormIndex}" name="products[${productFormIndex}][Product_Price]" placeholder="Enter Product Price" required>
            </div>
            <div class="form-group">
        <label for="Product_Status_${productFormIndex}">Product Status:</label>
        <select class="form-control select2" id="Product_Status_${productFormIndex}" name="products[${productFormIndex}][Product_Status]" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            <option value="Completed">Completed</option>
        </select>
    </div>
    <div class="form-group">
        <label for="QA_Status_${productFormIndex}">QA Status:</label>
        <select class="form-control select2" id="QA_Status_${productFormIndex}" name="products[${productFormIndex}][QA_Status]" required>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
            <div class="form-group">
        <label for="Storage_Status_${productFormIndex}">Storage Status:</label>
        <select class="form-control select2" id="Storage_Status_${productFormIndex}" name="products[${productFormIndex}][Storage_Status]" required>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>  
    <div class="form-group">
        <label for="Prod_Status_${productFormIndex}">Production Status:</label>
        <select class="form-control select2" id="Prod_Status_${productFormIndex}" name="products[${productFormIndex}][Prod_Status]" required>
            <option value="In progress">In Progress</option>
            <option value="Not Started">Not Started</option>
            <option value="Completed">Completed</option>
        </select>
    </div>
    `;

    productContainer.insertAdjacentHTML('beforeend', productFormHTML);
        $('.select2').select2(); // Reinitialize Select2 for all select elements including newly added ones
    }

    addProductButton.addEventListener('click', function() {
        var productForms = document.querySelectorAll('.product-form');
        var nextIndex = productForms.length + 1;
        addProductForm(nextIndex);
    });

    window.removeProductForm = function(index) {
        var formToRemove = document.querySelector('.product-form[data-index="' + index + '"]');
        if (formToRemove) {
            formToRemove.remove();
        }
    };
});
</script>

