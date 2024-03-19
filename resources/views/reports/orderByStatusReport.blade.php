<x-layout>
    <div class="container">
        <h1>Orders by Status</h1>
        <canvas id="statusChart"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('statusChart').getContext('2d');
            var statusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: @json($statuses),
                    datasets: [{
                        label: 'Order Status',
                        data: @json($counts),
                        backgroundColor: [
                            // Define color for each slice
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            // Add more colors for more statuses
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            // Add more borders for more statuses
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Orders by Status'
                    }
                }
            });
        });
    </script>
</x-layout>
