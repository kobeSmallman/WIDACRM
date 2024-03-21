<x-layout>
    <!-- Dashboard Header -->
    <div class="text-center">
        <h1>Dashboard</h1>
        <h4>Overview of business performance</h4>
    </div>
    <hr/>

    <!-- Stats Cards -->
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text display-3">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text display-3">${{ number_format($totalSales, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Clients</h5>
                    <p class="card-text display-3">{{ $totalClients }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Orders Chart -->
    <div class="text-center">
        <h2>Order Volume Over Time</h2>

        <!-- Time Range Selection Form -->
        <form action="{{ route('admin.dashboard') }}" method="GET" style="display: inline-block; margin-bottom: 20px;">
    <div class="form-group">
        <label for="timeRange">Select Time Range:</label>
        <select name="timeRange" id="timeRange" class="form-control" style="width: auto; display: inline-block;">
            <option value="daily" {{ request('timeRange', 'daily') == 'daily' ? 'selected' : '' }}>Daily</option>
                       <option value="weekly" {{ request('timeRange') == 'weekly' ? 'selected' : '' }}>Weekly</option>
            <option value="monthly" {{ request('timeRange') == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="yearly" {{ request('timeRange') == 'yearly' ? 'selected' : '' }}>Yearly</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Report</button>
</form>

    </div>

    <div class="chart-container" style="position: relative; height:40vh; width:80vw; margin: auto;">
        {!! $chartHTML !!} <!-- Render the chart for monthly orders -->
    </div>

    <!-- Button to view all reports -->
    <div class="mt-3 text-center">
        <a href="{{ url('reports/indexReports') }}" class="btn btn-primary">View All Reports</a>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert or other JS code can go here if needed
        });
    </script>
</x-layout>

