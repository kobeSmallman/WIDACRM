<x-layout>
    <div id="clientDetails">
    </div>
    <div id="Notes">
        @include('notes.listNotes', ['notes' => $notes])
    </div>
    <div id="Orders">
        @include('notes.orderDetails', ['orders' => $orders])
    </div>
</x-layout>


need to maintain object / array from this blade to iner blades