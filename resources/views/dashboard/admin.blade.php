<x-layout>
    <!-- Dashboard Header -->
  <h2>Dashboard</h2>
    <hr/>

    <div class="row text-center">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

<!-- Custom Styles -->
<style>
    x-layout {
        font-family: 'Open Sans', sans-serif;
    }
    .card {
        
        border: none;
        border-radius: 15px; /* Rounded corners */
    }

    .card-header {
        
        background-color: #3498db; /* Match the report page header color */
        color: white; /* White text for the header */
    }

    .card h5 {
        font-size: 2.3rem; /* Larger font size for card titles */
    }

    .text-center h1, .text-center h2 {
        font-weight: 600; /* Bolder font for headers */
    }

    .chart-container {
        background-color: white; /* Change the background to white */
        color: black; /* Adjust text color if needed */
        padding: 10px;
        border-radius: 15px;
        width: 90vw; /* or you can use '80vw' for viewport width */
        margin: auto;
    }

    .card .display-3 {
        font-size: 2rem; /* Larger font size for card text */
        width: 80%; /* or you can use '80vw' for viewport width */
        margin: auto;
    }

    .card.bg-warning .display-3,
    .card.bg-warning .card-title {
        color: #fff; /* Or any color that you want */
    }
</style>


<div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
              
                    <h5 class="card-title"  style="color:black;  font-weight: bold; ">Total Orders</h5>
             <hr>
                <div class="card-body">
                    <p class="card-text display-3"  style="color:black;  font-weight: bold; ">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
               
                    <h5 class="card-title"  style="color:black;  font-weight: bold; ">Total Sales</h5>
                    <hr>
                <div class="card-body">
                    <p class="card-text display-3"  style="color:black;  font-weight: bold; ">${{ number_format($totalSales, 2) }}</p>
                </div>
            </div>
        </div>
      
        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-white">
             
                    <h5 class="card-title"  style="color:black;  font-weight: bold; ">Total Clients</h5>
                    <hr>
                <div class="card-body">
                    <p class="card-text display-3"  style="color:black;  font-weight: bold; ">{{ $totalClients }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Orders Chart -->
    <div class="text-center">
       

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

