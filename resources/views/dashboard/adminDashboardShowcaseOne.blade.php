{{-- adminDashboardShowcaseOne.blade.php --}}
<div id="renewalsCalendar"></div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('renewalsCalendar');
    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ FullCalendar.dayGridPlugin, FullCalendar.interactionPlugin ],
            initialView: 'dayGridMonth',
            events: [
                // Your events here
            ],
            // Additional FullCalendar options...
        });
        calendar.render();
    }
});
</script>
@endpush
