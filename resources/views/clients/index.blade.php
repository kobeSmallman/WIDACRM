@include('partials.header')
<link rel="stylesheet" href="{{ asset('css/clientIndex.css') }}">

<h2>Clients</h2>
<button type="button" onclick="toggleClientForm()">Add New Client</button>


<div id="newClientForm" style="display: none;">
<form action="{{ route('clients.store') }}" method="POST">
    @csrf
        <div>
            <label for="Company_Name">Company Name:</label>
            <input type="text" id="Company_Name" name="Company_Name" required>
        </div>
        <div>
            <label for="Main_Contact">Main Contact:</label>
            <input type="text" id="Main_Contact" name="Main_Contact" required>
        </div>
        <div>
            <label for="Lead_Status">Lead Status:</label>
            <input type="text" id="Lead_Status" name="Lead_Status" required>
        </div>
        <div>
            <label for="Buyer_Status">Buyer Status:</label>
            <input type="text" id="Buyer_Status" name="Buyer_Status" required>
        </div>
        <div>
            <label for="Shipping_Address">Shipping Address:</label>
            <input type="text" id="Shipping_Address" name="Shipping_Address" required>
        </div>
        <div>
            <label for="Billing_Address">Billing Address:</label>
            <input type="text" id="Billing_Address" name="Billing_Address" required>
        </div>
        <div>
            <label for="Phone_Number">Phone Number:</label>
            <input type="text" id="Phone_Number" name="Phone_Number" required>
        </div>
        <div>
            <label for="Email">Email:</label>
            <input type="email" id="Email" name="Email" required>
        </div>
        <div>
            <button type="submit">Confirm</button>
        </div>
    </form>
</div>
<h2>Clients</h2>
<table>
    <thead>
        <tr>
            <th>Client Name</th>
            <th>Main Contact</th>
            <th>Shipping Address</th>
            <th>Billing Address</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Lead Status</th>
            <th>Buyer Status</th>
            <th>Orders</th> {{-- New column for orders --}}
            <!-- Add more headers if needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->Company_Name }}</td>
                <td>{{ $client->Main_Contact }}</td>
                <td>{{ $client->Shipping_Address }}</td>
                <td>{{ $client->Billing_Address }}</td>
                <td>{{ $client->Email }}</td>
                <td>{{ $client->Phone_Number }}</td>
                <td>{{ $client->Lead_Status }}</td>
                <td>{{ $client->Buyer_Status }}</td>
                <td>
                    @foreach ($client->orders as $order)
                        <details>
                        <summary>Order ID: {{ $order->getOrderID() }}</summary>
                            <div>
                                @foreach ($order->products as $product)
                                    <p>{{ $product->Product_Name }} - Quantity: {{ $product->Quantity }}</p>
                                @endforeach
                            </div>
                        </details>
                    @endforeach
                </td>
                <!-- Add more data columns if needed -->
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function toggleClientForm() {
        var form = document.getElementById('newClientForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
