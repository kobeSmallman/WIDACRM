<x-layout>
    {{-- Include the CSRF Token Meta Tag --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
    <script src="{{ asset('js/fullcalendar-core.js') }}"></script>
    <script src="{{ asset('js/fullcalendar-daygrid.js') }}"></script>
    <script src="{{ asset('js/fullcalendar-interaction.js') }}"></script> {{-- Include this line if you have the interaction plugin --}}
    
    {{-- Bootstrap Tab Navigation --}}
    <ul class="nav nav-tabs" id="adminDashboardTabs">
        <li class="nav-item">
            <a class="nav-link active" id="showcaseOne-tab" data-toggle="tab" href="#showcaseOne" role="tab">Renewals & Follow-ups</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="showcaseTwo-tab" data-toggle="tab" href="#showcaseTwo" role="tab">Communication Frequency</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="showcaseThree-tab" data-toggle="tab" href="#showcaseThree" role="tab">Interaction Timeline</a>
        </li>
    </ul>

    {{-- Tab Content --}}
    <div class="tab-content">
        <div class="tab-pane fade show active" id="showcaseOne" role="tabpanel" aria-labelledby="showcaseOne-tab">
            @include('dashboard.adminDashboardShowcaseOne')
        </div>
        <div class="tab-pane fade" id="showcaseTwo" role="tabpanel" aria-labelledby="showcaseTwo-tab">
            @include('dashboard.adminDashboardShowcaseTwo')
        </div>
        <div class="tab-pane fade" id="showcaseThree" role="tabpanel" aria-labelledby="showcaseThree-tab">
            @include('dashboard.adminDashboardShowcaseThree')
        </div>
    </div>

    {{-- Include FullCalendar scripts --}}
   

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Initialize tabs
                $('#adminDashboardTabs a').on('click', function(e) {
                    e.preventDefault();
                    $(this).tab('show');
                });

                // Initialize placeholders for graphs
                $('#renewalsGraph').text('Renewals graph will go here');
                $('#communicationFrequencyGraph').text('Communication frequency graph will go here');
                $('#interactionTimelineGraph').text('Customer interaction timeline will go here');

                // Example AJAX call to load data for the Renewals & Follow-ups
                // ... Your AJAX calls ...

                // Initialize FullCalendar
                var calendarEl = document.getElementById('renewalsCalendar');
                if (calendarEl) {
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        plugins: [ FullCalendar.dayGridPlugin, FullCalendar.interactionPlugin ],
                        initialView: 'dayGridMonth',
                        events: [
                            // Event data array here
                            // e.g., { title: 'Event 1', date: 'YYYY-MM-DD' }
                        ],
                        // Other FullCalendar options...
                    });
                    calendar.render();
                }
            });
        </script>
    @endpush
</x-layout>
