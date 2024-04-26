<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log; 
use App\Rules\UniqueEmployeeID;  
use App\Rules\UniqueEmployeeName;  


class SystemUsersController extends BaseController
{
    private $selectedEmployee;

    public function saveEmployee(Request $request)
    {
        Log::info('Employee creation method called with data:', $request->all());

        $request->validate([
            'Employee_ID' => ['required', new UniqueEmployeeID],
            'Last_Name' => ['required', new UniqueEmployeeName($request->input('Last_Name'), $request->input('First_Name'))],
            'First_Name' => ['required'],
            'Position' => ['required'],
            'Employee_Email' => ['required', 'email', new UniqueEmployeeID],

            // Add other validation rules as needed
            // 'Department' => ['required'], // Example
        ]);
    
    
        // For debugging, bypassing the validation
        $employeeData = $request->only([
            'Employee_ID',
            'Last_Name',
            'First_Name',
            'Department',
            'Position',
            'Employee_Status',
            'Employee_Email',
        ]);
    
        // Set default values  
        $employeeData['Password'] = Hash::make('Password1');
        $employeeData['Employee_Status'] = 'ACTIVE';

        // Add 3 months to the current date
        $expiryDate = now()->addMonths(3);
        $employeeData['Expiry_Date'] = $expiryDate->format('Y-m-d'); 
        $employeeData['Lock_Count'] = '0';

        // Check if the department selected is "other"
        if ($request->input('Department') === 'other') { 
            $employeeData['Department'] = $request->input('OtherDepartment');
        } else { 
            $employeeData['Department'] = $request->input('Department');
        }

    
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
        $activeEmployees = Employee::with('permissions')
                            ->where('Employee_Status', 'ACTIVE')
                            ->orderBy('First_Name')  
                            ->get();
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
 
    public function editEmployeeInfo($employee)
    {  
        $selectedEmployee = Employee::findOrFail($employee); 

        $departments = Employee::distinct()->pluck('Department')->toArray();
        $departments = array_map('strtoupper', $departments); 
        sort($departments); 
        return view('systemusers.edit-employee', compact('selectedEmployee', 'departments')); 
    }

    public function updateEmployeeInfo(Request $request, $employee)
    { 
        $employeeData = $request->validate([ 
            'Last_Name' => ['required'],
            'First_Name' => ['required'],
            'Department',
            'Position' => ['required'],
            'Employee_Email' => ['required'],
        ]);
        
        if ($request->input('Department') === 'other') { 
            $employeeData['Department'] = $request->input('OtherDepartment');
        } else { 
            $employeeData['Department'] = $request->input('Department');
        }
 
        $empProfile = Employee::findOrFail($employee); 
        try {
            $empProfile->update($employeeData);   
            return redirect()->route('systemusers')->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->withErrors('Failed to update employee: ' . $e->getMessage())->withInput();
        }

    }
    public function updateProfilePic(Request $request, $employee)
    { 
        $request->validate([
            'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg,bmp|max:2048',
        ]);  
        $empProfile = Employee::findOrFail($employee);
        try {
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $imageData = file_get_contents($file->getRealPath()); 
                $empProfile->profile_image = base64_encode($imageData);  
                $empProfile->save();
            } else {
                return redirect()->route('systemusers')->with('error', 'Unable to update profile image. No file was selected.');
            }

            return redirect()->route('systemusers')->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->withErrors('Failed to update employee: ' . $e->getMessage())->withInput();
        } 
    }
  
    public function showProfile($employeeID)
    {
        $selectedEmployee = Employee::findOrFail($employeeID);

        $lockStatus = $selectedEmployee->get_LockCount() >= 3 ? 'LOCKED' : 'UNLOCKED';
        $selectedEmployee->Lock_Status = $lockStatus;
        return view('systemusers.profile', compact('selectedEmployee'));
    }


    public function deleteEmployee(Request $request, $employee)
    { 
        $employeeData['Employee_Status'] = "INACTIVE"; 
        $empProfile = Employee::findOrFail($employee);
        try {
            $empProfile->update($employeeData);   
            return redirect()->route('systemusers')->with('success', 'The employee has been deleted.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->withErrors('Unable to delete employee: ' . $e->getMessage())->withInput();
        }

    }

    public function resetEmployee(Request $request, $employee)
    {  
        try {   
            $employee = Employee::findOrFail($employee);
 
            $employee->Password = Hash::make('Password1'); 
            $employee->Lock_Count = 0;  
            $expiryDate = now()->addDays(-1);
            $employee->Expiry_Date = $expiryDate->format('Y-m-d'); 
 
            $employee->save();
 
            return redirect()->route('systemusers.profile', ['employee' => $employee->Employee_ID])->with('success', 'The employee has been reset.');

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->withErrors('Unable to reset employee: ' . $e->getMessage())->withInput();
        }

    }

}
