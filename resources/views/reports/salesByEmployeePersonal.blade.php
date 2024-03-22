{{-- resources/views/reports/salesByEmployeePersonal.blade.php --}}

<x-layout>
    <div class="container">
        <h1>Personal Sales Report</h1>
        <p>This is the personal sales report for the employee.</p>
        
        <div>
            <input type="radio" id="totalOrders" name="chartToggle" checked>
            <label for="totalOrders">Total Orders</label>
            <input type="radio" id="totalSales" name="chartToggle">
            <label for="totalSales">Total Sales</label>
        </div>
        <canvas id="salesChart"></canvas>
    </div>

    <script>
        // Assuming you have included Chart.js via a script tag or npm
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const chartData = @json($chartData);

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

            // Toggle chart data display
            document.querySelectorAll('input[name="chartToggle"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    chart.getDatasetMeta(0).hidden = this.id !== 'totalOrders';
                    chart.getDatasetMeta(1).hidden = this.id !== 'totalSales';
                    chart.update();
                });
            });
        });
    </script>
</x-layout>
