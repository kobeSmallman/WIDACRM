<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
class OrderStatusReportController extends Controller
{
    public function index()
{
    $orderData = Order::select('Order_Status', DB::raw('count(*) as total'))
                        ->groupBy('Order_Status')
                        ->get();

    $statuses = $orderData->pluck('Order_Status');
    $counts = $orderData->pluck('total');

    return view('reports.orderByStatusReport', compact('statuses', 'counts'));
}
}
