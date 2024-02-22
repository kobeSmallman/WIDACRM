{{-- adminDashboardShowcaseTwo.blade.php --}}
<canvas id="communicationFrequencyGraph"></canvas>

@push('scripts')
<script>
var ctx = document.getElementById('communicationFrequencyGraph').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Client A', 'Client B', 'Client C'], // Example labels
        datasets: [{
            label: '# of Communications',
            data: [12, 19, 3], // Example data
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            // Add other styling and options as needed
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
</script>
@endpush
