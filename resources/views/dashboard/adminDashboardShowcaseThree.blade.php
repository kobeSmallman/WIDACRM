{{-- adminDashboardShowcaseThree.blade.php --}}
<canvas id="interactionTimelineGraph"></canvas>

@push('scripts')
<script src="{{ asset('path/to/chartjs/chart.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('interactionTimelineGraph').getContext('2d');
    var interactionTimelineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April'], // Replace with your actual labels
            datasets: [{
                label: 'Interactions',
                data: [65, 59, 80, 81], // Replace with your actual data
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
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
@endpush
