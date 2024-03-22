<x-layout>
    <div class="container">
        <h1 class="text-center my-4">WIDA Procurement Report Analytics</h1>

        <div class="d-flex justify-content-between" style="margin: 0 -1%;">
            <!-- Client Reports Button -->
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="clientReportsDropdown" data-toggle="dropdown" aria-expanded="false">
                    Client Reports
                </button>
                <div class="dropdown-menu" aria-labelledby="clientReportsDropdown">
                    <a class="dropdown-item" href="{{ route('clientSalesSummary.index') }}">Client Sales Report</a>
                </div>
            </div>
    
            <!-- WIDA Reports Button -->
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="widaReportsDropdown" data-toggle="dropdown" aria-expanded="false">
                    WIDA Reports
                </button>
                <div class="dropdown-menu" aria-labelledby="widaReportsDropdown">
                    <a class="dropdown-item" href="{{ route('salesByEmployeeReport.index') }}">Sales by Employee</a>
                    <a class="dropdown-item" href="{{ route('orderVolumeReport.index') }}">Order Volume by Date</a>
                    <a class="dropdown-item" href="{{ route('ordersByStatus.index') }}">Orders by Status</a>
                </div>
            </div>
        </div>

        <!-- Display average deal size -->
        <div class="text-center mb-4">
            <h1 style="font-size: 48px; font-weight: bolder">{!! $averageDealSizeHtml !!}</h1>
        </div>
        <div class="text-center mb-4">
            {!! $averageDealSizeHtml !!}
        </div>
        <!-- Personal Sales Report Chart -->
        <div class="text-center">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const chartData = @json($chartData); // Ensure you pass the $chartData from the controller to this view

            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Total Orders', 'Total Sales'],
                    datasets: [{
                        label: 'Total Orders',
                        data: [chartData.totalOrders, 0],
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }, {
                        label: 'Total Sales',
                        data: [0, chartData.totalSales],
                        borderColor: 'rgb(255, 99, 132)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-layout>
