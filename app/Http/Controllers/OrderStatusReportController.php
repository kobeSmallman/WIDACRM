<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderStatusReportController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve date range from request, use a default range if not provided
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        // Fetch orders within the specified date range and group by status
        $orderData = Order::select('Order_Status', DB::raw('count(*) as total'))
                          ->whereBetween('Order_DATE', [$startDate, $endDate])
                          ->groupBy('Order_Status')
                          ->get();

        $statuses = $orderData->pluck('Order_Status');
        $counts = $orderData->pluck('total');

        return view('reports.orderByStatusReport', compact('statuses', 'counts', 'startDate', 'endDate'));
    }
}
