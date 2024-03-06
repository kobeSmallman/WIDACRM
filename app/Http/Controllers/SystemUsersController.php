<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log; 


class SystemUsersController extends BaseController
{
    private $selectedEmployee;

    public function saveEmployee(Request $request)
    {
        Log::info('Employee creation method called with data:', $request->all());
    
        // For debugging, bypassing the validation
        $employeeData = $request->only([
            'Employee_ID',
            'Last_Name',
            'First_Name',
            'Department',
            'Position',
            // Skipping 'Role_ID' from the request
            'Employee_Status',
            // Skipping 'Password' from the request
            // Any other fields you expect from the request
        ]);
    
        // Set default values for 'Password' and 'Employee_Status'
        $employeeData['Password'] = Hash::make('Password1');
        $employeeData['Employee_Status'] = 'ACTIVE';
    
        try {
            \DB::beginTransaction();
    
            // Directly create the employee without validation
            $employee = Employee::create($employeeData);
    
            \DB::commit();
    
            Log::info('Employee created successfully.', ['employee_id' => $employee->Employee_ID]);
    
            // Redirect to the system users page with a success message
            return redirect()->route('systemusers')->with('success', 'Employee created successfully.');
        } catch (\Throwable $e) {
            \DB::rollBack();
            Log::error('Failed to create employee: ' . $e->getMessage());
    
            // Log the query that caused the exception
            Log::error('Failed query:', \DB::getQueryLog());
    
            // Redirect back with an error message
            return back()->withErrors('Failed to create employee: ' . $e->getMessage())->withInput();
        }
    }
    
    public function showSystemUsers()
    {
        $activeEmployees = Employee::with('permissions')->where('Employee_Status', 'Active')->get();
        $inactiveEmployees = Employee::where('Employee_Status', 'Inactive')->get();

        // The variable must match what you use in the view
        return view('systemUsers.index', compact('activeEmployees', 'inactiveEmployees'));
    }


    public function registration()
    { 
        $departments = Employee::distinct()->pluck('Department')->toArray();
        $departments = array_map('strtoupper', $departments); 
        sort($departments);
        return view('systemusers.add-employee', compact('departments')); 
    }



        
    public function updateEmployee(Request $request, $employee)
    {
        // Validate the form data
        $request->validate([
            'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $empProfile = Employee::findOrFail($employee);

        // Handle profile image update
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $imageData = file_get_contents($file->getRealPath()); // Get the binary data of the file
            $empProfile->profile_image = base64_encode($imageData); // Store the base64 encoded binary data
            $empProfile->save();
        }

        return back()->with('success', 'Profile updated successfully.');
    }





    public function showProfile($employeeID)
    {
        $selectedEmployee = Employee::findOrFail($employeeID);

        return view('systemusers.profile', compact('selectedEmployee'));
    }


}
