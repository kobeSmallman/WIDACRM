<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \koolreport\KoolReport;
use \koolreport\widgets\google\LineChart;

class OrderVolumeReportController extends Controller
{
    public function index(Request $request)
    {
        // Read the selected time range from the request, defaulting to 'monthly'
        $timeRange = $request->input('timeRange', 'monthly');
        
        // Determine the DATE_FORMAT based on the selected time range
        $dateFormat = $this->getDateFormat($timeRange);

        // Define the report class directly within the controller method
        $report = new class(array("dateFormat" => $dateFormat)) extends KoolReport {
            protected function defaultConnection()
            {
                return "orders";
            }
            
            protected function settings()
            {
                // Using Laravel's database configuration
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

        // Run the report to process the data
        $report->run();

        // Render the line chart and get its HTML
        ob_start(); // Start output buffering
        LineChart::create([
            "dataStore" => $report->dataStore('order_volume_over_time'),
            "width" => "100%",
            "height" => "500px",
            "columns" => ["OrderTime", "TotalOrders"],
            "options" => [
                "title" => "Order Volume Over Time",
                "curveType" => "function",
                "legend" => ["position" => "bottom"],
                "backgroundColor" => "#121212", // Dark background
                "titleTextStyle" => [
                    "color" => "#ffffff", // White title text
                ],
                "hAxis" => [
                    "textStyle" => ["color" => "#ffffff"], // White horizontal axis text
                ],
                "vAxis" => [
                    "textStyle" => ["color" => "#ffffff"], // White vertical axis text
                ],
                "colors" => ["#4169E1"] // Royal blue line color
            ]
        ]);
        $chartHTML = ob_get_clean(); // Get the contents of the buffer

        // Pass the chart HTML and report data to your view
        return view('reports.orderVolumeByDateReport', [
            'chartHTML' => $chartHTML
        ]);
    }

    private function getDateFormat($timeRange)
    {
        return match ($timeRange) {
            'daily' => '%Y-%m-%d',
            'weekly' => '%X-%V',
            'monthly' => '%Y-%m',
            'yearly' => '%Y',
            default => '%Y-%m'
        };
    }
}
