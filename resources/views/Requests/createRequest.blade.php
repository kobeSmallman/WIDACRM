{{-- createRequest.blade.php --}}
<x-layout>
    <div class="container mt-4">
        <h2>Create Request</h2>

        <!-- Request Form -->
        <form action="{{ route('requests.store') }}" method="POST" id="requestForm">
            @csrf

            <!-- Client Selection Dropdown -->
            <div class="mb-3">
    <label for="clientSelect" class="form-label">Select Client:</label>
    <select id="clientSelect" name="client_id" class="form-control">
        <option value="">Select a Client</option>
        @foreach ($clients as $client)
            <option value="{{ $client->Client_ID }}">{{ $client->Client_ID }} - {{ $client->Company_Name }}</option>
        @endforeach
    </select>
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

        function addProductRequestForm() {
            const container = document.getElementById('productRequestsContainer');
            const html = `
                <div class="product-request-form mb-3" data-index="${productRequestIndex}">
                    <h5>Request ${productRequestIndex + 1}</h5>
                    <div class="mb-3">
                        <label for="productName${productRequestIndex}" class="form-label">Product Name:</label>
                        <input type="text" id="productName${productRequestIndex}" name="product_requests[${productRequestIndex}][name]" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="productDescription${productRequestIndex}" class="form-label">Product Description:</label>
                        <textarea id="productDescription${productRequestIndex}" name="product_requests[${productRequestIndex}][description]" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice${productRequestIndex}" class="form-label">Product Price:</label>
                        <input type="text" id="productPrice${productRequestIndex}" name="product_requests[${productRequestIndex}][price]" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="quantity${productRequestIndex}" class="form-label">Quantity:</label>
                        <input type="number" id="quantity${productRequestIndex}" name="product_requests[${productRequestIndex}][quantity]" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="notes${productRequestIndex}" class="form-label">Additional Notes:</label>
                        <textarea id="notes${productRequestIndex}" name="product_requests[${productRequestIndex}][notes]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            productRequestIndex++;
        }

        function handleClientSelection() {
            // Implement any additional logic when client is selected, e.g., setting status to lead
        }

        document.getElementById('addRequestButton').addEventListener('click', addProductRequestForm);
            // Add the first product request form on initial page load
    window.addEventListener('DOMContentLoaded', (event) => {
        addProductRequestForm();
    });
</script>
</x-layout>
