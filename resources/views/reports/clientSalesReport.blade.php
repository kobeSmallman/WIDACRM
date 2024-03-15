{{-- resources/views/reports/clientSalesReport.blade.php --}}

<x-layout>
    <!-- Content Header -->
    <div class="text-center">
        <h1>Sales Report</h1>
        <h4>This report shows the top 10 sales by customer</h4>
    </div>
    <hr/>

    <!-- Bar Chart Container -->
    {!! $chartHTML !!} <!-- Render the bar chart HTML -->

    <!-- Sales Data Table -->
    <div class="mt-5">
        <table class="table table-hover table-bordered">
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
</x-layout>
