<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Note;
use App\Models\Order;
use DB;
use Carbon\Carbon;

class EmployeeActivityController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $employees = Employee::all();

        $employeeActivities = $employees->map(function ($employee) use ($startDate, $endDate) {
            // Querying notes created by this employee within the selected date range
            $notesActivities = Note::where('Created_By', $employee->Employee_ID)
                ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->groupBy(DB::raw('DATE(created_at)'))
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->date => ['notes' => $item->count]];
                });

            // Querying orders created by this employee within the selected date range
            $ordersActivities = Order::where('Created_By', $employee->Employee_ID)
                ->whereBetween(DB::raw('DATE(Order_DATE)'), [$startDate, $endDate])
                ->select(DB::raw('DATE(Order_DATE) as date'), DB::raw('count(*) as count'))
                ->groupBy(DB::raw('DATE(Order_DATE)'))
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->date => ['orders' => $item->count]];
                });

            // Combine counts from different types of activities by date
            $activitiesByDate = $notesActivities->mergeRecursive($ordersActivities);

            return [
                'Employee Name' => $employee->First_Name . ' ' . $employee->Last_Name,
                'Activities' => $activitiesByDate
            ];
        });

        return view('Activity.employeeActivity', ['employeeActivities' => $employeeActivities]);
    }
}
