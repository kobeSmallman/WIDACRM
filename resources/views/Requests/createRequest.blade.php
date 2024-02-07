{{-- createRequest.blade.php --}}
<x-layout>
    <div class="container mt-4">
        <h2>Create Request</h2>

        <!-- Request Form -->
        <form action="{{ route('requests.store') }}" method="POST">
            @csrf

            <!-- Client Selection Dropdown -->
            <div class="mb-3">
                <label for="clientSelect" class="form-label">Select Client:</label>
                <select id="clientSelect" name="client_id" class="form-control">
                    <option value="">New Client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Product Selection Dropdown -->
            <div class="mb-3">
                <label for="productSelect" class="form-label">Select Product:</label>
                <select id="productSelect" name="product_id" class="form-control">
                    @foreach ($products as $product)
                        <option value="{{ $product->Item_ID }}">{{ $product->Product_Name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Quantity Input -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="form-control" required>
            </div>

            <!-- Additional Notes Textarea -->
            <div class="mb-3">
                <label for="notes" class="form-label">Additional Notes:</label>
                <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>

    <script>
        // Add any JavaScript you need for client-side validation or interaction
    </script>
</x-layout>
