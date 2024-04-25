<x-layout>
    <!-- Dashboard Header -->
    <div class="text-center">
        <h2 class="report-heading">Personal Reports | Today is: {{ now()->toFormattedDateString() }}</h2>
    </div>
    <hr/>

    <!-- Cards for Average Deal Sizes and More Reports Dropdown -->
 <!-- Cards for Average Deal Sizes -->
<div class="d-flex justify-content-between mb-4">
    <!-- WIDA's Average Deal Size Card -->
    <div   class="card bg-info text-white" class="card average-deal-card mx-1" style="width: calc(33.333% - 10px);">
        <div class="card-header">
            <h2 class="card-title-heading">WIDA's Average Deal Size</h2>
        </div>
        <div class="card-body">
            <p class="card-text average-deal-amount">${{ number_format($chartData['widaAverageDealSize'], 2) }}</p>
        </div>
    </div>

    <!-- Your Average Deal Size Card -->
    <div  class="card bg-success text-white" class="card average-deal-card mx-1" style="width: calc(33.333% - 10px);">
        <div class="card-header">
            <h2 class="card-title-heading">Your Average Deal Size</h2>
        </div>
        <div class="card-body">
            <p class="card-text average-deal-amount">${{ number_format($chartData['yourAverageDealSize'], 2) }}</p>
        </div>
    </div>

    <!-- More Reports Dropdown Card, keeping the same width for consistency -->
    <div  class="card bg-warning text-white"class="card dropdown-card mx-1" style="width: calc(33.333% - 10px);">
            <div class="card-header">
                <h2 class="card-title-heading">More Reports</h2>
            </div>
            <div class="card-body">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle report-dropdown" type="button" id="moreReportsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Report
                    </button>
                    <div class="dropdown-menu" style="width: 100%; background-color:#3498db; color: white;"><!-- Added inline style for dropdown width -->
                        <a class="dropdown-item" style="color:white;  font-weight: bold; " href="{{ route('clientSalesSummary.index') }}">Client Sales Report</a>
                        <a class="dropdown-item" style="color:white;  font-weight: bold; " href="{{ route('salesByEmployeeReport.index') }}">Sales by Employee</a>
                        <a class="dropdown-item" style="color:white;  font-weight: bold; " href="{{ route('orderVolumeReport.index') }}">Order Volume by Date</a>
                        <a class="dropdown-item" style="color:white;  font-weight: bold; " href="{{ route('ordersByStatus.index') }}">Orders by Status</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Charts with Titles moved to the header -->
  <div class="row">
        <!-- Your Total Orders Chart Card -->
        <div class="col-md-6">
            <div class="card chart-card">
                <div class="card-header">
                    <h2 class="chart-title"style="color:black">Your Total Orders</h2>
                </div>
                <div class="card-body chart-container">
                    <canvas id="totalOrdersChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Your Total Sales Chart Card -->
        <div class="col-md-6">
            <div class="card chart-card">
                <div class="card-header">
                    <h2 class="chart-title" style="color:black">Your Total Sales</h2>
                </div>
                <div class="card-body chart-container">
                    <canvas id="totalSalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const chartData = @json($chartData);

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                ticks: {
                    beginAtZero: true,
                    color: '#FFFFFF'
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'
                }
            },
            x: {
                ticks: {
                    color: '#FFFFFF'
                },
                grid: {
                    display: false
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: '#FFFFFF'
                }
            }
        },
        backgroundColor: '#FFFFFF'

    };

    new Chart(document.getElementById('totalOrdersChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Your Total Orders'],
            datasets: [{
                label: 'Orders',
                data: [chartData.totalOrders],
                backgroundColor: '#4169E1',
                borderColor: '#4169E1',
                borderWidth: 1
            }]
        },
        options: chartOptions
    });

    new Chart(document.getElementById('totalSalesChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Your Total Sales'],
            datasets: [{
                label: 'Sales',
                data: [chartData.totalSales],
                backgroundColor: '#4169E1',
                borderColor: '#4169E1',
                borderWidth: 1
            }]
        },
        options: chartOptions
    });
});
</script>
</x-layout>
<style>
    /* Styles for dropdown buttons */
    .btn-primary {
        background-color: #3498db; /* Darker blue */
        border: none;
    }

    /* Dropdown menu items */
    .dropdown-menu {
        background-color: #2c3e50; /* Darker blue */
    }

    .dropdown-item {
        color: #ffffff; /* White text */
    }

    .dropdown-item:hover, .dropdown-item:focus {
        color: #ffffff; /* White text */
        background-color: #4169E1; /* Royal blue for hover/focus */
    }

    .chart-container {
        height: 60vh; /* Set to 60% of the viewport height, or adjust as needed */
        background-color: white; /* Ensure the container background is black */
        margin-bottom: 2rem; /* Space below the chart */
        
    }

    .chart-container canvas {
        height: 100% !important; /* Ensure the canvas fills the container */
    }
    
    .chart-card .card-body {
        padding: 0;
        position: relative; /* Set the position to relative so that the chart can size itself based on this container */
        width: 100%; /* Set to 100% of the container */
        max-height: 400px; /* Adjust max height as needed */
    }

    .report-heading {
        font-size: 26px;
       align-items:center;
    }

    .card-title-heading {
        font-size: 14px;
        font-weight: bold;
    }

    .average-deal-amount {
        font-size: 30px;
        font-weight: bold;
        border-radius: 15px;
        align-items:center;
        text-align:center;
    }

    .average-deal-card {
        width: 20rem; /* Adjust width as needed */
        border-radius: 15px;
        text-align:center;
    }

    .dropdown-card {
        width: 20rem; /* Adjust width for dropdown card */
        border-radius: 15px;
        text-align:center;
        color:white;
    }

    .report-dropdown {
        font-size: 20px; /* Larger font size for dropdown */
        width: 100%; /* Make dropdown full width */
        color: white;
    }

    .chart-title {
        
        font-size: 14px;
        font-weight: bold;
    }
    .average-deal-card, .dropdown-card, .chart-card {
        background-color: white;
        border: none;
        border-radius: 15px; /* Rounded corners */
       
    }

    .card-title-heading, .chart-title {
        font-size: 24px;
        color:white;
        font-weight: bold;
        margin-bottom: 0.5rem;
        text-align:center;
    }

    .average-deal-amount, .report-dropdown {
        font-size: 2rem; /* Larger font size for the amount and dropdown */
        font-weight: bold;
    }

    .dropdown-card .card-header, .average-deal-card .card-header {
        background-color: #3498db; 
    }

    .dropdown-menu {
        background-color: #2c3e50; /* Matching dropdown style */
        color:white;
    }

    .report-dropdown {
        color:white;
        font-size: 1.5rem;
        width: 100%;
    }


</style>
