<?php
namespace App\Http\Controllers;
 

use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class OrderSummaryController extends BaseController
{
    public function index()
    {  
        $employeeId = $this->getEmployeeId();
        $permissions = Permission::where('Employee_ID', $employeeId)->get();
        return view('OrderSummary.index',['permissions' => $permissions]);
    }

}
