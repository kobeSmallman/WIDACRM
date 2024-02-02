<?php

    namespace App\Http\Controllers;
    
    use App\Models\Employee;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage; 
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\File;

    class AuthController extends Controller
    {
        public function showRegistrationForm()
        {
            Log::info('Showing registration form.');
            return view('auth.register');
        }
    
        public function register(Request $request)
        {
            Log::info('Register method called with data:', $request->all());
    
            // Skipping validation for debugging purposes
            // $validatedData = $request->validate([
            //     'Employee_ID' => 'required|integer|max:11',
            //     'Last_Name' => 'required|string|max:50',
            //     'First_Name' => 'required|string|max:50',
            //     'Department' => 'required|string|max:50',
            //     'Position' => 'required|string|max:50',
            //     'Employee_Status' => 'nullable|string|max:20',
            //     'Role_ID' => 'nullable|integer',
            //     'Password' => 'required|string|min:6|max:255',
            // ]);
    
            // For debugging purposes, we're going to bypass validation
            $validatedData = $request->all();
    
            if (empty($validatedData['Role_ID'])) {
                $validatedData['Role_ID'] = 2; // Default to '2' if not provided
            }
    

            try {
                $employee = Employee::create([
                    'Employee_ID' => $validatedData['Employee_ID'],
                    'First_Name' => $validatedData['First_Name'],
                    'Last_Name' => $validatedData['Last_Name'],
                    'Department' => $validatedData['Department'],
                    'Position' => $validatedData['Position'],
                    'Employee_Status' => $validatedData['Employee_Status'],
                    'Role_ID' => $validatedData['Role_ID'],
                    'Password' => Hash::make($validatedData['Password']),
                ]);
        
                // Log the user in
                Auth::login($employee);
        
                // Redirect based on role
                if ($employee->isAdmin()) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('employee.dashboard');
                }
        
            } catch (\Throwable $e) {
                return back()->withErrors('Failed to create employee: ' . $e->getMessage());
            }
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
        // Define validation rules
        $request->validate([
            'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Add validation for other fields if necessary
        ]);

        $employee = Auth::user(); // Get the authenticated employee

        // Handle profile image update
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = 'profile_' . $employee->Employee_ID . '.' . $file->getClientOriginalExtension();

            // Store the file in the public 'storage/profiles' directory
            $file->storeAs('profiles', $filename, 'public');

            // Check if the file exists in the public 'storage/profiles' directory
            if (!Storage::disk('public')->exists('profiles/' . $filename)) {
                Log::error('Uploaded file does not exist.');
                return back()->withErrors('Uploaded file does not exist.');
            }
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
