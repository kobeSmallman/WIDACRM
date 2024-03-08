<x-layout>
<style>
        body {
            padding-top: 20px;
        }
        .container-fluid {
            padding: 15px;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .card-header {
            background-color: #17a2b8;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-body {
            background-color: #e9ecef;
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-gap: 20px;
        }
        .client-info-box {
            background: white;
            border: 1px solid #dee2e6;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
            position: absolute;
            right: 15px;
            top: 15px;
        }
        .edit-btn-group {
            text-align: right;
        }
        .edit-btn-group button {
            margin-left: 10px;
        }
        .back-button {
            margin-bottom: 20px;
        }
        .card-footer {
            display: flex;
            justify-content: flex-end;
        }
    </style>

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Profile</h1>
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
                    <!-- Buttons for actions -->
                   
                    <div class="edit-btn-group">
                        <button onclick="printOrder()" class="btn btn-primary">Print</button>
                        <button onclick="downloadOrder()" class="btn btn-secondary">Download</button>
                        <button onclick="editOrder()" class="btn btn-info">Edit</button>
                        <button onclick="saveOrder()" class="btn btn-success">Save</button>
                    </div>
                </div>
                </div>
                <div class="card-body">
                    <div class="order-details">
                        <h4>Basic Information</h4>
                        <p><strong>Order ID:</strong> {{ $order->Order_ID }}</p>
                        <p><strong>Request Date:</strong> {{ $order->Request_DATE }}</p>
                        <p><strong>Request Status:</strong> {{ $order->Request_Status }}</p>
                        <p><strong>Remarks:</strong> {{ $order->Remarks }}</p>
                        <p><strong>Order Date:</strong> {{ $order->Order_DATE }}</p>
                        <p><strong>Order Status:</strong> {{ $order->Order_Status }}</p>
                        <p><strong>Quotation Date:</strong> {{ $order->Quotation_DATE }}</p>
                        <!-- Add more fields from the Order table if necessary -->
                    </div>

                    <div class="client-details">
                        <h4>Client Information</h4>
                        <!-- Assuming $order->client contains the client information -->
                        <p><strong>Client ID:</strong> {{ $order->client->Client_ID }}</p>
                        <p><strong>Company Name:</strong> {{ $order->client->Company_Name }}</p>
                        <p><strong>Main Contact:</strong> {{ $order->client->Main_Contact }}</p>
                        <p><strong>Phone Number:</strong> {{ $order->client->Phone_Number }}</p>
                        <p><strong>Email:</strong> {{ $order->client->Email }}</p>
                        <p><strong>Shipping Address:</strong> {{ $order->client->Shipping_Address }}</p>
                        <p><strong>Billing Address:</strong> {{ $order->client->Billing_Address }}</p>
                        <!-- Add more fields from the Client table if necessary -->
                    </div>

                    <div class="product-details">
                        <h4>Products</h4>
                        @if ($order->products)
                @foreach ($order->products as $product)
                        <div class="card">
                        <div class="card-body">
                                <h5>{{ $product->Product_Name }}</h5>
                                <p><strong>Quantity:</strong> {{ $product->Quantity }}</p>
                                <p><strong>Product Price:</strong> {{ $product->Product_Price }}</p>
                                <p><strong>Vendor ID:</strong> {{ $product->Vendor_ID }}</p>
                                <p><strong>Shipping Status:</strong> {{ $product->Shipping_Status }}</p>
                                <p><strong>Product Status:</strong> {{ $product->Product_Status }}</p>
                                <!-- Add other product details if necessary -->
                            </div>
                        </div>
                        @endforeach
            @else
                <p>No products found.</p>
            @endif
                    </div>

                    <div class="payment-details">
                        <h4>Payment Information</h4>
                        <!-- Assuming $order->payments contains the payment information -->
                        @if ($order->payments)
                @foreach ($order->payments as $payment)
                            <p><strong>Payment ID:</strong> {{ $payment->PMT_ID }}</p>
                            <p><strong>Payment Type:</strong> {{ $payment->payment_type->PMT_Type_Name }}</p>
                            <p><strong>Amount:</strong> {{ $payment->Amount }}</p>
                            <!-- Add more fields from the Payment table if necessary -->
                            @endforeach
            @else
                <p>No payment information found.</p>
            @endif
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </x-layout>
    <script>
  // JavaScript function to trigger printing the order details
  function printOrder() {
    window.print();
  }

  // JavaScript function to download the order details as a PDF
  function downloadOrder() {
    // This would require a library or a backend function to generate a PDF
    alert("This functionality needs to be implemented based on your PDF generation method.");
  }

  // JavaScript function to toggle edit mode for order details
  function editOrder() {
    // Toggle all input fields to be enabled or disabled based on an isEditing flag
    const isEditing = document.getElementById('orderEditForm').classList.contains('editing');
    document.querySelectorAll('#orderEditForm input, #orderEditForm textarea').forEach(input => {
      input.disabled = !isEditing;
    });
    document.getElementById('orderEditForm').classList.toggle('editing');
  }

  // Placeholder function for saving order details
  function saveOrder() {
    // This will need to collect the form data and make a POST request to your backend
    console.log("Save functionality will be implemented later.");
  }
</script>


