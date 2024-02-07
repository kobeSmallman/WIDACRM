<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    // Get permissions for the currently logged-in employee
    protected function getEmployeePermissions()
    {
        $employeeId = $this->getEmployeeId();
        $permissions = Permission::where('Employee_ID', $employeeId)->get();

        return $permissions;
    }

    protected function getEmployeeId()
    {
        return Session::get('employee_id');
    }
}