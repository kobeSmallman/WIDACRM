<x-layout>
    <!-- Content Header -->
    <div class="text-center">
        <h1>Order Volume Over Time</h1>
    </div>

    <!-- Time Range Selection Form -->
    <form action="{{ route('orderVolumeReport.index') }}" method="GET">
        <div class="form-group">
            <label for="timeRange">Select Time Range:</label>
            <select name="timeRange" id="timeRange" class="form-control" style="background-color:#3498db; color:black; font-weight:bold;">
                <option value="daily"  style="color:black; font-weight:bold;">Daily</option>
                <option value="weekly" style="color:black; font-weight:bold;">Weekly</option>
                <option value="monthly"style="color:black; font-weight:bold;" selected>Monthly</option>
                <option value="yearly" style="color:black; font-weight:bold;">Yearly</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Report</button>
    </form>
    
    <!-- Chart Rendering -->
    {!! $chartHTML !!}

    
</x-layout>
<style>
    
   body{
    color:black;
   }

</style>