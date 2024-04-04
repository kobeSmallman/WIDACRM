<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \koolreport\KoolReport;
use \koolreport\widgets\google\BarChart;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;

class SalesByEmployeeReportController extends Controller
{
    public function index(Request $request)
    {
        $report = new class extends KoolReport {
            protected function settings()
            {
                // Assuming your Laravel database configuration is correct and being used
                $config = config('database.connections.mysql');
                return [
                    "dataSources" => [
                        "mysql" => [
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
                $this->src('mysql')
                    ->query("
                        SELECT CONCAT(e.First_Name, ' ', e.Last_Name) AS Employee_Name, SUM(p.Amount) AS Total_Sales
                        FROM `Employee` e
                        JOIN `Order` o ON e.Employee_ID = o.Created_By
                        JOIN `Payment` p ON o.Order_ID = p.Order_ID
                        GROUP BY Employee_Name
                        ORDER BY Total_Sales DESC
                    ")
                    ->pipe(new Limit(["number" => 10])) // Limit to top 10, if needed
                    ->pipe($this->dataStore('sales_by_employee'));
            }
        };

        $report->run();

        ob_start();
        BarChart::create([
            "dataStore" => $report->dataStore('sales_by_employee'),
            "width" => "100%",
            "height" => "500px",
            "options" => [
                "title" => "Top 10 Sales by Employee",
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
            ]
        ]);
        $chartHTML = ob_get_clean();

        $employeeSales = $report->dataStore('sales_by_employee')->toArray();

        return view('reports.salesByEmployeeReport', [
            'chartHTML' => $chartHTML,
            'employeeSales' => $employeeSales
        ]);
    }
}
