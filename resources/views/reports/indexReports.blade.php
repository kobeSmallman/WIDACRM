<x-layout>
    <div class="container">
        <h1 class="text-center my-4">WIDA Procurement Report Analytics</h1>

        <div class="d-flex justify-content-around">
            <!-- Client Reports Button -->
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="clientReportsDropdown" data-toggle="dropdown" aria-expanded="false">
                    Client Reports
                </button>
                <div class="dropdown-menu" aria-labelledby="clientReportsDropdown">
                    <a class="dropdown-item" href="{{ route('clientSalesSummary.index') }}">Client Sales Report</a>
                </div>
            </div>

            <!-- Personal Reports Button -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="personalReportsDropdown" data-toggle="dropdown" aria-expanded="false">
                    Personal Reports
                </button>
                <div class="dropdown-menu" aria-labelledby="personalReportsDropdown">
                    <a class="dropdown-item" href="{{ route('salesByEmployeePersonal.index') }}">Sales by Employee (Personal)</a>
                </div>
            </div>

            <!-- WIDA Reports Button -->
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="widaReportsDropdown" data-toggle="dropdown" aria-expanded="false">
                    WIDA Reports
                </button>
                <div class="dropdown-menu" aria-labelledby="widaReportsDropdown">
                    <a class="dropdown-item" href="{{ route('salesByEmployeeReport.index') }}">Sales by Employee</a>
                    <a class="dropdown-item" href="{{ route('orderVolumeReport.index') }}">Order Volume by Date</a>
                    <a class="dropdown-item" href="{{ route('ordersByStatus.index') }}">Orders by Status</a>
                </div>
            </div>
        </div>

        <!-- Display average deal size -->
        <div class="text-center mb-4">
        <h1 style="font-size: 48px; font-weight: bolder">{!! $averageDealSizeHtml !!}</h1>
        </div>
        <div class="text-center">
        <svg
  xmlns="http://www.w3.org/2000/svg"
  width="600"
  height="600"
  viewBox="0 0 24 24"
  fill="none"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <circle cx="12" cy="12" r="10" />
  <path d="M8 14s1.5 2 4 2 4-2 4-2" />
  <line x1="9" y1="9" x2="9.01" y2="9" />
  <line x1="15" y1="9" x2="15.01" y2="9" />
</svg>

        </div>
    </div>
</x-layout>
