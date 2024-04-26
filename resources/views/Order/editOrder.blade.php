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

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Order</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-edit mr-2"></i>Order Details</h3>
            </div>
            <form id="editOrderForm" method="POST" action="{{ route('orders.update', $order->Order_ID) }}" class="p-3 rounded">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group row">
                        <label for="Order_ID" class="col-sm-3 col-form-label text-right ml-neg-5">Order ID:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="Order_ID" value="{{ $order->Order_ID }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Client_ID" class="col-sm-3 col-form-label text-right ml-neg-5">Client:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Client_ID" name="Client_ID" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->Client_ID }}" {{ $order->Client_ID == $client->Client_ID ? 'selected' : '' }}>
                                        {{ $client->Company_Name }} ({{ $client->Client_ID }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Request_DATE" class="col-sm-3 col-form-label text-right ml-neg-5">Request Date:</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="Request_DATE" name="Request_DATE" value="{{ \Carbon\Carbon::parse($order->Request_DATE)->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Request_Status" class="col-sm-3 col-form-label text-right ml-neg-5">Request Status:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Request_Status" name="Request_Status" required>
                                <option value="Active" {{ $order->Request_Status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $order->Request_Status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Remarks" class="col-sm-3 col-form-label text-right ml-neg-5">Remarks:</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="Remarks" name="Remarks">{{ $order->Remarks }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Order_DATE" class="col-sm-3 col-form-label text-right ml-neg-5">Order Date:</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="Order_DATE" name="Order_DATE" value="{{ \Carbon\Carbon::parse($order->Order_DATE)->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Order_Status" class="col-sm-3 col-form-label text-right ml-neg-5">Order Status:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="Order_Status" name="Order_Status" required>
                            <option value="Completed" {{ $order->Order_Status == 'Completed' ? 'selected' : '' }}></option>
                                    <option value="Active" {{ $order->Order_Status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Pending" {{ $order->Order_Status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Quotation_DATE" class="col-sm-3 col-form-label text-right ml-neg-5">Quotation Date:</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="Quotation_DATE" name="Quotation_DATE" value="{{ $order->Quotation_DATE ? \Carbon\Carbon::parse($order->Quotation_DATE)->format('Y-m-d') : '' }}">
                        </div>
                    </div>

                    <div id="productContainer">
                        @foreach ($order->products as $index => $product)
                        <div class="product-form" data-index="{{ $index }}">
    <h5>Product {{ $index + 1 }}</h5>
    <div class="form-group row">
        <label for="Item_ID_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">Item ID:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="Item_ID_{{ $index }}" name="products[{{ $index }}][Item_ID]" value="{{ $product->Item_ID }}" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label for="Product_Name_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">Product Name:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="Product_Name_{{ $index }}" name="products[{{ $index }}][Product_Name]" value="{{ $product->Product_Name }}" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="Quantity_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">Quantity:</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" id="Quantity_{{ $index }}" name="products[{{ $index }}][Quantity]" value="{{ $product->Quantity }}" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="Product_Price_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">Product Price:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="Product_Price_{{ $index }}" name="products[{{ $index }}][Product_Price]" value="{{ $product->Product_Price }}" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Vendor:</label>
        <div class="col-sm-6">
            <select class="form-control" name="products[${index}][Vendor_ID]" required>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->Vendor_ID }}">{{ $vendor->Vendor_Name }} ({{ $vendor->Vendor_ID }})</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="Shipping_Status_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">Shipping Status:</label>
        <div class="col-sm-6">
            <select class="form-control" id="Shipping_Status_{{ $index }}" name="products[{{ $index }}][Shipping_Status]" required>
                <option value="Shipped" {{ $product->Shipping_Status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="Not Shipped" {{ $product->Shipping_Status == 'Not Shipped' ? 'selected' : '' }}>Not Shipped</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="Shipped_Qty_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">Shipped Quantity:</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" id="Shipped_Qty_{{ $index }}" name="products[{{ $index }}][Shipped_Qty]" value="{{ $product->Shipped_Qty }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="Product_Status_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">Product Status:</label>
        <div class="col-sm-6">
            <select class="form-control" id="Product_Status_{{ $index }}" name="products[{{ $index }}][Product_Status]" required>
                <option value="Active" {{ $product->Product_Status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $product->Product_Status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="QA_Status_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">QA Status:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="QA_Status_{{ $index }}" name="products[{{ $index }}][QA_Status]" value="{{ $product->QA_Status }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="Storage_Status_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">Storage Status:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="Storage_Status_{{ $index }}" name="products[{{ $index }}][Storage_Status]" value="{{ $product->Storage_Status }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="Prod_Status_{{ $index }}" class="col-sm-3 col-form-label text-right ml-neg-5">Prod Status:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="Prod_Status_{{ $index }}" name="products[{{ $index }}][Prod_Status]" value="{{ $product->Prod_Status }}">
        </div>
    </div>

    @if (count($order->products) > 1)
        <div class="col-sm-9 offset-sm-3">
            <button type="button" class="btn btn-danger remove-product-btn" data-index="{{ $index }}">Remove Product</button>
        </div>
    @endif
</div>

                        @endforeach
                    </div>

                    <button type="button" id="addProductButton" class="btn btn-primary" style="margin-left: 2rem;">Add Product</button>

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary save-btn">Save</button>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
</div>

                </div>
            </form>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function handleSave(event) {
    event.preventDefault(); // Prevent form from submitting immediately
    var successMessage = "Changes saved successfully.";
    
    Swal.fire({
        title: 'Confirm',
        text: successMessage,
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.removeEventListener('beforeunload', handleBeforeUnload); // Remove the listener to prevent the leaving alert
            // Redirect or submit the form here
            // For instance: window.location.href = "{{ route('orders.show', $order->Order_ID) }}"; // or editOrderForm.submit();
            window.location.href = "{{ route('orders.show', ['id' => $order->Order_ID]) }}"; // Update the placeholder with your actual route
        }
    });
}


function handleBeforeUnload(event) {
    event.preventDefault();
    event.returnValue = ''; // Chrome requires returnValue to be set
}

document.addEventListener('DOMContentLoaded', function() {
    var saveButton = document.querySelector('button[type="submit"]');
    if (saveButton) {
        saveButton.addEventListener('click', handleSave);
    }
    
    // Add the beforeunload event listener only when there are changes to warn about
    // You can add conditions to check if changes were made, then add the listener
    window.addEventListener('beforeunload', handleBeforeUnload);

    var productContainer = document.getElementById('productContainer');
    var addProductButton = document.getElementById('addProductButton');
    var index = productContainer.querySelectorAll('.product-form').length;

    addProductButton.addEventListener('click', function() {
        index++;
        var productFormHTML = `
        <div class="product-form" data-index="${index}">
    <h5>Product ${index}</h5>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Product Name:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="products[${index}][Product_Name]" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Quantity:</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" name="products[${index}][Quantity]" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Product Price:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="products[${index}][Product_Price]" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Vendor:</label>
        <div class="col-sm-6">
            <select class="form-control" name="products[${index}][Vendor_ID]" required>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->Vendor_ID }}">{{ $vendor->Vendor_Name }} ({{ $vendor->Vendor_ID }})</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Shipping Status:</label>
        <div class="col-sm-6">
            <select class="form-control" name="products[${index}][Shipping_Status]" required>
                <option value="Shipped">Shipped</option>
                <option value="Not Shipped">Not Shipped</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Shipped Quantity:</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" name="products[${index}][Shipped_Qty]">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Product Status:</label>
        <div class="col-sm-6">
            <select class="form-control" name="products[${index}][Product_Status]" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">QA Status:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="products[${index}][QA_Status]">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Storage Status:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="products[${index}][Storage_Status]">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right ml-neg-5">Prod Status:</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="products[${index}][Prod_Status]">
        </div>
    </div>
    <div class="col-sm-9 offset-sm-3">
        <button type="button" class="btn btn-danger remove-product-btn" data-index="${index}">Remove Product</button>
    </div>
</div>
`;
        productContainer.insertAdjacentHTML('beforeend', productFormHTML);
    });

    productContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-product-btn')) {
            var productForm = event.target.closest('.product-form');
            productForm.remove();
            // Ensure there is always at least one product form
            if (productContainer.querySelectorAll('.product-form').length === 0) {
                addProductButton.click();
            }
            index--;
        }
    });
});
</script>

</x-layout>


