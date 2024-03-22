<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function indexReports()
    {
        $totalOrders = Order::count();
        $totalSales = Payment::sum('Amount');

        // Calculate the average deal size if there are any orders, otherwise set to zero
        $averageDealSize = $totalOrders > 0 ? $totalSales / $totalOrders : 0;

        // Create the average deal size HTML content
        $averageDealSizeHtml = "WIDA's Average deal size: $" . number_format($averageDealSize, 2);

        // Fetch data for the logged-in employee
        $employeeId = Auth::user()->Employee_ID; // Adjust this as necessary for your auth system
        $employeeTotalOrders = Order::where('Created_By', $employeeId)->count();
        $employeeTotalSales = Payment::join('Order', 'Payment.Order_ID', '=', 'Order.Order_ID')
                                     ->where('Order.Created_By', $employeeId)
                                     ->sum('Payment.Amount');

        // Calculate personal average deal size for the signed-in employee
        $employeeAverageDealSize = $employeeTotalOrders > 0 ? $employeeTotalSales / $employeeTotalOrders : 0;

        // Update the average deal size HTML content to include personal average deal size
        $averageDealSizeHtml .= "<br> Your Average deal size: $" . number_format($employeeAverageDealSize, 2);

        // Prepare the chart data for the logged-in employee
        $chartData = [
            'totalOrders' => $employeeTotalOrders,
            'totalSales' => $employeeTotalSales,
        ];

        // Pass variables to the view using compact
        return view('reports.indexReports', compact('averageDealSizeHtml', 'chartData'));
    }
}
