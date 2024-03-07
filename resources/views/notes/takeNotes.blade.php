<x-layout>
    <div class="container mt-4">
        <h2>Take Notes</h2>
        <div class="mb-3">
            <label for="clientSelect" class="form-label">Select Client:</label>
            <select id="clientSelect" name="client_id" class="custom-select" onchange="clientSelected(this)">
                <option value="">Choose...</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->Client_ID }}">{{ $client->Company_Name }} (ID: {{ $client->Client_ID }})</option>
                @endforeach
            </select>
        </div>

        <div id="clientInfo" style="display: none;">
            <h3>Client Information</h3>
            <div id="clientDetails"></div>
        </div>

        <!-- Orders Details -->
        <div class="orders-details" id="ordersDetails">
            <!-- Orders will be loaded here via JavaScript -->
            <div class="table-container">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Created By</th>
                            <th>Request Date</th>
                            <th>Request Status</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Quotation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Last 5 orders will be loaded here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
       function clientSelected(select) {
    const clientId = select.value;
    if (clientId) {
        fetch(`/clients/${clientId}`)
            .then(response => response.json())
            .then(client => {
                // Assuming 'client' is the JSON object with the client's data
                const detailsDiv = document.getElementById('clientDetails');
                detailsDiv.innerHTML = `
                    <p><strong>Company Name:</strong> ${client.company_name}</p>
                    <p><strong>Main Contact:</strong> ${client.main_contact}</p>
                    <p><strong>Email:</strong> ${client.email}</p>
                    <p><strong>Phone Number:</strong> ${client.phone_number}</p>
                `;
                // Make sure you're using the correct property names as they appear in your JSON response
                document.getElementById('clientInfo').style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('clientInfo').style.display = 'none';
    }
}

function createRequest() {
    let clientId = document.getElementById('formClientId').value;
    if (clientId) {
        window.location.href = `/createRequest?client_id=${clientId}`;

            }
        }
    </script>
</x-layout>