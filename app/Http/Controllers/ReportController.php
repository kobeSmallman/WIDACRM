<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use \koolreport\widgets\google\PieChart;

class ReportController extends Controller
{
    public function indexReports()
    {
        $totalOrders = Order::count();
        $totalSales = Payment::sum('Amount');
        
        // Calculate the average deal size if there are any orders, otherwise set to zero
        $averageDealSize = $totalOrders > 0 ? $totalSales / $totalOrders : 0;
        
        // Now, create the average deal size HTML content
        $averageDealSizeHtml = "Average deal size: $" . number_format($averageDealSize, 2);
        
      
        
        // Pass variables to the view using compact
        return view('reports.indexReports', compact('averageDealSizeHtml'));
    }
}



