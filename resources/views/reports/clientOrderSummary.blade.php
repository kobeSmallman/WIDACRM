{{-- resources/views/reports/clientOrderSummary.blade.php --}}
<x-layout>
    <div class="text-center">
        <h1>Sales Report</h1>
        <h4>This report shows top 10 sales by customer</h4>
    </div>
    <hr/>

    @if(isset($report))
        <div id="orderSummaryBarChart"></div>
        <div id="orderSummaryTable"></div>
    @else
        <p>Report data is not available.</p>
    @endif
</x-layout>

@push('scripts')
<script type="text/javascript">
    // Similar to the above, handle your report data and KoolReport widget initialization here using JavaScript if possible.
</script>
@endpush
