<x-layout>
<!--Additional CSS Styling for this page only-->
<style>
        .card-header {
            background-color: #007bff; /* Ensure this is the only place setting the background color for card headers */
            color: #ffffff; /* White text */
        }

        .card-primary {
            border-color: #007bff; /* Consistent border color */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-default {
            background-color: #6c757d; /* Default grey */
            color: #ffffff; /* White text */
        }

        .ml-neg-5 {
            margin-left: -5rem; 
        }

  .fixed-height-card {
            height: 550px; /* Adjust the height as needed */
            overflow-y: auto; /* Enable vertical scrolling */
        }

        /* Style to apply only to the left side to make it scrollable */
        .scrollable-card {
            overflow-y: auto; /* Enable vertical scrolling */
        }

        /* Adjust product dropdown styling */
        #product_dropdown {
            display: none; /* Initially hide the product dropdown */
            margin-top: 10px; /* Add some top margin for spacing */
        }

        /* Style to center align the form controls */
        .form-group {
            display: flex;
            align-items: center;
        }

        /* Style to adjust label width for smaller screens */
        @media (max-width: 768px) {
            .col-sm-3 {
                width: 30%;
            }

            .col-sm-7 {
                width: 70%;
            }
        }

</style>

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payment Details</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('payment.index')}}">Payments</a></li>
                        <li class="breadcrumb-item active">Payment Record # {{ $payment->PMT_ID }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Left Column - Order Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Information</h3>
                    </div>
                    <div class="card-body fixed-height-card scrollable-card">
                <!-- THIS WAS THE OLD STUB
                <div class="card-body" style="height: 300px"> 
                    <strong>{{ $selectedOrder->Order_ID }}</strong>
                    <hr>
                    <p class="text-muted">Insert Order Information here</p>
                </div>-->
                <div class="card-body" style="flex">
                    <h5>Basic Information</h5>
                    <p><strong>Order ID:</strong> {{ $selectedOrder->Order_ID }}</p>
                    <p><strong>Order Date:</strong> {{ $selectedOrder->Order_DATE }}</p>
                    <p><strong>Order Status:</strong> {{ $selectedOrder->Order_Status }}</p>
                    <p><strong>Remarks:</strong> {{ $selectedOrder->Remarks }}</p>
                    <!-- Add more fields from the Order model if necessary -->
                </div>

                <div class="card-body" style="flex">
                    <h5>Products</h5>
                    @foreach ($selectedOrder->products as $product)
                    <div class="card">
                        <div class="card-body">
                            <h5>{{ $product->Product_Name }}</h5>
                            <p><strong>Quantity:</strong> {{ $product->Quantity }}</p>
                            <p><strong>Product Price:</strong> {{ $product->Product_Price }}</p>
                            <!-- Add other product details if necessary -->
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
                </div>

            <!-- Right Column - Payment Details -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment Details</h3>
                    </div>
                    <div class="card-body fixed-height-card scrollable-card">
                    <div class="card-body">
                        <div class="post">
                        </div>

                        <form action="{{ route('payment.updatePayment', ['id' => $payment->PMT_ID]) }}" method="POST" class="p-3 rounded" id="payment-form">
                        @csrf
                        <div class="form-group row">
                            <label for="Order_ID" class="col-sm-3 col-form-label text-right">Order ID:</label>
                            <div class="col-sm-7">
                            <select name="Order_ID" id="Order_ID" class="form-control" disabled>
                            @foreach($orders as $id => $orderID)
                                <option value="{{ $id }}" @if($id == $payment->Order_ID) selected @endif>{{ $orderID }}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Invoice" class="col-sm-3 col-form-label text-right">QuickBooks Invoice Number:</label>
                            <div class="col-sm-7">
                                <input type="text" id="Invoice_Number" name="Invoice_Number" class="form-control" placeholder="QuickBooks Invoice Number" value="{{ $payment->Invoice_Number}}" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="Date" class="col-sm-3 col-form-label text-right">Date:</label>
                            <div class="col-sm-7">
                                <input type="text" id="Date" name="Date" class="form-control" placeholder="Date" value="{{ $payment->Date->format('Y-m-d') }}" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                     
    <label for="PMT_Cat" class="col-sm-3 col-form-label text-right">Payment Category:</label>
    <div class="col-sm-7">
        <select name="PMT_Cat" id="PMT_Cat" class="form-control" required disabled>
            <option value="Product" @if($payment->PMT_Cat == 'Product') selected @endif>Product</option>
            <option value="Freight" @if($payment->PMT_Cat == 'Freight') selected @endif>Freight</option>
        </select>
    </div>
</div>

                        <div class="form-group row">
                            <label for="Amount" class="col-sm-3 col-form-label text-right">Amount:</label>
                            <div class="col-sm-7">
                                <input type="text" id="Amount" name="Amount" class="form-control" placeholder="Amount" value="{{ number_format($payment->Amount, 2) }}" required disabled>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="PMT_Type" class="col-sm-3 col-form-label text-right">Payment Type:</label>
                            <div class="col-sm-7">
                                <select name="PMT_Type_ID" id="PMT_Type_ID" class="form-control" required disabled>
                                    @foreach($paymentTypes as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>   
                        <div class="form-group row" id="product_dropdown" style="display: none;">
                                    <label for="Product_Name" class="col-sm-3 col-form-label text-right">Product:</label>
                                    <div class="col-sm-7">
                                        <select id="Product_Name" name="Product_Name" class="form-control" disabled>
                                            {{-- Product options will be added here dynamically --}}
                                        </select>
                                    </div>
                                </div>

                        <div class="form-group row">
                            <label for="Remarks" class="col-sm-3 col-form-label text-right">Remarks:</label>
                            <div class="col-sm-7">
                                <input type="text" id="Remarks" name="Remarks" class="form-control" placeholder="Example: Payment declined" value="{{ $payment->Remarks }}" disabled>
                            </div>
                        </div>  
                        
                        <div class="form-group row">
                            <div class="offset-sm-3 col-sm-auto">
                                <button type="submit" id="btnSave" class="btn btn-primary btn-fixed" style="display: none;">Save</button>
                                <button type="button" id="btnCancel" class="btn btn-default btn-fixed" style="display: none;" onclick="cancelEdit()">Cancel</button>
                                <button type="button" id="btnEdit" class="btn btn-primary btn-fixed" onclick="enableFields()">Edit</button>
                                <a href="{{ route('payment.index') }}" class="btn btn-default btn-fixed" id="btnBack">Back</a>
                            </div>
                        </div>                      
                    <!--Hidden field to carry Order ID info-->
                    <input type="hidden" name="Order_ID" value="{{ $payment->Order_ID }}">
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>

   function enableFields() {
        document.getElementById('Order_ID').disabled = true;
        document.getElementById('Invoice_Number').disabled = false;
        document.getElementById('Date').disabled = false;
        document.getElementById('PMT_Cat').disabled = false;
        document.getElementById('Amount').disabled = false;
        document.getElementById('PMT_Type_ID').disabled = false;
        document.getElementById('Product_Name').disabled = false;
        document.getElementById('Remarks').disabled = false;
        document.getElementById('btnSave').style.display = 'inline';
        document.getElementById('btnCancel').style.display = 'inline';
        document.getElementById('btnEdit').style.display = 'none';
        document.getElementById('btnBack').style.display = 'none';
        toggleProductDropdown(); // called to set the correct visibility state when enabling fields
    }

    document.addEventListener('DOMContentLoaded', function () {
    // Function to toggle the product dropdown visibility
    function toggleProductDropdown() {
        var category = document.getElementById('PMT_Cat').value;
        var productDropdown = document.getElementById('product_dropdown'); 
        if (category === 'Freight') {
            productDropdown.style.display = 'block';
        } else {
            productDropdown.style.display = 'none';
        }
    }

    // Trigger the change event when the page loads
    document.getElementById('PMT_Cat').dispatchEvent(new Event('change'));

    // Add event listener to the payment category select box
    document.getElementById('PMT_Cat').addEventListener('change', toggleProductDropdown);

    // Initial check to set the correct state when the page loads
    toggleProductDropdown();
})


    function cancelEdit() {

        //Reset to original values
        document.getElementById('Invoice_Number').value = '{{ $payment->Invoice_Number}}';
        document.getElementById('Date').value = '{{ $payment->Date}}';
        document.getElementById('PMT_Cat').value = '{{ $payment->PMT_Cat}}';
        document.getElementById('Amount').value = '{{ $payment->Amount}}';
        document.getElementById('PMT_Type_ID').value = '{{ $payment->PMT_Type_ID}}';
        document.getElementById('Product_Name').value = '{{ $payment->Product_Name}}';
        document.getElementById('Remarks').value = '{{ $payment->Remarks}}';

        //Disable for editing
        document.getElementById('Order_ID').disabled = true;
        document.getElementById('Invoice_Number').disabled = true;
        document.getElementById('Date').disabled = true;
        document.getElementById('PMT_Cat').disabled = true;
        document.getElementById('Amount').disabled = true;
        document.getElementById('PMT_Type_ID').disabled = true;
        document.getElementById('Product_Name').disabled = true;
        document.getElementById('Remarks').disabled = true;
        document.getElementById('btnSave').style.display = 'none';
        document.getElementById('btnCancel').style.display = 'none';
        document.getElementById('btnEdit').style.display = 'inline';
        document.getElementById('btnBack').style.display = 'inline';
    }

    document.getElementById('PMT_Cat').addEventListener('change', function() {
                    var category = this.value;
                    var orderId = document.getElementById('Order_ID').value; 

                    if (category === 'Freight') {
                        fetch('/get-products-for-order/' + orderId)
                            .then(response => response.json())
                            .then(data => {
                                var productSelect = document.getElementById('Product_Name');
                                productSelect.innerHTML = ''; // Clear existing options

                                data.forEach(function(product) {
                                    var option = new Option(product.Product_Name, product.Item_ID);
                                    productSelect.appendChild(option);
                                });

                                document.getElementById('product_dropdown').style.display = 'flex';
                            });
                    } else {
                        document.getElementById('product_dropdown').style.display = 'none';
                    }
                })
</script>

        <!-- Include SweetAlert2 library -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Check for the 'success' session variable and display a SweetAlert -->
        @if(session('success'))
            <script>
                Swal.fire({
                    title: 'INFORMATION MESSAGE',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        <!-- Check for errors -->
        @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
            </ul>
        </div>
        @endif

</x-layout>

            