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

                $employeeID = $request->input('Employee_ID');
                $employee = Employee::where('Employee_ID', $employeeID)->first();
 
                if ($employee->Lock_Count >= 3) { 
                    Auth::logout(); 
                    return redirect()->back()->withErrors([
                        'login_error' => 'Your account is locked. Please contact your system administrator.',
                    ])->withInput();
                } 

                if ($employee->Expiry_Date < now()) { 
                    Auth::logout(); 
                    session()->put('employeeID', $employee->Employee_ID);
                    return redirect()->route('auth.changePwd')->withErrors([
                        'login_error' => 'Your password is expired. Please change your password.',
                    ])->withInput();
                }
                  
                $cookie = cookie('logged_in', true, 60); 

                // Reset lock count to 0
                $employee->Lock_Count = 0;
                $employee->save();

                return redirect()->route('admin.dashboard')->withCookie($cookie);
            }

            // Update lock count to +1 every time wrong password
            $employeeID = $request->input('Employee_ID');
            $empProfile = Employee::where('Employee_ID', $employeeID)->first();
            if ($empProfile) {
                $empProfile->increment('Lock_Count');
            }

            return back()->withErrors([
                'login_error' => 'The provided credentials do not match our records.',
            ])->withInput($request->except('password')); 
         
        }
 
        public function showChangePasswordForm()
        {  

            if (session()->has('employeeID')) { 
                $employeeID = session()->get('employeeID'); 
                return view('auth.change-password', compact('employeeID'));
            } else { 
                return redirect()->route('login')->withErrors([
                    'login_error' => 'Employee ID not found. Please log in again.',
                ]);
            }
 
        }

        public function changePassword(Request $request)
        {  
            // Validate the form data
            $request->validate([
                'Employee_ID' => 'required|string',
                'newpassword' => 'required|string|min:6',
                'renewpassword' => 'required|string|min:6|same:newpassword',
            ], [
                'newpassword.min' => 'The new password must be at least 6 characters long.',
                'renewpassword.same' => 'The new password and confirm password must match.',
            ]);


            // Get the inputs
            $employeeID = $request->input('Employee_ID');
            $newpassword = $request->input('newpassword');
            $renewpassword = $request->input('renewpassword');

            if ($newpassword!=$renewpassword) {  
                return redirect()->back()->withErrors([
                    'login_error' => 'Passwords do not match',
                ])->withInput();
            } else {
                // Find the employee
                $employee = Employee::where('Employee_ID', $employeeID)->first(); 
                
                                
                // Update password column
                $employee->Password = Hash::make($newpassword);

                // Reset lock count to 0
                $employee->Lock_Count = 0; 
                // Add 3 months to the current date
                $expiryDate = now()->addMonths(3);
                $employee->Expiry_Date = $expiryDate->format('Y-m-d'); 

                $employee->save();

                // log the user in with the new password
                $credentials = [
                    'Employee_ID' => $employeeID,
                    'password' => $newpassword,
                ];

                if (Auth::attempt($credentials)) {  
                    $cookie = cookie('logged_in', true, 60);  
                    return redirect()->route('admin.dashboard')->withCookie($cookie);
                } else { 
                    return back()->withErrors([
                        'login_error' => 'Failed to authenticate with the new password.',
                    ])->withInput();
                }
            }
 
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
