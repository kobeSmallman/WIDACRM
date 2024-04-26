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
        $selectedEmployeeId = $request->input('employee_id');

        $employees = Employee::all();

        $employeeActivities = $employees->map(function ($employee) use ($startDate, $endDate, $selectedEmployeeId) {
            if ($selectedEmployeeId && $employee->Employee_ID != $selectedEmployeeId) {
                return null;
            }

            $notesActivities = Note::where('Created_By', $employee->Employee_ID)
                                    ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
                                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                                    ->groupBy(DB::raw('DATE(created_at)'))
                                    ->get()
                                    ->mapWithKeys(function ($item) {
                                        return [$item->date => ['notes' => $item->count]];
                                    });

            $ordersActivities = Order::where('Created_By', $employee->Employee_ID)
                                     ->whereBetween(DB::raw('DATE(Order_DATE)'), [$startDate, $endDate])
                                     ->select(DB::raw('DATE(Order_DATE) as date'), DB::raw('count(*) as count'))
                                     ->groupBy(DB::raw('DATE(Order_DATE)'))
                                     ->get()
                                     ->mapWithKeys(function ($item) {
                                        return [$item->date => ['orders' => $item->count]];
                                     });

            $activitiesByDate = $notesActivities->mergeRecursive($ordersActivities);

            return [
                'Employee Name' => $employee->First_Name . ' ' . $employee->Last_Name,
                'Activities' => $activitiesByDate
            ];
        })->filter();

        return view('Activity.employeeActivity', ['employeeActivities' => $employeeActivities, 'employees' => $employees]);
    }
}
