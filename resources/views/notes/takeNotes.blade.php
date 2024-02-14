{{-- takeNotes.blade.php --}}
<x-layout>
    <div class="container mt-4">
        <h2>Take Notes</h2>
        <div class="mb-3">
            <label for="clientSelect" class="form-label">Select Client:</label>
            <select id="clientSelect" name="client_id" class="form-select" onchange="clientSelected(this)">
                <option value="">Choose...</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->Client_ID }}">{{ $client->Company_Name }} (ID: {{ $client->Client_ID }})</option>
                @endforeach
            </select>
        </div>

        <div id="clientInfo" class="mb-3" style="display: none;">
            <h3>Client Information</h3>
            <div id="clientDetails"></div>
        </div>

        <form id="notesForm" action="{{ route('notes.store') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="client_id" id="formClientId">
            
            <div class="mb-3">
                <label for="noteDate" class="form-label">Date:</label>
                <input type="datetime-local" class="form-control" id="noteDate" name="date" required>
            </div>
            
            <div class="mb-3">
                <label for="noteText" class="form-label">Notes:</label>
                <textarea class="form-control" id="noteText" name="note" rows="4" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Save Notes</button>
        </form>
    </div>

    <script>
       // ... Your existing JavaScript here ...
    </script>
</x-layout>
