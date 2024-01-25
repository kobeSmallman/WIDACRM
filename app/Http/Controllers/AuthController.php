<?php

    namespace App\Http\Controllers;
    
    use App\Models\Employee;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    
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
    
}
