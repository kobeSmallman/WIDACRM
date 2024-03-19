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
                // Assume your Laravel database configuration is correct and being used
                return [
                    "dataSources" => [
                        "mysql" => [
                            "class" => '\koolreport\datasources\PDODataSource',
                            "connectionString" => "mysql:host=".env('DB_HOST').";dbname=".env('DB_DATABASE'),
                            "username" => env('DB_USERNAME'),
                            "password" => env('DB_PASSWORD'),
                            "charset" => "utf8"
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
                    ->pipe($this->dataStore('sales_by_employee'));
            }
        };

        $report->run();

        ob_start();
        BarChart::create([
            "dataStore" => $report->dataStore('sales_by_employee'),
            "width" => "100%",
            "height" => "500px",
            "columns" => ["Employee_Name", "Total_Sales"],
            "options" => [
                "title" => "Sales by Employee"
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
