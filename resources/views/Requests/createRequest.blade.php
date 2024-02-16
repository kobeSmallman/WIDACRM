<x-layout>
    <div class="container mt-4">
        <h2>Create Request</h2>

        <div id="clientOrdersContainer">
            <h3>Client Orders</h3>
            <table class="table" id="clientOrdersTable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Client ID</th>
                        <th>Company Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Orders will be filled here by JavaScript -->
                </tbody>
            </table>
        </div>

        <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">Make New Request</a>
    </div>

    <!-- Include DataTables scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

    <script>
        function fetchAllClientOrders() {
            fetch('/orders/all') // Adjust the endpoint as necessary
                .then(response => response.json())
                .then(orders => {
                    const ordersTableBody = document.getElementById('clientOrdersTable').querySelector('tbody');
                    ordersTableBody.innerHTML = ''; // Clear existing rows

                    orders.forEach(order => {
                        (order.products || []).forEach(product => {
                            const row = `<tr>
                                            <td>${order.Order_ID}</td>
                                            <td>${order.Client_ID}</td>
                                            <td>${order.client.Company_Name}</td>
                                            <td>${product.Product_Name}</td>
                                            <td>${product.Quantity}</td>
                                            <td>${product.Price}</td>
                                          </tr>`;
                            ordersTableBody.insertAdjacentHTML('beforeend', row);
                        });
                    });

                    // Initialize DataTable
                    $('#clientOrdersTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        responsive: true,
                        autoWidth: false,
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Call the function to fetch all client orders when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            fetchAllClientOrders();
        });
    </script>
</x-layout>
