<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'Employee_ID' => 'required|integer|max:11',
            'Last_Name' => 'required|string|max:50',
            'First_Name' => 'required|string|max:50',
            'Department' => 'required|string|max:50',
            'Position' => 'required|string|max:50',
            'Employee_Status' => 'nullable|string|max:20',
            'Role_ID' => 'nullable|integer',
            'Password' => 'required|string|min:6|max:255',
        ]);

        // No need to check for errors manually, Laravel will handle it.

        if (empty($validatedData['Role_ID'])) {
            $validatedData['Role_ID'] = 2; // Default to '2' if not provided
        }

        $employee = Employee::create([
            'Employee_ID' => $validatedData['Employee_ID'],
            'First_Name' => $validatedData['First_Name'],
            'Last_Name' => $validatedData['Last_Name'],
            'Department' => $validatedData['Department'],
            'Position' => $validatedData['Position'],
            'Employee_Status' => $validatedData['Employee_Status'],
            'Role_ID' => $validatedData['Role_ID'],
            'Password' => ($validatedData['Password']), // You mentioned you removed hashing, re-add if needed
        ]);

        Auth::login($employee);

        return redirect()->route('employee.dashboard');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'Employee_ID' => 'required|integer',
            'Password' => 'required|string|max:255', // 'Varchar' is not a validation rule, use 'string' instead
        ]);

        $credentials = $request->only('Employee_ID', 'Password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'Employee_ID' => 'The provided credentials do not match our records.',
        ]);
    }
}
