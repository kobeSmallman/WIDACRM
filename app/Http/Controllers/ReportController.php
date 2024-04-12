<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Method to calculate WIDA's average deal size
    private function calculateWidasAverageDealSize() {
        $totalOrders = Order::count();
        $totalSales = Payment::sum('Amount');
        return $totalOrders > 0 ? $totalSales / $totalOrders : 0;
    }

    // Method to calculate personal average deal size for the logged-in employee
    private function calculateYourAverageDealSize($employeeId) {
        $employeeTotalOrders = Order::where('Created_By', $employeeId)->count();
        $employeeTotalSales = Payment::join('Order', 'Payment.Order_ID', '=', 'Order.Order_ID')
                                     ->where('Order.Created_By', $employeeId)
                                     ->sum('Payment.Amount');
        return $employeeTotalOrders > 0 ? $employeeTotalSales / $employeeTotalOrders : 0;
    }

    public function indexReports()
    {
        // Calculate WIDA's and personal average deal size
        $widaAverageDealSize = $this->calculateWidasAverageDealSize();
        $employeeId = Auth::user()->Employee_ID; // Adjust this as necessary for your auth system
        $yourAverageDealSize = $this->calculateYourAverageDealSize($employeeId);

        // Prepare the chart data for the logged-in employee
        $employeeTotalOrders = Order::where('Created_By', $employeeId)->count();
        $employeeTotalSales = Payment::join('Order', 'Payment.Order_ID', '=', 'Order.Order_ID')
                                     ->where('Order.Created_By', $employeeId)
                                     ->sum('Payment.Amount');

        $chartData = [
            'totalOrders' => $employeeTotalOrders,
            'totalSales' => $employeeTotalSales,
            'widaAverageDealSize' => $widaAverageDealSize,
            'yourAverageDealSize' => $yourAverageDealSize,
        ];

        // Pass variables to the view using compact
        return view('reports.indexReports', compact('chartData'));
    }
}
