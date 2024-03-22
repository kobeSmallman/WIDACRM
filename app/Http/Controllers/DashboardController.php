<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use App\Models\Payment;
use \koolreport\KoolReport;
use \koolreport\widgets\google\AreaChart;

class DashboardController extends Controller
{
    public function adminDashboard(Request $request)
    {
        // Calculate totals
        $totalOrders = Order::count();
        $totalSales = Payment::sum('Amount');
        $totalClients = Client::count();

        // Read the selected time range from the request, defaulting to 'daily'
        $timeRange = $request->input('timeRange', 'daily');

        // Determine the DATE_FORMAT based on the selected time range
        $dateFormat = $this->getDateFormat($timeRange);

        $report = new class(array("dateFormat" => $dateFormat)) extends KoolReport {
            protected function defaultConnection()
            {
                return "orders";
            }

            protected function settings()
            {
                $config = config('database.connections.mysql');
                return [
                    "dataSources" => [
                        "orders" => [
                            "class" => '\koolreport\datasources\PDODataSource',
                            "connectionString" => "mysql:host={$config['host']};dbname={$config['database']}",
                            "username" => $config['username'],
                            "password" => $config['password'],
                            "charset" => $config['charset']
                        ]
                    ]
                ];
            }

            protected function setup()
            {
                $dateFormat = $this->params["dateFormat"];
                $this->src('orders')
                    ->query("
                        SELECT DATE_FORMAT(Order_DATE, '{$dateFormat}') as OrderTime, COUNT(*) as TotalOrders
                        FROM `Order`
                        GROUP BY OrderTime
                    ")
                    ->pipe($this->dataStore('order_volume_over_time'));
            }
        };

        $report->run();

        ob_start();
        AreaChart::create([
            "dataStore" => $report->dataStore('order_volume_over_time'),
            "width" => "100%",
            "height" => "400px", // You might adjust the height as needed to not cover the footer
            "columns" => ["OrderTime", "TotalOrders"],
            "options" => [
                "title" => "Order Volume Over Time",
                "curveType" => "function",
                "legend" => ["position" => "bottom"],
                "areaOpacity" => 0.2, // This will fill the area beneath the line
                "hAxis" => [
                    "title" => "Time",
                ],
                "vAxis" => [
                    "title" => "Total Orders",
                ],
            ]
        ]);
        
        $chartHTML = ob_get_clean();

        return view('dashboard.admin', [
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'totalClients' => $totalClients,
            'chartHTML' => $chartHTML
        ]);
    }

    private function getDateFormat($timeRange)
    {
        return match ($timeRange) {
            'daily' => '%Y-%m-%d',
            'monthly' => '%Y-%m',
            // Add other cases as needed
            default => '%Y-%m-%d'
        };
    }

    public function employeeDashboard()
    {
        // Logic for employee dashboard view
        return view('dashboard.employee');
    }
    
    // Add any other methods you need for your controller here
}
