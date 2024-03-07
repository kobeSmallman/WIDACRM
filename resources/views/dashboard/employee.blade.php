{{-- resources/views/dashboard/employee.blade.php --}}
<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <ul class="nav nav-tabs" id="employeeDashboardTabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#calendarTab" role="tab">Calendar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#leadsTab" role="tab">Open Leads</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="calendarTab" role="tabpanel">
            {{-- Include the Calendar content here --}}
            @include('dashboard.employeeCalendar')
        </div>
        <div class="tab-pane" id="leadsTab" role="tabpanel">
            {{-- Include the Open Leads content here --}}
            @include('dashboard.employeeLeads')
        </div>
    </div>

    @push('scripts')
        {{-- Include necessary scripts for calendar and other functionalities --}}
    @endpush
</x-layout>
