<x-layout>
    <!-- Content Header -->
    <style>
        body, .content-wrapper {
            font-family: 'Open Sans', sans-serif;
        }
        .text-center h1, .text-center h4 {
            font-weight: 600;
            color: #000; /* Changed to black for better readability */
        }
        .chart-container {
            background-color: white; /* Changed to black */
            padding: 20px;
            border-radius: 15px;
            margin: 20px auto;
            max-width: 90vw;
            height: auto;
        }
        .table {
            background-color: white; /* Changed to black */
            border-collapse: collapse;
            width: 100%;
            margin-top: 2rem; /* Add some space between chart and table */
        }

        .table th, .table td {
            color: black; /* Set text color to white for visibility */
            padding: 0.75rem 1rem; /* Add padding to table cells */
            border: 1px solid #32383e; /* Add border to cells */
        }

        .table thead th {
            background-color: #3498db; /* Changed to royal blue */
            border-color: #454d55; /* Darker border for headers */
        }

        .table tbody tr {
            transition: background-color 0.2s ease; /* Smooth transition for hover effect */
        }

        .table tbody tr:hover {
            background-color: #3498db; /* Highlight row on hover */
        }

        .btn-primary {
            background-color: #3498db; /* Default blue color */
            border: none;
        }
    </style>
  <div class="text-center">
        <h1>Sales Report</h1>
        <h4>This report shows the top 10 sales by customer</h4>
    </div>
    <hr/>
    <!-- Bar Chart Container -->
    <div class="chart-container">
        {!! $chartHTML !!} <!-- Render the bar chart HTML -->
    </div>

    <!-- Sales Data Table -->
    <div class="mt-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesData as $data)
                    <tr>
                        <td>{{ $data['Company_Name'] }}</td>
                        <td>{{ $data['total_sales'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include any scripts needed for this page -->
</x-layout>
