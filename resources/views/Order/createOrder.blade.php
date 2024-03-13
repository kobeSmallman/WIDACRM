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
                            <label for="Client_ID">Client ID:</label>
                            <input type="number" class="form-control" id="Client_ID" name="Client_ID" placeholder="Enter Client ID" required>

                        </div>
                        <div class="form-group">
                            <label for="Created_By">Created By (Employee ID):</label>
                            <input type="number" class="form-control" id="Created_By" name="Created_By" placeholder="Enter Your ID" required>
                        </div>
                        <div class="form-group">
                            <label for="Request_DATE">Request Date:</label>
                            <input type="date" class="form-control" id="Request_DATE" name="Request_DATE" required>
                        </div>
                        <div class="form-group">
                            <label for="Request_Status">Request Status:</label>
                            <input type="text" class="form-control" id="Request_Status" name="Request_Status" placeholder="Enter Request Status" required>
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
                            <input type="text" class="form-control" id="Order_Status" name="Order_Status" placeholder="Enter Order Status" required>
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
    var productContainer = document.getElementById('productContainer');
    var addProductButton = document.getElementById('addProductButton');

    // Function to add a product form
    function addProductForm(productFormIndex) {
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
                <label for="Vendor_ID_${productFormIndex}">Vendor ID:</label>
                <input type="number" class="form-control" id="Vendor_ID_${productFormIndex}" name="products[${productFormIndex}][Vendor_ID]" placeholder="Enter Vendor ID" required>
            </div>
            <div class="form-group">
                <label for="Shipping_Status_${productFormIndex}">Shipping Status:</label>
                <input type="text" class="form-control" id="Shipping_Status_${productFormIndex}" name="products[${productFormIndex}][Shipping_Status]" placeholder="Enter Shipping Status" required>
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
                <input type="text" class="form-control" id="Product_Status_${productFormIndex}" name="products[${productFormIndex}][Product_Status]" placeholder="Enter Product Status" required>
            </div>
            <div class="form-group">
                <label for="QA_Status_${productFormIndex}">QA Status:</label>
                <input type="text" class="form-control" id="QA_Status_${productFormIndex}" name="products[${productFormIndex}][QA_Status]" placeholder="Enter QA Status" required>
            </div>
            <div class="form-group">
                <label for="Storage_Status_${productFormIndex}">Storage Status:</label>
                <input type="text" class="form-control" id="Storage_Status_${productFormIndex}" name="products[${productFormIndex}][Storage_Status]" placeholder="Enter Storage Status" required>
            </div>
            <div>
            <label for="Prod_Status_${productFormIndex}">Product Status:</label>
    <input type="text" class="form-control" id="Prod_Status_${productFormIndex}" name="products[${productFormIndex}][Prod_Status]" placeholder="Enter Product Status" required>
    </div>      
    <button type="button" class="btn btn-danger removeProductButton" onclick="removeProductForm(${productFormIndex})">Remove Product</button>
        </div>
    `;

    productContainer.insertAdjacentHTML('beforeend', productFormHTML);
}


    // Initialize the first product form
    addProductForm(1);

    addProductButton.addEventListener('click', function() {
        let productFormIndex = document.querySelectorAll('.product-form').length + 1;
        addProductForm(productFormIndex);
    });
});

// Function to add a product form
function addProductForm(index) {
    // Implementation of your addProductForm function
}

// Function to remove a product form
function removeProductForm(index) {
    let productForm = document.querySelector('.product-form[data-index="' + index + '"]');
    if (productForm) {
        productContainer.removeChild(productForm);
    }
    // Re-index the remaining product forms
    updateProductFormIndexes();
}

// Function to update indexes of all product forms
function updateProductFormIndexes() {
    let productForms = document.querySelectorAll('.product-form');
    productForms.forEach((form, index) => {
        form.setAttribute('data-index', index + 1); // Set the new index based on position in the NodeList
        form.querySelector('h5').innerText = 'Product ' + (index + 1); // Update the visual index for the user
        // Update the names and ids of form inputs accordingly
        // You'll need to adjust selectors based on your input names and structure
        form.querySelectorAll('input, select, textarea').forEach(input => {
            let name = input.name.match(/^(.+)\[\d+\](.+)$/);
            if (name) {
                input.name = name[1] + '[' + (index + 1) + ']' + name[2];
            }
        });
    });

    // If all product forms are removed, add a new one with index 1
    if (productForms.length === 0) {
        addProductForm(1);
    }
}

// The missing function definition for addProductForm should be added here, after the previous script content.
</script>


