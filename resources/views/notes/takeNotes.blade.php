{{-- takeNotes.blade.php --}}
<x-layout>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <!-- Search bar and client list -->
                <input type="text" id="searchClients" class="form-control" placeholder="Search Clients" onkeyup="searchClients()">
                <div id="clientsList" class="list-group">
                    <!-- Alphabetically ordered clients will be listed here -->
                </div>
            </div>
            <div class="col-md-8">
                <!-- Client details -->
                <div id="clientDetails" class="d-flex flex-column">
                    <!-- Placeholder for client information -->
                    <h2>Client Information</h2>
                    <p><strong>Company Name:</strong> {{ $client->Company_Name }}</p>
                    <p><strong>Main Contact:</strong> {{ $client->Main_Contact }}</p>
                    <p><strong>Shipping Address:</strong> {{ $client->Shipping_Address }}</p>
                    <p><strong>Billing Address:</strong> {{ $client->Billing_Address }}</p>
                    <p><strong>Email:</strong> {{ $client->Email }}</p>
                    <p><strong>Phone Number:</strong> {{ $client->Phone_Number }}</p>
                    <p><strong>Lead Status:</strong> {{ $client->Lead_Status }}</p>
                    <p><strong>Buyer Status:</strong> {{ $client->Buyer_Status }}</p>
                </div>
                <!-- Interaction section -->
                <div class="mt-3">
                    <select id="interactionType" class="form-select">
                        <!-- Interaction types options -->
                    </select>
                    <input type="date" id="chooseDate" class="form-control mt-1">
                    <textarea id="notesDisplay" class="form-control mt-1" ondblclick="readNote()">
                        <!-- Notes will be displayed here -->
                    </textarea>
                    <button id="newNote" class="btn btn-primary mt-1">New</button>
                </div>
                <!-- Old notes section -->
                <div class="mt-3">
                    <button id="oldNotes" class="btn btn-secondary">Client Old Notes</button>
                    <!-- Old notes display or additional textarea -->
                </div>
                <!-- Note metadata placeholders -->
                <div id="noteMeta" class="d-flex flex-column mt-3">
                    <!-- Note metadata placeholders -->
                </div>
                <!-- Action buttons -->
                <div class="mt-3">
                    <button id="attachFiles" class="btn btn-secondary">Attach Files</button>
                    <button id="addRequest" class="btn btn-secondary">Add Request</button>
                    <button id="saveNote" class="btn btn-primary">Save</button>
                </div>
                <!-- Client order details -->
                <div id="clientOrders" class="mt-3">
                    <!-- Client order details placeholder -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript functions to implement:
        // searchClients(), fetchClientDetails(), readNote(), createNewNote(), fetchOldNotes(), fetchClientOrders()

        // Implement the functions as required.
    </script>
</x-layout>
