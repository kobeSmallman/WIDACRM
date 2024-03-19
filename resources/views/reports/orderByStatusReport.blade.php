<x-layout>
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders by Status</h1>
                </div>
                <div class="col-sm-6">
                    <form method="GET" action="{{ route('ordersByStatus.index') }}">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="date" class="form-control mb-2" name="start_date" value="{{ $startDate ?? now()->startOfMonth()->toDateString() }}">
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control mb-2" name="end_date" value="{{ $endDate ?? now()->endOfMonth()->toDateString() }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <!-- Container for the chart and the date range -->
                    <div id="chart-container" style="position: relative;">
                        <div id="chart-date-range" style="text-align: center; margin-bottom: 10px;">
                            Date Range: <span id="startDate">{{ $startDate }}</span> - <span id="endDate">{{ $endDate }}</span>
                        </div>
                        <canvas id="statusChart"></canvas>
                    </div>
                    <!-- Buttons for printing and downloading the chart -->
                    <button id="printChart" class="btn btn-primary mt-3">Print</button>
                    <button id="downloadChart" class="btn btn-primary mt-3">Download PDF</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Add styles for printing -->
    <style>
        @media print {
            #printChart, #downloadChart, .content-header, .content-header * {
                display: none;
            }
            #chart-date-range {
                display: block !important;
            }
            #chart-container {
                width: 100% !important;
                height: auto !important;
            }
        }
    </style>


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
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            // More colors as needed
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            // More borders as needed
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

            document.getElementById('printChart').addEventListener('click', function() {
            window.print();
        });

        document.getElementById('downloadChart').addEventListener('click', function() {
        html2canvas(document.querySelector("#chart-container")).then(canvas => {
            // Create a blob from the canvas
            canvas.toBlob(function(blob) {
                // Use the blob to create an object URL for the PDF
                const pdf = new jspdf.jsPDF({
                    orientation: 'landscape',
                    unit: 'px',
                    format: [canvas.width, canvas.height]
                });
                // Add the canvas to the PDF
                const imgData = canvas.toDataURL('image/png');
                pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
                // Save the PDF with a filename
                pdf.save('Orders_by_Status.pdf');
            });
        });
    });
});
</script>
</x-layout>
