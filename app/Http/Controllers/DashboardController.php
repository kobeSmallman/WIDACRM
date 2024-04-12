<?php
namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\Permission;
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
            "height" => "100%", // Adjust the percentage as needed
            "columns" => ["OrderTime", "TotalOrders"],
            "options" => [
                "title" => "Order Volume Over Time",
                "titleTextStyle" => [
                    "color" => "#000000", // Black text color for the title
                ],
                "curveType" => "function",
                "legend" => [
                    "position" => "bottom",
                    "textStyle" => [
                        "color" => "#000000", // Black text color for the legend
                    ],
                ],
                "backgroundColor" => "none", // Transparent background for the chart
                "colors" => ["#4169E1", "#000000"], // Royal blue and black colors for the chart
                "hAxis" => [
                    "title" => "Time",
                    "textStyle" => ["color" => "#000000"], // Black text color for hAxis
                ],
                "vAxis" => [
                    "title" => "Total Orders",
                    "textStyle" => ["color" => "#000000"], // Black text color for vAxis
                ],
                "chartArea" => [
                    "backgroundColor" => "#ffffff", // White background for the chart area
                ],
                "responsive" => true, // Enable responsiveness
                "maintainAspectRatio" => false, // Disable aspect ratio maintenance
            ],
        ]);
        
        
        
        $chartHTML = ob_get_clean();
        $employee = auth()->user(); // Assuming you are using Laravel's authentication
        $reportsPageId = Page::where('Page_Name', 'Reports')->value('Page_ID'); // Assuming 'Reports' is the name of the page
        
        $canViewReports = $employee->permissions->contains('Page_ID', $reportsPageId);

        \Log::info('Can View Reports: ' . ($canViewReports ? 'Yes' : 'No'));
        
// Inside adminDashboard method in DashboardController
\Log::info('Page ID for "Payments": ' . $reportsPageId);
\Log::info('User Permissions: ' . json_encode($employee->permissions));
\Log::info('Can View Reports: ' . ($canViewReports ? 'Yes' : 'No'));

        return view('dashboard.admin', [
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'totalClients' => $totalClients,
            'chartHTML' => $chartHTML,
            'canViewReports' => $canViewReports,
        ]);
    }

    private function getDateFormat($timeRange)
    {
        return match ($timeRange) {
            'weekly' => '%X-%V',
            'monthly' => '%Y-%m',
            // Add other cases as needed
            default => '%X-%V'
        };
    }

    public function employeeDashboard()
    {
        // Logic for employee dashboard view
        return view('dashboard.employee');
    }
    
    // Add any other methods you need for your controller here
}
