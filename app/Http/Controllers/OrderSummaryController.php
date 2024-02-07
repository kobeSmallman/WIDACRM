<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\Employee;

class OrderSummaryController extends Controller
{
    public function index()
    {
        $employee = Auth::user(); // Get the authenticated employee
        $permissions = Permission::where('Employee_ID', $employee->Employee_ID)->get();
        
        // Now, pass the employee details as well to the view
        return view('OrderSummary.index', [
            'permissions' => $permissions,
            'employee' => $employee // Pass this to the view
        ]);
    }
}

