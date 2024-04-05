<x-layout>
    <!-- Dashboard Header -->
    <div class="text-center">
        <h1 class="report-heading">Personal Reports | Today is: {{ now()->toFormattedDateString() }}</h1>
    </div>
    <hr/>

    <!-- Cards for Average Deal Sizes and More Reports Dropdown -->
 <!-- Cards for Average Deal Sizes -->
<div class="d-flex justify-content-between mb-4">
    <!-- WIDA's Average Deal Size Card -->
    <div class="card average-deal-card mx-1" style="width: calc(33.333% - 10px);">
        <div class="card-header">
            <h2 class="card-title-heading">WIDA's Average Deal Size</h2>
        </div>
        <div class="card-body">
            <p class="card-text average-deal-amount">${{ number_format($chartData['widaAverageDealSize'], 2) }}</p>
        </div>
    </div>

    <!-- Your Average Deal Size Card -->
    <div class="card average-deal-card mx-1" style="width: calc(33.333% - 10px);">
        <div class="card-header">
            <h2 class="card-title-heading">Your Average Deal Size</h2>
        </div>
        <div class="card-body">
            <p class="card-text average-deal-amount">${{ number_format($chartData['yourAverageDealSize'], 2) }}</p>
        </div>
    </div>

    <!-- More Reports Dropdown Card, keeping the same width for consistency -->
    <div class="card dropdown-card mx-1" style="width: calc(33.333% - 10px);">
            <div class="card-header">
                <h2 class="card-title-heading">More Reports</h2>
            </div>
            <div class="card-body">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle report-dropdown" type="button" id="moreReportsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Report
                    </button>
                    <div class="dropdown-menu" style="width: 100%;"><!-- Added inline style for dropdown width -->
                        <a class="dropdown-item" href="{{ route('clientSalesSummary.index') }}">Client Sales Report</a>
                        <a class="dropdown-item" href="{{ route('salesByEmployeeReport.index') }}">Sales by Employee</a>
                        <a class="dropdown-item" href="{{ route('orderVolumeReport.index') }}">Order Volume by Date</a>
                        <a class="dropdown-item" href="{{ route('ordersByStatus.index') }}">Orders by Status</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts with Titles -->
    <div class="row">
        <!-- Your Total Orders Chart Card -->
        <div class="col-md-6">
            <div class="card chart-card">
                <div class="card-header">
                    <h2 class="chart-title">Your Total Orders</h2>
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
                    <h2 class="chart-title">Your Total Sales</h2>
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
        background-color: black; /* Ensure the container background is black */
        margin-bottom: 2rem; /* Space below the chart */
    }

    .chart-container canvas {
        height: 100% !important; /* Ensure the canvas fills the container */
    }
    .report-heading {
        font-size: 36px;
        font-weight: bold;
    }

    .card-title-heading {
        font-size: 24px;
        font-weight: bold;
    }

    .average-deal-amount {
        font-size: 30px;
        font-weight: bold;
    }

    .average-deal-card {
        width: 20rem; /* Adjust width as needed */
    }

    .dropdown-card {
        width: 20rem; /* Adjust width for dropdown card */
    }

    .report-dropdown {
        font-size: 20px; /* Larger font size for dropdown */
        width: 100%; /* Make dropdown full width */
    }

    .chart-title {
        font-size: 24px;
        font-weight: bold;
    }
    .average-deal-card, .dropdown-card, .chart-card {
        background: linear-gradient(160deg, #000000 0%, #4169E1 100%);
        border: none;
        border-radius: 15px; /* Rounded corners */
        color: #fff;
    }

    .card-title-heading, .chart-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .average-deal-amount, .report-dropdown {
        font-size: 2rem; /* Larger font size for the amount and dropdown */
        font-weight: bold;
    }

    .report-heading {
        font-size: 3rem; /* Larger font size for main heading */
        font-weight: 600;
    }

    .dropdown-card .card-header, .average-deal-card .card-header {
        background-color: rgba(0, 0, 0, 0.2); /* Lighten header background */
    }

    .dropdown-menu {
        background-color: #2c3e50; /* Matching dropdown style */
    }

    .report-dropdown {
        font-size: 1.5rem;
        width: 100%;
    }

    /* Adjust the chart container */
    .chart-container {
        background-color: #1e1e1e;
        padding: 10px;
        border-radius: 15px;
        margin: auto;
    }
    .chart-card .card-body {
        padding: 0;
        position: relative; /* Set the position to relative so that the chart can size itself based on this container */
        width: 100%; /* Set to 100% of the container */
        max-height: 400px; /* Adjust max height as needed */
    }

    .chart-container canvas {
        position: absolute; /* Position absolutely within the card body */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

</style>
