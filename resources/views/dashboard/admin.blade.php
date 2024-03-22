<x-layout>
    <!-- Dashboard Header -->
    <div class="text-center">
        <h1>WIDA</h1>
        <h4>Overview of business performance</h4>
    </div>
    <hr/>

    <div class="row text-center">
        <!-- Custom CSS for cards -->
        <style>
            .card .display-3 {
                font-size: 2.5rem; /* Default font size */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            /* Responsive font size */
            @media (max-width: 991px) {
                .card .display-3 {
                    font-size: 2rem; /* Smaller font size for smaller screens */
                }
            }

            @media (max-width: 767px) {
                .card .display-3 {
                    font-size: 1.5rem; /* Even smaller font size for very small screens */
                }
            }
        </style>

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
                       <option value="weekly" {{ request('timeRange') == 'weekly' ? 'selected' : '' }}>Weekly</option>
            <option value="monthly" {{ request('timeRange') == 'monthly' ? 'selected' : '' }}>Monthly</option>
        </select>
    </div>
    <div class="mt-3 text-center">
    <button type="submit" class="btn btn-primary">Update Report</button>
   
        <a href="{{ route('reports.index') }}" class="btn btn-primary">View All Reports</a>
    </div>
</form>

    </div>

    <div class="chart-container" style="position: relative; max-height:500px; height:40vh; width:80vw; margin: auto;">
        {!! $chartHTML !!} <!-- Render the chart for monthly orders -->
    </div>


    <!-- Ensure there is enough space above the footer -->
    <div style="margin-bottom: 100px;"></div> 

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert or other JS code can go here if needed
        });
    </script>
</x-layout>

