{{-- resources/views/reports/orderVolumeByDateReport.blade.php --}}
<x-layout>
    <!-- Content Header -->
    <div class="text-center">
        <h1>Order Volume Over Time</h1>
    </div>

    <!-- Time Range Selection Form -->
    <form action="{{ route('orderVolumeReport.index') }}" method="GET">
        <div class="form-group">
            <label for="timeRange">Select Time Range:</label>
            <select name="timeRange" id="timeRange" class="form-control">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly" selected>Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Report</button>
    </form>
    
    <!-- Chart Rendering -->
    {!! $chartHTML !!}
</x-layout>
