<?php

    namespace App\Http\Controllers;
    
    use App\Models\Employee;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage; 
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\Facades\Session;


    class AuthController extends Controller
    {
         
    
        public function storeEmployee(Request $request)
        {
            Log::info('Employee creation method called with data:', $request->all());
           
            // For debugging, bypassing the validation
            $employeeData = $request->only([
                'Employee_ID',
                'Last_Name',
                'First_Name',
                'Department',
                'Position',
                'Employee_Status',
                'Role_ID',
                'Password',
                // Any other fields you expect from the request
            ]);
        
            // Manually hash the password
            $employeeData['Password'] = Hash::make($employeeData['Password']);
        
            try {
                \DB::beginTransaction();
        
                // Directly create the employee without validation
                $employee = Employee::create($employeeData);
        
                \DB::commit();
        
                Log::info('Employee created successfully.', ['employee_id' => $employee->Employee_ID]);
        
                // Redirect to the system users page with a success message
                return redirect()->route('system-users')->with('success', 'Employee created successfully.');
            } catch (\Throwable $e) {
                \DB::rollBack();
                Log::error('Failed to create employee: ' . $e->getMessage());
        
                // Log the query that caused the exception
                Log::error('Failed query:', \DB::getQueryLog());
        
                // Redirect back with an error message
                return back()->withErrors('Failed to create employee: ' . $e->getMessage())->withInput();
            }
        }
        
        
        
        
        public function logout(Request $request)
{
    Auth::logout();
    return redirect('/login');
}



        public function showSystemUsers()
        {
            $activeEmployees = Employee::where('Employee_Status', 'active')->orWhere('Employee_Status', 'Active')->get();
            $inactiveEmployees = Employee::where('Employee_Status', 'inactive')->orWhere('Employee_Status', 'Inactive')->get();
        
            return view('systemUsers.systemUsers', compact('activeEmployees', 'inactiveEmployees'));
        }
        
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'Employee_ID' => 'required|integer',
            'password' => 'required|string', // Ensure this matches the 'name' attribute in your form
        ]);
    
        // Attempt to log the user in
        $credentials = $request->only('Employee_ID', 'password');
        if (Auth::attempt($credentials)) {
            // If successful, redirect to their respective dashboard
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('employee.dashboard');
            }
        }
    
        // If unsuccessful, redirect back to the login with the form data
        return back()->withErrors([
            'Employee_ID' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('Employee_ID'));
    }
    public function updateProfile(Request $request)
    {
        // Validate the form data
        $request->validate([
            'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $employee = Auth::user(); // Get the authenticated employee
    
        // Handle profile image update
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $imageData = file_get_contents($file->getRealPath()); // Get the binary data of the file
            $employee->profile_image = base64_encode($imageData); // Store the base64 encoded binary data
            $employee->save();
        }
    
        return back()->with('success', 'Profile updated successfully.');
    }
    

    

    
public function showProfile()
{
    // Assuming you are using the default Laravel authentication system
    $employee = Auth::user(); // Get the currently authenticated employee

    // Pass the employee object to the profile view
    return view('profiles.employeeProfile', compact('employee'));
}
}
