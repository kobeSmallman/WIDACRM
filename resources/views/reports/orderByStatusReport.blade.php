<x-layout>
    <!-- Content Header -->
    <section class="content-header">
    <div class="text-left mt-4">
    <a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>
</div>

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
                    '#4169E1', // Royal blue
                    '#3498db', // Different shades of blue
                    // Add more colors as needed
                ],
                borderColor: [
                    'black', // White borders
                    'black',
                    // More borders as needed
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Orders by Status',
                fontColor: 'black' // White title
            },
            legend: {
                labels: {
                    fontColor: 'black' // White legend labels
                }
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
body, .content-wrapper {
            font-family: 'Open Sans', sans-serif;
            color: black;
           
        }

        .card {
            background-color: white; /* Dark card background */
            border: none;
        }


        .btn-primary {
            background-color: #4169E1; /* Royal blue */
            border: none;
        }

        #chart-container {
            background-color:white; /* Slightly lighter dark shade for chart background */
            padding: 20px;
            border-radius: 15px;
        }

        /* Style for the chart date range text */
        #chart-date-range {
            color: #ffffff;
            margin-bottom: 15px;
        }
    </style>
</x-layout>
