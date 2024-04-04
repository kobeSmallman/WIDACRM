<x-layout>
    <!-- Dashboard Header -->
    <div class="text-center">
        <h1>WIDA</h1>
        <h4>Overview of business performance</h4>
    </div>
    <hr/>

    <div class="row text-center">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

<!-- Custom Styles -->
<style>
        x-layout {
            font-family: 'Open Sans', sans-serif;
        }
       
   
    .card {
        background: linear-gradient(160deg, #000000 0%, #4169E1 100%);

        border: none;
        border-radius: 15px; /* Rounded corners */
    }
    .card h5 {
        font-size: 1.5rem; /* Larger font size for card titles */
    }
    
    .text-center h1, .text-center h4 {
        font-weight: 600; /* Bolder font for headers */
    }
    .chart-container {
    background-color: #1e1e1e;
    padding: 10px;
    border-radius: 15px;
    width: 90vw; /* or you can use '80vw' for viewport width */
    margin: auto;
}
            .card .display-3 {
                font-size: 2.5rem; /* Default font size */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                font-size: 3rem; /* Larger font size for card text */
                width: 80%; /* or you can use '80vw' for viewport width */
    margin: auto;
                 /* Accent color */
            }
            .card.bg-warning .display-3 {
    color: #fff; /* Or any color that you want */
}
.card.bg-warning .card-title {
    color: #fff; /* Or any color that you want */
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
    <script>
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        // Reloads the current page
        window.location.reload();
    }, 100);
});
</script>

</x-layout>

