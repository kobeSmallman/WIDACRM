<x-layout>
<style>
    .ml-neg-5 {
        margin-left: -5rem;
    }

    .swal-custom-html-container ul {
        text-align: left;
        margin-left: 0;
        padding-left: 1.5em;
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
    }

    label {
        font-weight: bold;
    }
</style>

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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-file-circle-plus mr-2"></i>New Order Details</h3>
            </div>
            <form id="newOrderForm" method="POST" action="{{ route('orders.store') }}" class="p-3 rounded">
                @csrf
                <!-- Order Information -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="Client_ID" class="col-sm-3 col-form-label text-right ml-neg-5">Client:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Client_ID" name="Client_ID" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->Client_ID }}">{{ $client->Company_Name }} ({{ $client->Client_ID }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Created_By" class="col-sm-3 col-form-label text-right ml-neg-5">Created By (Employee ID):</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="Created_By" name="Created_By" value="{{ auth()->user()->Employee_ID }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Request_DATE" class="col-sm-3 col-form-label text-right ml-neg-5">Request Date:</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="Request_DATE" name="Request_DATE" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Request_Status" class="col-sm-3 col-form-label text-right ml-neg-5">Request Status:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Request_Status" name="Request_Status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Remarks" class="col-sm-3 col-form-label text-right ml-neg-5">Remarks:</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="Remarks" name="Remarks" placeholder="Enter remarks"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Order_DATE" class="col-sm-3 col-form-label text-right ml-neg-5">Order Date:</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="Order_DATE" name="Order_DATE" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Order_Status" class="col-sm-3 col-form-label text-right ml-neg-5">Order Status:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Order_Status" name="Order_Status" required>
                                <option value="Completed">Completed</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="Quotation_DATE" class="col-sm-3 col-form-label text-right ml-neg-5">Quotation Date:</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="Quotation_DATE" name="Quotation_DATE">
                        </div>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">
    <div id="productContainer">
        <div class="product-form" data-index="1">
            <h2>Product 1</h2>
            <div class="form-group row">
                <label for="Product_Name_1" class="col-sm-3 col-form-label text-right ml-neg-5">Product Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="Product_Name_1" name="products[1][Product_Name]" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Quantity_1" class="col-sm-3 col-form-label text-right ml-neg-5">Quantity:</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="Quantity_1" name="products[1][Quantity]" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Vendor_ID_1" class="col-sm-3 col-form-label text-right ml-neg-5">Vendor:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="Vendor_ID_1" name="products[1][Vendor_ID]" required>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->Vendor_ID }}">{{ $vendor->Vendor_Name }} ({{ $vendor->Vendor_ID }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="Shipping_Status_1" class="col-sm-3 col-form-label text-right ml-neg-5">Shipping Status:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="Shipping_Status_1" name="products[1][Shipping_Status]" required>
                        <option value="Pending">Pending</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="Shipped_Qty_1" class="col-sm-3 col-form-label text-right ml-neg-5">Shipped Quantity:</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="Shipped_Qty_1" name="products[1][Shipped_Qty]" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Product_Price_1" class="col-sm-3 col-form-label text-right ml-neg-5">Product Price:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="Product_Price_1" name="products[1][Product_Price]" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Product_Status_1" class="col-sm-3 col-form-label text-right ml-neg-5">Product Status:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="Product_Status_1" name="products[1][Product_Status]" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="QA_Status_1" class="col-sm-3 col-form-label text-right ml-neg-5">QA Status:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="QA_Status_1" name="products[1][QA_Status]" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="Storage_Status_1" class="col-sm-3 col-form-label text-right ml-neg-5">Storage Status:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="Storage_Status_1" name="products[1][Storage_Status]" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                </div>
            <div class="form-group row">
                <label for="Prod_Status_1" class="col-sm-3 col-form-label text-right ml-neg-5">Production Status:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="Prod_Status_1" name="products[1][Prod_Status]" required>
                        <option value="In progress">In Progress</option>
                        <option value="Not Started">Not Started</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="button" id="addProductButton" class="btn btn-primary" style="margin-left: 2rem;">Add Product</button>
        <button type="submit" class="btn btn-success float-right">Create Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary float-right mr-2">Back to Orders</a>
    </div>
</form>
</div>
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var vendors = @json($vendors);
        var productContainer = document.getElementById('productContainer');
        var addProductButton = document.getElementById('addProductButton');
        var index = 2; // Start from 2 because 1 is already used

        function addProductForm(index) {
            var vendorOptions = vendors.map(function(vendor) {
                return `<option value="${vendor.Vendor_ID}">${vendor.Vendor_Name} (${vendor.Vendor_ID})</option>`;
            }).join('');

            var productFormHTML = `
                <div class="product-form" data-index="${index}">
                    <h2>Product ${index}</h2>
                    <div class="form-group row">
                        <label for="Product_Name_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">Product Name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="Product_Name_${index}" name="products[${index}][Product_Name]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Quantity_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">Quantity:</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="Quantity_${index}" name="products[${index}][Quantity]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Vendor_ID_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">Vendor:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Vendor_ID_${index}" name="products[${index}][Vendor_ID]" required>
                                ${vendorOptions}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Shipping_Status_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">Shipping Status:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Shipping_Status_${index}" name="products[${index}][Shipping_Status]" required>
                                <option value="Pending">Pending</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Shipped_Qty_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">Shipped Quantity:</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="Shipped_Qty_${index}" name="products[${index}][Shipped_Qty]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Product_Price_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">Product Price:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="Product_Price_${index}" name="products[${index}][Product_Price]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="Product_Status_1" class="col-sm-3 col-form-label text-right ml-neg-5">Product Status:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Product_Status_${index}" name="products[${index}][Product_Status]" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="QA_Status_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">QA Status:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="QA_Status_${index}" name="products[${index}][QA_Status]" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Storage_Status_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">Storage Status:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Storage_Status_${index}" name="products[${index}][Storage_Status]" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Prod_Status_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">Production Status:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Prod_Status_${index}" name="products[${index}][Prod_Status]" required>
                                <option value="In progress">In Progress</option>
                                <option value="Not Started">Not Started</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 offset-sm-3">
                        <button type="button" class="btn btn-danger remove-product-btn" data-index="${index}">Remove Product</button>
                    </div>
                </div>
            `;

            productContainer.insertAdjacentHTML('beforeend', productFormHTML);
        }

        addProductButton.addEventListener('click', function() {
            addProductForm(index++);
        });

        productContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-product-btn')) {
                var productForm = event.target.closest('.product-form');
                productForm.remove();
                index--;
                // Consider adjusting the index or handling it as needed for form consistency
            }
        });
    });
</script>
</x-layout>

