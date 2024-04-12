<x-layout>
    <!-- Content Header -->
    <div class="text-left mt-4">
    <a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>
</div>

    <div class="text-center">
        <h1>Order Volume Over Time</h1>
    </div>

    <!-- Time Range Selection Form -->
    <form action="{{ route('orderVolumeReport.index') }}" method="GET">
    <div class="form-group" style="display: flex; align-items: center;">
    <label for="timeRange">Select Time Range:</label>
    <select name="timeRange" id="timeRange" class="form-control" style="background-color:#3498db; color:white; font-size: 14px; width: auto;">
        <option value="daily" style="color:white; font-weight:bold;">Daily</option>
        <option value="weekly" style="color:white; font-weight:bold;">Weekly</option>
        <option value="monthly" style="color:white; font-weight:bold;" selected>Monthly</option>
        <option value="yearly" style="color:white; font-weight:bold;">Yearly</option>
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