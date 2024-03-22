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
        public function logout(Request $request)
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
                'Employee_Email',]);
                // Any other fields you expect from the request
            Auth::logout();
            Session::flush(); // Clear session data
            return redirect('/login');
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
                'password' => 'required|string', 
            ]);
        
            // Attempt to log the user in
            $credentials = $request->only('Employee_ID', 'password');
            if (Auth::attempt($credentials)) {
                // Set login cookie with 1-hour expiration
                $cookie = cookie('logged_in', true, 60);
        
                // If successful, redirect to their respective dashboard
                $user = Auth::user();
                if ($user->isAdmin()) {
                    return redirect()->route('admin.dashboard')->withCookie($cookie);
                } else {
                    return redirect()->route('employee.dashboard')->withCookie($cookie);
                }
            }
        
            // If unsuccessful, redirect back to the login with the form data
            // It's better to use a generic error message key here, like 'login_error'
            return back()->withErrors([
                'login_error' => 'The provided credentials do not match our records.',
            ])->withInput($request->except('password')); // Exclude the password from the old input to avoid security risk
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
