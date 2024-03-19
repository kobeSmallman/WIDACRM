{{-- Assuming $order, $clients, $vendors, and $employees are passed to the view with existing data --}}
<x-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Order</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Order Details</h3>
                </div>
                <form method="POST" action="{{ route('orders.update', $order->Order_ID) }}">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        {{-- Non-editable Order ID field --}}
                        <div class="form-group">
                            <label for="Order_ID">Order ID:</label>
                            <input type="text" class="form-control" id="Order_ID" value="{{ $order->Order_ID }}" readonly>
                        </div>

                        {{-- Editable fields --}}
                        <div class="form-group">
                            <label for="Client_ID">Client:</label>
                            <select class="form-control" id="Client_ID" name="Client_ID" required>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->Client_ID }}" {{ $order->Client_ID == $client->Client_ID ? 'selected' : '' }}>
                                        {{ $client->Company_Name }} ({{ $client->Client_ID }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
    <label for="Request_DATE">Request Date:</label>
    <input type="date" class="form-control" id="Request_DATE" name="Request_DATE" value="{{ \Carbon\Carbon::parse($order->Request_DATE)->format('Y-m-d') }}" required>
</div>
<div class="form-group">
    <label for="Request_Status">Request Status:</label>
    <select class="form-control" id="Request_Status" name="Request_Status" required>
        <option value="Active" {{ $order->Request_Status == 'Active' ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ $order->Request_Status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
        {{-- Add other status options here as needed --}}
    </select>
</div>

                    <div class="form-group">
                        <label for="Remarks">Remarks:</label>
                        <textarea class="form-control" id="Remarks" name="Remarks">{{ $order->Remarks }}</textarea>
                    </div>

                    <div class="form-group">
    <label for="Order_DATE">Order Date:</label>
    <input type="date" class="form-control" id="Order_DATE" name="Order_DATE" value="{{ \Carbon\Carbon::parse($order->Order_DATE)->format('Y-m-d') }}" required>
</div>

<div class="form-group">
    <label for="Order_Status">Order Status:</label>
    <select class="form-control" id="Order_Status" name="Order_Status" required>
        <option value="Completed" {{ $order->Order_Status == 'Completed' ? 'selected' : '' }}>Completed</option>
        <option value="Active" {{ $order->Order_Status == 'Active' ? 'selected' : '' }}>Active</option>
        <option value="Pending" {{ $order->Order_Status == 'Pending' ? 'selected' : '' }}>Pending</option>
        {{-- Add other status options here as needed --}}
    </select>
</div>

                    <div class="form-group">
    <label for="Quotation_DATE">Quotation Date:</label>
    <input type="date" class="form-control" id="Quotation_DATE" name="Quotation_DATE" value="{{ $order->Quotation_DATE ? \Carbon\Carbon::parse($order->Quotation_DATE)->format('Y-m-d') : '' }}">
</div>

                    {{-- Add Product Details --}}
                    @foreach ($order->products as $index => $product)
                        <div class="product-form" data-index="{{ $index }}">
                            <h5>Product {{ $index + 1 }}</h5>

                            {{-- Non-editable Product fields --}}
                            <div class="form-group">
                                <label for="Item_ID_{{ $index }}">Item ID:</label>
                                <input type="text" class="form-control" id="Item_ID_{{ $index }}" name="products[{{ $index }}][Item_ID]" value="{{ $product->Item_ID }}" readonly>
                            </div>

                            {{-- Editable Product fields --}}
                            <div class="form-group">
                                <label for="Product_Name_{{ $index }}">Product Name:</label>
                                <input type="text" class="form-control" id="Product_Name_{{ $index }}" name="products[{{ $index }}][Product_Name]" value="{{ $product->Product_Name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="Quantity_{{ $index }}">Quantity:</label>
                                <input type="number" class="form-control" id="Quantity_{{ $index }}" name="products[{{ $index }}][Quantity]" value="{{ $product->Quantity }}" required>
                            </div>

                            <div class="form-group">
                                <label for="Product_Price_{{ $index }}">Product Price:</label>
                                <input type="text" class="form-control" id="Product_Price_{{ $index }}" name="products[{{ $index }}][Product_Price]" value="{{ $product->Product_Price }}" required>
                            </div>

                            {{-- More product fields can be added here as needed --}}
                            
                            {{-- Delete product button (only show if more than one product) --}}
                            @if (count($order->products) > 1)
                                <button type="button" class="btn btn-danger remove-product-btn" data-index="{{ $index }}">
                                
Remove Product</button>
@endif
</div>
@endforeach
                    {{-- Add Product button --}}
                    <button type="button" id="addProductButton" class="btn btn-info">Add Product</button>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.container-fluid -->
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var productContainer = document.querySelector('.card-body');
        var addProductButton = document.getElementById('addProductButton');
        var index = {{ count($order->products) }};

        addProductButton.addEventListener('click', function() {
            index++;
            // Append the new product form HTML to 'productContainer'
            var productFormHTML = `<div class="product-form" data-index="${index}">
                                        <h5>Product ${index}</h5>
                                        <div class="form-group">
                                            <label for="Product_Name_${index}">Product Name:</label>
                                            <input type="text" class="form-control" id="Product_Name_${index}" name="products[${index}][Product_Name]" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Quantity_${index}">Quantity:</label>
                                            <input type="number" class="form-control" id="Quantity_${index}" name="products[${index}][Quantity]" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Product_Price_${index}">Product Price:</label>
                                            <input type="text" class="form-control" id="Product_Price_${index}" name="products[${index}][Product_Price]" required>
                                        </div>
                                        <button type="button" class="btn btn-danger remove-product-btn" data-index="${index}">Remove Product</button>
                                    </div>`;
            productContainer.insertAdjacentHTML('beforeend', productFormHTML);
        });

        productContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-product-btn')) {
                var productIndex = event.target.getAttribute('data-index');
                var productForm = document.querySelector('.product-form[data-index="' + productIndex + '"]');
                productForm.remove();
            }
        });
    });
</script>
</x-layout>
