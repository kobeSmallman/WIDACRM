<x-layout>
    <div class="container mt-4">
        <h2>Create Request</h2>

        <!-- Request Form -->
        <form action="{{ route('requests.store') }}" method="POST" id="requestForm">
            @csrf

            <!-- Client Selection Dropdown -->
            <div class="mb-3">
                <label for="clientSelect" class="form-label">Select Client:</label>
                <select id="clientSelect" name="client_id" class="form-control" onchange="fetchClientOrders(this.value)">
    <option value="">All Clients</option>
    @foreach ($clients as $client)
        <option value="{{ $client->Client_ID }}">{{ $client->Client_ID }} - {{ $client->Company_Name }}</option>
    @endforeach
</select>



            </div>

            <!-- Here we'll display client's orders -->
            <div id="clientOrdersContainer" style="display:none;">
                <h3>Client Orders</h3>
                <table class="table" id="clientOrdersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Orders will be filled here by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Product Requests Container -->
            <div id="productRequestsContainer">
                <!-- Dynamic product requests will be added here -->
            </div>

            <!-- Add Request Button -->
            <button type="button" class="btn btn-info mt-3" id="addRequestButton">Add Another Request</button>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-3">Submit All Requests</button>
        </form>
    </div>

    <script>
        let productRequestIndex = 0;

        // Function to dynamically add product request forms
        function addProductRequestForm() {
            // Your existing function to add product request forms
        }

        function fetchClientOrders(clientId) {
    let url = clientId ? `/clients/${clientId}/orders` : '/orders/all';

    fetch(url)
        .then(response => response.json())
        .then(orders => {
            const ordersTableBody = document.getElementById('clientOrdersTable').querySelector('tbody');
            ordersTableBody.innerHTML = ''; // Clear existing rows
            
            orders.forEach(order => {
                (order.products || []).forEach(product => {
                    const row = `<tr>
                                    <td>${order.Order_ID}</td>
                                    <td>${product.Product_Name}</td>
                                    <td>${product.Quantity}</td>
                                    <td>${product.Price}</td>
                                </tr>`;
                    ordersTableBody.insertAdjacentHTML('beforeend', row);
                });
            });
            
            document.getElementById('clientOrdersContainer').style.display = 'block';
        })
        .catch(error => console.error('Error:', error));
}

// Initialize with all orders when the page loads
fetchClientOrders();

    </script>
</x-layout>
