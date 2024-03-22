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
            <form method="POST" action="{{ route('orders.update', $order->Order_ID) }}" class="p-3 rounded">
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
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var productContainer = document.getElementById('productContainer');
        var addProductButton = document.getElementById('addProductButton');
        var index = {{ count($order->products) }};

        addProductButton.addEventListener('click', function() {
            index++;
            var productFormHTML = `
                <div class="product-form" data-index="${index}">
                    <h5>Product ${index}</h5>
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
                        <label for="Product_Price_${index}" class="col-sm-3 col-form-label text-right ml-neg-5">Product Price:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="Product_Price_${index}" name="products[${index}][Product_Price]" required>
                        </div>
                    </div>
                    <div class="col-sm-9 offset-sm-3">
                        <button type="button" class="btn btn-danger remove-product-btn" data-index="${index}">Remove Product</button>
                    </div>
                </div>`;
            productContainer.insertAdjacentHTML('beforeend', productFormHTML);
        });

        productContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-product-btn')) {
                var productForm = event.target.closest('.product-form');
                productForm.remove();
                if (productContainer.querySelectorAll('.product-form').length < 1) {
                    addProductButton.click();  // Ensure at least one product remains
                }
            }
        });
    });
</script>
</x-layout>


