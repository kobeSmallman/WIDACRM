<x-layout>
<div class="text-left mt-4">
    <a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>
</div>

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sales by Employee</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <!-- Chart will be rendered here -->
                    {!! $chartHTML !!}

                    <!-- Sales Data Table -->
                    <div class="mt-5">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Total Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employeeSales as $sale)
                                    <tr>
                                        <td>{{ $sale['Employee_Name'] }}</td>
                                        <td>{{ number_format($sale['Total_Sales'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
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
        border: 1px solid; /* Add border to cells */
    }

    .table thead th {
        background-color: #3498db; /* Changed to royal blue */
        border-color: #454d55; /* Darker border for headers */
    }

    .table tbody tr:hover {
        background-color: #3498db; /* Highlight row on hover */
    }

    .btn-primary {
        background-color: #3498db; /* Default blue color */
        border: none;
    }
</style>
