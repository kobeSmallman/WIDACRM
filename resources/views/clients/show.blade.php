{{-- resources/views/clients/show.blade.php --}}
@include('partials.header')
<link rel="stylesheet" href="{{ asset('css/clientShow.css') }}">



<x-layout>
  <x-slot name="title">
    Home | Example Website
  </x-slot>
  <div style="display: flex;">
    <div style="width: 50%;">
        <h2>Client Information</h2>
        <!-- Display client information -->
        <p><strong>Company Name:</strong> {{ $client->Company_Name }}</p>
        <!-- Add more client details here -->
    </div>
    <div style="width: 50%;">
        <h2>Notes</h2>
        <!-- Display notes related to the client -->
        @foreach ($client->notes as $note)
            <p>{{ $note->Description }} - by {{ $note->employee->First_Name }} {{ $note->employee->Last_Name }}</p>
        @endforeach
    </div>
</div>

</x-layout>