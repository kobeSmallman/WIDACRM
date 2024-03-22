<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Permission;
use App\Models\Employee;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    
    public function index()
    {
        $activeEmployees = Employee::where('Employee_Status', 'Active')
                            ->orderBy('First_Name')  
                            ->get();
        return view('permissions.index', compact('activeEmployees'));
    }

    public function editPermission($employeeID)
    { 
        $selectedEmployee = Employee::findOrFail($employeeID); 
        // $employeePermissions = $selectedEmployee->permissions()->get();  
        $employeePermissions = $selectedEmployee->permissions()
            ->join('Page', 'Permissions.Page_ID', '=', 'Page.Page_ID')
            ->orderBy('Page.Page_Name')
            ->get();
 
        $pages = Page::get(); 
        return view('permissions.employee-permission', compact('selectedEmployee', 'employeePermissions', 'pages')); 
    }


    public function deletePermission($id)
    { 
        $permission = Permission::findOrFail($id); 
        $employee = $permission->Employee_ID;
        $permission->delete();
 
        // return redirect()->with('success', 'Permission deleted successfully.'); 
        return redirect()->route('permissions.edit', compact('employee'))->with('success', 'Permission deleted successfully.');
    }


    public function savePermission(Request $request)
    { 
        $validatedData = $request->validate([
            'Employee_ID' => 'required|integer',
            'Page_ID' => 'required|integer|unique_permission',
            'Full_Control' => 'required|integer',  
        ], [
            'Page_ID.unique' => 'Duplicate record',
        ]);

        try {
            $employee = $validatedData['Employee_ID'];
            Permission::create($validatedData);

            // return redirect()->route('permissions.edit', compact('employee'))
            //     ->with('success', 'Permission added successfully.');
            
            return response()->json(['success' => 'Permission added successfully.']);

        } catch (\Exception $e) {
            \Log::error($e->getMessage()); 
            return response()->json(['errors' => ['Failed to add permission: ' . $e->getMessage()]]);
        }
    }


    public function updatePermission(Request $request)
    {  
 
        $validatedData = $request->validate([
            'Permission_ID2' => 'required|integer',
            'Employee_ID2' => 'required|integer',
            'Page_ID2' => 'required|integer',
            'Full_Control2' => 'required|integer',  
        ]);

        try {

            $permissionId = $validatedData['Permission_ID2'];
            unset($validatedData['Permission_ID2']);
             
            $validatedData['Employee_ID'] = $validatedData['Employee_ID2'];
            $validatedData['Page_ID'] = $validatedData['Page_ID2'];
            $validatedData['Full_Control'] = $validatedData['Full_Control2'];

            unset($validatedData['Employee_ID2']);
            unset($validatedData['Page_ID2']);
            unset($validatedData['Full_Control2']);
 
            $permission = Permission::findOrFail($permissionId);  
            $permission->update($validatedData);
 
            return redirect()->route('permissions.edit', ['employee' => $permission->Employee_ID])
                ->with('success', 'Permission updated successfully.');
        } catch (\Exception $e) {
            // Log any errors and return with an error message
            \Log::error($e->getMessage());
            return back()->withErrors('Failed to update permission: ' . $e->getMessage())->withInput();
        }
    }
    
}

