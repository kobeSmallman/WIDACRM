@if(is_array($notes) || is_object($notes))
    @foreach ($notes as $note)
        <li>{{ $note->Description }}</li>
    @endforeach
@else
    <p>No notes available.</p>
@endif


