<?php
// app\Http\Controllers\SalesByEmployeePersonalController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class SalesByEmployeePersonalController extends Controller
{
    public function index()
    {
        $employeeId = Auth::user()->Employee_ID; // Or however you get the current employee's ID
    
        // Fetch data for total orders and total sales
        $totalOrders = Order::where('Created_By', $employeeId)->count();
        $totalSales = Payment::join('Order', 'Payment.Order_ID', '=', 'Order.Order_ID')
                            ->where('Order.Created_By', $employeeId)
                            ->sum('Payment.Amount');
    
        // Prepare the data for the chart
        $chartData = [
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
        ];
    
        return view('reports.salesByEmployeePersonal', [
            'chartData' => $chartData
        ]);
    }
    
}
