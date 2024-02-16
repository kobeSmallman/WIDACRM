@if(is_array($orders) || is_object($orders))
    @foreach ($orders as $order)
        <li>{{ $order->Remarks }}</li>
    @endforeach
@else
    <p>No Orders available.</p>
@endif

