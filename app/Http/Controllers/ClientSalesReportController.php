<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \koolreport\KoolReport;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;
use \koolreport\widgets\google\BarChart;

class ClientSalesReportController extends Controller
{
    public function index()
    {
        // Define the report class directly within the controller method
        $report = new class extends KoolReport {
            protected function defaultConnection()
            {
                return "sales";
            }
            
            public function settings()
            {
                // Using Laravel's database configuration
                $config = config('database.connections.mysql');
                return [
                    "dataSources" => [
                        "sales" => [
                            "class" => '\koolreport\datasources\PDODataSource',
                            "connectionString" => "mysql:host={$config['host']};dbname={$config['database']}",
                            "username" => $config['username'],
                            "password" => $config['password'],
                            "charset" => $config['charset']
                        ]
                    ]
                ];
            }
            
            public function setup()
            {
                $this->src('sales')
                    ->query("
                        SELECT c.Company_Name, SUM(p.Amount) as total_sales
                        FROM `Client` c
                        JOIN `Order` o ON c.Client_ID = o.Client_ID
                        JOIN `Payment` p ON o.Order_ID = p.Order_ID
                        GROUP BY c.Company_Name
                    ")
                    ->pipe(new Group([
                        "by" => "Company_Name",
                        "sum" => "total_sales"
                    ]))
                    ->pipe(new Sort([
                        "total_sales" => "desc"
                    ]))
                    ->pipe(new Limit(["number" => 10]))
                    ->pipe($this->dataStore('sales_by_customer'));
            }
        };
        
        // Execute the report to process the data
        $report->run();

        // Render the bar chart and get its HTML
        ob_start(); // Start output buffering
        BarChart::create([
            "dataStore" => $report->dataStore('sales_by_customer'),
            "width" => "100%",
            "height" => "500px",
            "options" => [
                "title" => "Top 10 Sales by Customer",
                "titleTextStyle" => [
                    "color" => "#ffffff",
                ],
                "legend" => [
                    "position" => "bottom",
                    "textStyle" => [
                        "color" => "#ffffff",
                    ],
                ],
                "backgroundColor" => "#121212", // Set the background color to black
                "hAxis" => [
                    "textStyle" => ["color" => "#ffffff"],
                ],
                "vAxis" => [
                    "textStyle" => ["color" => "#ffffff"],
                ],
                "colors" => ["#4169E1"], // Set royal blue color for the chart bars
                // Set royal blue color for the chart bars
            ],
            // ... other chart options as needed ...
        ]);
        
        
        $chartHTML = ob_get_clean(); // Get the contents of the buffer

        // Pass the chart HTML and report data to your view
        return view('reports.clientSalesReport', [
            'chartHTML' => $chartHTML,
            'salesData' => $report->dataStore('sales_by_customer')->toArray()
        ]);
    }
}
