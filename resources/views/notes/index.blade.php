{{-- resources/views/notes/index.blade.php --}}
<x-layout>
    <link rel="stylesheet" href="{{ asset('css/notesIndex.css') }}">

    <div class="container">
        <div class="row">
            <!-- Client Information on the left -->
            <div class="col-md-6">
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

            <!-- Notes Information on the right -->
            <div class="col-md-6">
                <h2>Notes</h2>
                @foreach ($client->notes as $note)
                <div class="note">
                    <h4>Note by: {{ $note->employee->First_Name }} {{ $note->employee->Last_Name }}</h4>
                    <p><strong>Interaction Type:</strong> {{ $note->Interaction_Type }}</p>
                    <p><strong>Description:</strong> {{ $note->Description }}</p>
                    <p><strong>Date:</strong> {{ $note->Date_Time->format('m/d/Y H:i') }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // Your existing JavaScript here
    </script>
</x-layout>