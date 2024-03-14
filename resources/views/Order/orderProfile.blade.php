<x-layout>
<!-- Add your existing <style> tag here with the CSS adjustments -->
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
        
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative; /* Adjusted for absolute positioning */
        padding: 0.75rem; /* Adjusted padding */
        height: 40px;
    }

    .card-title {
        margin-bottom: 0; /* Remove bottom margin from h3 to prevent overflow */
        padding-left: 1rem; /* Add padding to ensure it doesn't overlap with the back button */
    }
    .card-body {
        background-color: #e9ecef;
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-gap: 20px;
        font-size: 16px; /* Adjust font size */
        font-weight: bold; /* Adjust font weight */
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
    .back-button {
        background-color: #343a40; /* Adjusted to match the header */
        border: none;
        color: white;
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1000;
        padding: 5px 10px; /* Adjusted padding */
        font-size: 0.875rem; /* Adjusted font size */
        border-radius: 0.25rem; /* Added border-radius */
    }

    .edit-btn-group {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
    }

    /* Back button style */
    .back-button {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        background-color: #343a40;
        color: white;
        text-decoration: none;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        border: none;
        font-size: 1rem;
        transition: background-color 0.3s;
    }

    .back-button:hover {
        background-color: #2c3034; /* Slightly darker on hover */
        color: white;
        text-decoration: none;
    }


    .edit-btn-group button:hover {
        background-color: #138496; /* Darken button on hover for visual feedback */
    }
    .card-footer {
        display: flex;
        justify-content: flex-end;
    }
    /* Card-like sections */
    .order-details, .client-details, .product-details, .payment-details {
        background-color: white;
        border-radius: 4px;
        margin-bottom: 15px;
        padding: 20px;
        border: 1px solid #dee2e6;
        cursor: pointer; /* Indicates that section is clickable */
    }
    .order-details:hover, .client-details:hover, .product-details:hover, .payment-details:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: scale(1.03); /* Slightly enlarges the section */
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-info" id="element-to-download">
            <div class="card-header sidebar-dark-primary">
               
                <div class="edit-btn-group">
                    <!-- Buttons here will be absolutely positioned inside the header -->
                    <button onclick="printOrder()" class="btn btn-sm btn-primary">Print</button>
                    <button onclick="downloadOrder()" class="btn btn-sm btn-secondary">Download</button>
                    <button onclick="editOrder()" class="btn btn-sm btn-info">Edit</button>
                </div>
                <a href="{{ route('orders.index') }}" class="btn back-button">Back to Orders</a>
            </div>
                <div class="card-body">
                    <div class="order-details">
                    <a href="{{ route('orders.edit', $order->Order_ID) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-pencil-alt"></i> Edit Order
    </a>
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
                        <a href="{{ route('orders.edit', $order->Order_ID) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-pencil-alt"></i> Edit Products
    </a>
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
    const element = document.getElementById('element-to-download'); // Make sure this is the ID of the element you want to download

    if (!element) {
        console.error(`Element with ID "element-to-download" not found.`);
        return;
    }

    const margin = 10; // Margin for the PDF
    const width = element.scrollWidth + margin * 2; // Calculate width with margins
    const height = element.scrollHeight + margin * 2; // Calculate height with margins

    // Options for html2canvas
    const canvasOptions = {
        scale: 3, // Adjust scale as necessary to improve quality or fit content
        width: width, // Set canvas width
        height: height, // Set canvas height
        scrollX: -window.scrollX,
        scrollY: -window.scrollY,
        backgroundColor: null // To allow for transparent backgrounds
    };

    html2canvas(element, canvasOptions).then((canvas) => {
        const imgData = canvas.toDataURL('image/png');

        // Create a PDF with the same dimensions as the canvas
        const pdf = new jsPDF({
            orientation: 'landscape', // Set orientation based on your content
            unit: 'px',
            format: [canvas.width, canvas.height]
        });

        // Add the canvas image to the PDF
        pdf.addImage(imgData, 'PNG', margin, margin, canvas.width - margin * 2, canvas.height - margin * 2);
        pdf.save('download.pdf');
    }).catch(error => console.error('Error generating PDF', error));
}

// Edit functionality
function editOrder() {
}

</script>
